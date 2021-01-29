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
                        <h4 class="card-title">Forgot Password</h4>
                        <small>Enter you email to reset your password</small>

                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('admin.forgot_password.post') }}" data-parsley-validate>
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control autocomplete-off" id="email" placeholder="Enter Email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       data-parsley-trigger="focusout"
                                       data-parsley-required
                                       data-parsley-type-message="Please enter valid email"
                                       data-parsley-required-message="Please enter email">
                                @error('email')
                                    <small class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>

                        <div class="col text-center mt-3">
                            Already have login and password? <a href="{{ route('admin.login') }}">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
