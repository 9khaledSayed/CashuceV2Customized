@extends('layouts.dashboard')

@section('content')
    <div class="kt-subheader   kt-grid__item mt-3" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Settings')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-brand">
                    {{__('Company Profile')}}
                </h3>
            </div>

        </div>
        @if(session('success'))
            @include('layouts.dashboard.parts.successSection')
        @endif
        @include('layouts.dashboard.parts.errorSection')

        <form id="add-form" method="post" action="{{route('dashboard.profile.company_profile', $company->id)}}" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name_ar">{{__('Arabic Name')}} <span class="required">*</span></label>
                            <input autocomplete="off" class="form-control" id="name_ar" name="name_ar" type="text" value="{{old('name_ar') ?? $company->name_ar}}">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name_en">{{__('English Name')}} <span class="required">*</span></label>
                            <input autocomplete="off" class="form-control" id="name_en" name="name_en" placeholder="" type="text" value="{{old('name_en') ?? $company->name_en}}">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="cr_number">{{__('CR Number')}}</label>
                            <input autocomplete="off" class="form-control" id="cr_number" name="cr_number" placeholder="" type="text" value="{{old('cr_number') ?? $company->cr_number}}">
                            <span class="field-validation-valid text-danger" data-valmsg-for="cr_number" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ceo_id">{{__('Chief Executive Officer')}}</label>
                            <select autocomplete="off" class="form-control selectpicker" name="ceo_id">
                                <option value="" >{{__('Choose')}}</option>
                                @foreach($employees as $employee)
                                    <option
                                            value="{{$employee->id}}"
                                            @if((old('ceo_id') ?? $company->ceo_id) == $employee->id) selected @endif>
                                        {{$employee->name()}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="hr_id">{{__('HR Manager')}}</label>
                            <select autocomplete="off" class="form-control selectpicker" name="hr_id">
                                <option value="" >{{__('Choose')}}</option>
                                @foreach($employees as $employee)
                                    <option
                                            value="{{$employee->id}}"
                                            @if((old('hr_id') ?? $company->hr_id) == $employee->id) selected @endif>
                                        {{$employee->name()}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>




                <div class="kt-section">
                    <div class="kt-section__title">
                        {{__('Address')}}
                    </div>

                    <div class="kt-section__body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country_en">{{__('Country (Arabic)')}} <span class="required">*</span></label>
                                    <input autocomplete="off" class="form-control" id="country_ar" name="country_ar" placeholder="" type="text" value="{{old('country_ar') ?? $company->country_ar}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country_en">{{__('Country (English)')}} <span class="required">*</span></label>
                                    <input autocomplete="off" class="form-control" id="country_en" name="country_en" placeholder="" type="text" value="{{old('country_en') ?? $company->country_en}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city_ar">{{__('City (Arabic)')}}</label>
                                    <input autocomplete="off" class="form-control" id="city_ar" name="city_ar" placeholder="" type="text" value="{{old('city_ar') ?? $company->city_ar}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city_en">{{__('City (English)')}}</label>
                                    <input autocomplete="off" class="form-control" id="city_en" name="city_en" placeholder="" type="text" value="{{old('city_en') ?? $company->city_en}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="city_en" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address_ar">{{__('Address (Arabic)')}}</label>
                                    <input autocomplete="off" class="form-control" id="address_ar" name="address_ar" placeholder="" type="text" value="{{old('address_ar') ?? $company->address_ar}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="address_ar" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address_en">{{__('Address (English)')}}</label>
                                    <input autocomplete="off" class="form-control" id="address_en" name="address_en" placeholder="" type="text" value="{{old('address_en') ?? $company->address_en}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="address_en" data-valmsg-replace="true"></span>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="postal_code">{{__('Postal Code')}}</label>
                                    <input autocomplete="off" class="form-control" id="postal_code" name="postal_code" placeholder="" type="text" value="{{old('postal_code') ?? $company->postal_code}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="postal_code" data-valmsg-replace="true"></span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="kt-section">
                    <div class="kt-section__title">
                        {{__('Contact')}}
                    </div>
                    <div class="kt-section__body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">{{__('Phone Number')}}</label>
                                    <input autocomplete="off" class="form-control" id="phone" name="phone" placeholder="" type="text" value="{{old('phone') ?? $company->phone}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="phone" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">{{__('email')}}</label>
                                    <input autocomplete="off" class="form-control" id="email" name="email" placeholder="" type="text" value="{{old('email') ?? $company->email}}">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="email" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-section">
                    <div class="kt-section__title">
                        Logo
                    </div>
                    <div class="row">
                        <div class="col-lg-3 m-auto">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Logo')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset('storage/companies/logos/' . $company->logo)}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('logo')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="kt-portlet__foot">

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                    {{__('Submit')}}
                </button>
                <a class="btn btn-outline-danger btn-sm" href="{{route('dashboard.index')}}">
                    <i class="fa fa-ban"></i>
                    {{__('Back')}}
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function (){
            $('.kt-select2').select2({
                placeholder:'{{__('Choose')}}'
            })
        });
    </script>
@endpush
