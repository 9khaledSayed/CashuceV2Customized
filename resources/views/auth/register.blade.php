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
                <div class="form-group row">
                    <div class="col-lg-4">
                        <input name="fname_ar"
                               class="form-control @error('fname_ar') is-invalid @enderror"
                               value="{{old('fname_ar')}}"
                               placeholder="{{__('First Name Arabic')}}"
                               type="text">
                        @error('fname_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <input name="mname_ar"
                               class="form-control @error('mname_ar') is-invalid @enderror"
                               value="{{old('mname_ar')}}"
                               placeholder="{{__('Middle Name Arabic')}}"
                               type="text">
                        @error('mname_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <input name="lname_ar"
                               class="form-control @error('lname_ar') is-invalid @enderror"
                               value="{{old('lname_ar')}}"
                               placeholder="{{__('Last Name Arabic')}}"
                               type="text">
                        @error('lname_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <input name="fname_en"
                               class="form-control @error('fname_en') is-invalid @enderror"
                               value="{{old('fname_en')}}"
                               placeholder="{{__('First Name English')}}"
                               type="text">
                        @error('fname_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <input name="mname_en"
                               class="form-control @error('mname_en') is-invalid @enderror"
                               value="{{old('mname_en')}}"
                               placeholder="{{__('Middle Name English')}}"
                               type="text">
                        @error('mname_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <input name="lname_en"
                               class="form-control @error('lname_en') is-invalid @enderror"
                               value="{{old('lname_en')}}"
                               placeholder="{{__('Last Name English')}}"
                               type="text">
                        @error('lname_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="input-group date">
                            <input name="birthdate"
                                   placeholder="{{__('Birthdate')}}"
                                   type="text"
                                   value="{{old('birthdate')}}"
                                   style="direction: @if(app()->getLocale() == 'ar') rtl @else 'en' @endif"
                                   class="form-control @error('birthdate') is-invalid @enderror datepicker" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                            @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
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
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
                        <input id="password-confirm"
                               type="password"
                               class="form-control"
                               placeholder="{{__('Confirm Password')}}"
                               name="password_confirmation"
                               required autocomplete="new-password">
                    </div>
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
