@extends('layouts.app')

@section('content')

<div class="kt-login__head">
    <span class="kt-login__signup-label">{{__('Already have an account ?')}}</span>&nbsp;&nbsp;
    <a href="{{ route("login") }}" class="kt-link kt-login__signup-link">{{__('Log in!')}}</a>
</div>


<!--end::Head-->

<!--begin::Body-->
<div class="kt-login__body">

    <!--begin::Signin-->
    <div class="kt-login__form">
        <div class="kt-login__title">
            <h3> {{ __('Register') }}</h3>
        </div>

        <!--begin::Form-->
            <form method="POST" action='{{ route("register") }}' aria-label="{{ __('Register') }}">

                @csrf
                <div class="form-group">
                    <input id="name"
                           type="text"
                           class="form-control @error('name_in_arabic') is-invalid @enderror"
                           name="name_in_arabic"
                           placeholder="{{__('Name In Arabic')}}"
                           value="{{ old('name_in_arabic') }}"
                           required autocomplete="name" autofocus>
                    @error('name_in_arabic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="name"
                           type="text"
                           class="form-control @error('name_in_english') is-invalid @enderror"
                           name="name_in_english"
                           placeholder="{{__('Name In English')}}"
                           value="{{ old('name_in_english') }}"
                           required autocomplete="name" autofocus>
                    @error('name_in_english')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="email"
                           type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="{{__('Email')}}"
                           required
                           autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{__('Password')}}"
                           name="password"
                           required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-confirm"
                           type="password"
                           class="form-control"
                           placeholder="{{__('Confirm Password')}}"
                           name="password_confirmation"
                           required autocomplete="new-password">
                </div>
                <div class="kt-login__actions">
                    <button  class="btn btn-primary btn-elevate kt-login__btn-primary mx-auto">{{__('Register')}}</button>
                </div>
            <!--end::Action-->
            </form>

            <!--end::Form-->
    </div>

    <!--end::Signin-->
</div>

<!--end::Body-->
@endsection
