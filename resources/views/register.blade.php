@extends('layouts.master')

@section('content')

    <style>
        .btn-primary{
            background-color: #0d8ddc !important;
            border-color: #0d8ddc !important;
        }
    </style>
    <div class="login-form text-center p-7 position-relative overflow-hidden">

        <div class="login-signup">
            <div class="mb-20">
                <h3>Sign Up</h3>
                <div class="text-muted font-weight-bold">Enter your details to create your account</div>
            </div>
            @include('layouts.messages')
            <form method="POST" action="{{ route('postRegister') }}">
                @csrf
                <div class="form-group mb-5">
                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Fullname" name="name" value="{{old('name')}}"/>
                </div>
                <div class="form-group mb-5">
                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" value="{{old('email')}}"/>
                </div>
                <div class="form-group mb-5 text-left">
                    <div class="checkbox-inline pt-5">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('getLogin') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                    <div class="form-text text-muted text-center"></div>
                </div>
                <div class="form-group d-flex flex-wrap flex-center mt-10">
                    <button class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up</button>
                </div>
            </form>
        </div>

    </div>

@endsection
