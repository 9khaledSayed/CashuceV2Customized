@extends('layouts.dashboard')
@section('content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Attendance')}}
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
    <!-- begin:: Content Head -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Attendance Sheet')}}
                </h3>
            </div>
        </div>
        <!-- end:: Content Head -->
        <div class="kt-portlet__body">
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" placeholder="{{__('Search')}}..." id="generalSearch">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                            </div>
                        </div>
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>{{__('Date')}}:</label>
                                </div>
                                <div class="kt-form__control">
                                    <div class="input-group date">
                                        <input name="date" type="text" class="form-control datepic" id="kt_form_date" readonly/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>{{__('Supervisor')}}:</label>
                                </div>
                                <div class="kt-form__control">
                                    <select class="form-control selectpicker" id="kt_form_supervisor">
                                        <option value="">{{__('All')}}</option>
                                        @forelse($supervisors as $supervisor)
                                            <option value="{{$supervisor->name()}}">{{$supervisor->name()}}</option>
                                        @empty
                                            <option disabled>{{__('There is no supervisors in your company')}}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>{{__('Nationality')}}:</label>
                                </div>
                                <div class="kt-form__control">
                                    <select class="form-control selectpicker" id="kt_form_nationality">
                                        <option value="">{{__('All')}}</option>
                                        @forelse($nationalities as $nationality)
                                            <option value="{{$nationality->name()}}">{{$nationality->name()}}</option>
                                        @empty
                                            <option disabled>{{__('There is no nationalities in your company')}}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                    <a href="#" class="btn btn-default kt-hidden">
                        <i class="la la-cart-plus"></i> New Order
                    </a>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                </div>
            </div>
        </div>
        <!-- end:: Content Head -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="kt_apps_user_list_datatable"></div>

            <!--end: Datatable -->
        </div>
    </div>

    <!-- end:: Content -->
@endsection

@push('scripts')
<script src="{{asset('js/datatables/attendances.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $('#kt_form_date').datepicker({
            rtl: true,
            language: appLang,
            orientation: "bottom",
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            clearBtn: true,
        });
    })
</script>
@endpush
