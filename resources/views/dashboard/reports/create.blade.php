@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Reports')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.reports.index')}}" class="btn btn-secondary">
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
                    {{__('New Report')}}
                </h3>
            </div>
        </div>
        @include('layouts.dashboard.parts.errorSection')
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.reports.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row ">
                    <label for="employee_id" class="col-form-label col-lg-3 col-sm-12">{{__('Employees')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
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
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Date')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <div class="input-group date">
                            <input name="violation_date" value="{{old('violation_date')}}" type="text" class="form-control datepicker" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Description')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <textarea id="kt-tinymce-2" name="description" class="tox-target">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.employees.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/pages/crud/forms/editors/tinymce.js')}}" type="text/javascript"></script>
@endpush
