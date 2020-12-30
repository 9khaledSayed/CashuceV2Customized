@extends('layouts.app')

@section('content')

    <div class="kt-login__head">
        <form class="d-inline" method="POST" action="{{ route("logout")  }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary mx-auto">{{ __('Log Out!') }}</button>.
        </form>
    </div>

<!--end::Head-->

<!--begin::Body-->
<div class="kt-login__body">

    <!--begin::Signin-->
    <div class="kt-login__form" style="text-align: justify">
        <div class="kt-login__title">
            <h3> {{ __('Verify Your Email Address') }}</h3>
        </div>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>

    <!--end::Signin-->
</div>

<!--end::Body-->
@endsection
