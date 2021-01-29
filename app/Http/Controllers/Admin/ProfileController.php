<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }


    public function update(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }

            $user = auth()->user();
            $adminProfile = $user->adminProfile;
            $adminProfile->name = $request->get('name');

            $adminProfile->save();

            return back()->with('success', __('admin.profile_update_success'));
        } catch (\Exception $e) {
            Log::error($e);
            return back()->with('error', __('admin.default_error_message'))->withInput($request->all());
        }
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('admin.login');
    }


    public function changePasswordAjax(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'min:8', 'same:password']
            ]);
            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), 422, $validator->errors());
            }
            $user = auth()->user();

            if ((Hash::check(request('current_password'), $user->password)) == false) {
                return ResponseBuilder::error(__('admin.invalid_current_password'), 406);
            }

            if ((Hash::check(request('password'), $user->password)) == true) {
                return ResponseBuilder::error(__('admin.invalid_new_password'), 406);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return ResponseBuilder::success(null, __('admin.password_change_success'), 200);
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::success(null, "Password Updated.", 200);
        }
    }
}
