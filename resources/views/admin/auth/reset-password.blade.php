@extends('admin.layouts.base')

@section('master')
    <nav class="navbar navbar-header navbar-expand-lg">
        {{--<div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center pt-2">
                <li class="nav-item dropdown hidden-caret">
                    <a href="#" class="btn btn-primary">Login</a>
                </li>
            </ul>
        </div>--}}
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Rest Password</h4>
                        <small>Enter you new password to get your account access</small>

                    </div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="text-center text-danger">
                                <h3>{{ $error }}</h3>
                            </div>
                        @else
                        <form role="form" method="post" action="{{ route('admin.reset_password.post', ['token' => $token]) }}" data-parsley-validate>
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                       name="password" data-parsley-trigger="focusout"
                                       data-parsley-required
                                       data-parsley-required-message="Please enter password">
                                @error('password')
                                <small class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password"
                                       name="confirm_password" data-parsley-trigger="focusout"
                                       data-parsley-required
                                       data-parsley-required-message="Please enter confirm password">
                                @error('confirm_password')
                                <small class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>

                        @endif

                        <div class="col text-center mt-3">
                            Already have login and password? <a href="{{ route('admin.login') }}">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
