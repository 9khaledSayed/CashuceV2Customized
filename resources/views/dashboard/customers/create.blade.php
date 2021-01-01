@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Customers')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.customers.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('New Customer')}}
                </h3>
            </div>
        </div>
        @include('layouts.dashboard.parts.errorSection')
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.customers.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label >{{__('First Name Arabic')}} *</label>
                        <input name="fname_ar"
                               class="form-control"
                               value="{{old('fname_ar')}}"
                               type="text">
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label >{{__('Middle Name Arabic')}}</label>
                        <input name="mname_ar"
                               class="form-control"
                               value="{{old('mname_ar')}}"
                               type="text">
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label >{{__('Last Name Arabic')}} *</label>
                        <input name="lname_ar"
                               value="{{old('lname_ar')}}"
                               class="form-control"
                               type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label>{{__('First Name English')}} *</label>
                        <input name="fname_en"
                               class="form-control"
                               value="{{old('fname_en')}}"
                               type="text">
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label>{{__('Middle Name English')}}</label>
                        <input name="mname_en"
                               class="form-control"
                               value="{{old('mname_en')}}"
                               type="text">
                    </div>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <label>{{__('Last Name English')}} *</label>
                        <input name="lname_en"
                               class="form-control"
                               value="{{old('lname_en')}}"
                               type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="email">{{__('Birthdate')}}</label>
                        <div class="input-group date">
                            <input name="birthdate"
                                   type="text"
                                   value="{{old('birthdate')}}"
                                   class="form-control datepicker" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="email">{{__('Email')}}</label>
                        <input
                                class="form-control @error('email') is-invalid @enderror"
                                type="email"
                                name="email"
                                id="email"
                                value="{{old('email')}}"
                                required autocomplete="email">
                    </div>
                    <div class="col-lg-4">
                        <label for="role_id">{{__('Role')}}</label>
                        <select class="form-control @error('role_id') is-invalid @enderror kt-selectpicker"
                                id="role_id"
                                data-size="7"
                                data-live-search="true"
                                data-show-subtext="true" name="role_id" title="{{__('Select')}}">
                            @forelse($roles as $role)
                                <option
                                        value="{{$role->id}}"
                                        @if($role->id == old('role_id')) selected @endif
                                >{{$role->name()}}</option>
                            @empty
                                <option disabled>{{__('There is no roles')}}</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="password">{{__('Password')}}</label>
                        <input
                                class="form-control @error('password')is-invalid @enderror"
                                type="password"
                                name="password"
                                id="password"
                                value=""
                                autocomplete="new-password">
                    </div>
                    <div class="col-lg-6">
                        <label for="role_id">{{__('Confirm Password')}}</label>
                        <input
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                value="{{old('password_confirmation')}}">
                    </div>
                </div>


            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.customers.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        $(function (){
            $(".kt-selectpicker").selectpicker();
        });
    </script>
@endpush
