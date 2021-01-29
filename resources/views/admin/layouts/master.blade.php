@extends('admin.layouts.base')

@section('master')

    <!-- [ Header ] start -->
    @include('admin.includes._header')
    <!-- [ navigation menu ] end -->

    <!-- [ Side Bar ] start -->
    @include('admin.includes._sidebar')
    <!-- [ Side Bar ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-panel">
        <div class="content">
            @yield('content')
        </div>

        <!-- [ Footer ] start -->
        @include('admin.includes._footer')
        <!-- [ Footer ] end -->
    </div>
    <!-- [ Main Content ] end -->
    @include('admin.profile.change-password')

@endsection
