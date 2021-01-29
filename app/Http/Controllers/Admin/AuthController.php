<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login() {
        $title = 'Login';
        return view('admin.auth.login', compact('title'));
    }

    public function postLogin(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('error', __('admin.validation_error_message'))->withInput($request->all())->withErrors($validator->errors());
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with(['error' => __('admin.email_not_registered')])->withInput($request->all());
            }

            if (!$user->hasRole('admin')) {
                return back()->with(['error' => __('admin.email_not_registered')])->withInput($request->all());
            }

            if (!auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me ?? false)){
                return back()->with(['error' => __('admin.invalid_credentials')])->withInput($request->all());
            }

            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', __('admin.default_error_message'))->withInput($request->all());
        }
    }

    public function forgotPassword() {
        $title = 'Forgot Password';
        return view('admin.auth.forgot-password', compact('title'));
    }

    public function forgotPasswordPost(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return back()->with('error', __('admin.validation_error_message'))->withInput($request->all())->withErrors($validator->errors());
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with(['error' => __('admin.email_not_registered')])->withInput($request->all());
            }

            if (!$user->hasRole('admin')) {
                return back()->with(['error' => __('admin.email_not_registered')])->withInput($request->all());
            }

            $user->token = Str::random(36);
            $user->token_created_at = now();

            $user->save();

            Mail::to($user->email)->send(new ResetPasswordMail($user));

            return back()->with('success', __('admin.reset_password_link_sent_success'));
        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', __('admin.default_error_message'))->withInput($request->all());
        }
    }

    public function resetPassword(Request $request) {
        $title = 'Reset Password';

        $user = User::where('token', $request->token)->first();
        if (!$user) {
            $error = __('admin.token_invalid');
            return view('admin.auth.reset-password', compact('title', 'error'));
        }

        if (Carbon::parse($user->token_created_at)->diffInSeconds(now()) > config('constants.reset_password_token_expiry_in_seconds')) {
            $error = __('admin.token_expired');
            return view('admin.auth.reset-password', compact('title', 'error'));
        }

        $token = $request->token;
        return view('admin.auth.reset-password', compact('title', 'token'));
    }

    public function resetPasswordPost(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'min:8', 'same:password']
            ]);
            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), 422, $validator->errors());
            }

            $user = User::where('token', $request->token)->first();
            if (!$user) {
                $error = __('admin.token_invalid');
                return view('admin.auth.reset-password', compact('title', 'error'));
            }

            if (Carbon::parse($user->token_created_at)->diffInSeconds(now()) > config('constants.reset_password_token_expiry_in_seconds')) {
                $error = __('admin.token_expired');
                return view('admin.auth.reset-password', compact('title', 'error'));
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.login')->with('success', __('admin.password_change_success'));
        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', __('admin.default_error_message'))->withInput($request->all());
        }
    }
}
