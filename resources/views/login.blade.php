@extends('layouts.master')

@section('content')

{{--    {{dd(session()->all())}}--}}
    <div class="login-form text-center p-7 position-relative overflow-hidden">

        <div class="login-signin">

            <div class="mb-20">
                <h3>Sign In</h3>
                <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
            </div>
            @include('layouts.messages')
            <form class="form" action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-group mb-5">
                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                </div>
                <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Get Login Link</button>
            </form>

            <div class="mt-10">
                <span class="opacity-70 mr-4">Don't have an account yet?</span>
                <a href="{{ route('getRegister') }}" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
            </div>

        </div>

    </div>

@endsection
