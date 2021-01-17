@extends('layouts.dashboard')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (app()->isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush

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

    <div class="kt-portlet" >
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Attendance Record Manually')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.attendances.store_manually')}}" method="post" class="kt-form" style="width: 80%" id="kt_contacts_add_form">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">

                                                        <div class="form-group row">
                                                            <div class="col-lg-6" id="doctors">
                                                                <label>{{__('Employee')}} *</label>
                                                                <select class="form-control @error('employee_id') is-invalid @enderror kt-selectpicker"
                                                                        id="employee_id"
                                                                        data-size="7"
                                                                        data-live-search="true"
                                                                        data-show-subtext="true" name="employee_id" title="{{__('Select')}}">
                                                                    @forelse($employees ?? [] as $employee)
                                                                        <option
                                                                                value="{{$employee->id}}"
                                                                                @if(old('employee_id') == $employee->id) selected @endif
                                                                        >{{$employee->name()}}</option>
                                                                    @empty
                                                                        <option disabled>{{__('There is no employees under your supervision')}}</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Date And Time')}}</label>
                                                                <div class="input-group date">
                                                                    <input type="text"
                                                                           class="form-control"
                                                                           name="date_time"
                                                                           value="{{old('date_time')}}"
                                                                           placeholder="Select date and time"
                                                                           id="kt_datetimepicker_5" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar glyphicon-th"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <label>{{__('Operation')}} *</label>
                                                                <textarea  name="operation_show" class="form-control text-center" disabled="disabled" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto" style="display: block" data-ktwizard-type="action-submit">
                                {{__('confirm')}}
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/pages/attendances_manually.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
            $('#kt_datetimepicker_5').datetimepicker({
                format: "dd/m/yyyy - HH:ii:ss P",
                showMeridian: true,
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'bottom-left'
            });
        })
    </script>
@endpush
