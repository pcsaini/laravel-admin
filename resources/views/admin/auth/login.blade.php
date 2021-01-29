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
                        <h4 class="card-title">Login</h4>
                        <small>Enter you credentials to access your account</small>

                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('admin.login.post') }}" data-parsley-validate>
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

                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                       name="password" data-parsley-trigger="focusout"
                                       data-parsley-required
                                       data-parsley-required-message="Please enter password">
                                @error('password')
                                <small class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.forgot_password') }}">Forgot Password</a>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember_me" {{ old('remember_me') == 'on' ? 'checked' : '' }}>
                                    <span class="form-check-sign">Remember Me</span>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
