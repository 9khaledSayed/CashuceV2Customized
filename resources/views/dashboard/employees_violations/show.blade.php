@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Employees Violations')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.employees_violations.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">

        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-2">
                <div class="kt-invoice__head">
                <div style="width: 80%;
                            border: solid 1px;
                            padding: 20px;
                            margin-left: auto;
                            margin-right: auto;
                            margin-bottom: 50px;
                        " class="page-content read container">

                    <h1 style="text-align: center;text-decoration: underline;padding: 10px; font-size: 40px">{{__('Violation Letter')}}</h1>
                    <div class="details">
                        <p> <strong>{{__('Date')}} : </strong> {{ \Carbon\Carbon::today()->locale(app()->getLocale())->isoFormat('LL') }}</p>
                        <p> <strong>{{__('Violation repeats')}} : </strong>{{ $employeeViolation->repeats }}</p>
                        <p> <strong>{{__('Employee')}} : </strong>{{ $employeeViolation->employee->name() }}</p>
                        <p> <strong>{{__('Job Number')}} : </strong>{{ $employeeViolation->employee->job_number }}</p>
                        <p><strong> {{__('From')}} :</strong> {{__('Human Resource Manager')}}</p>
                    </div>

                    <p style="
    text-align: center;
    padding: 30px;
">
                        {{__('Below has been sent to below, instructions below have been issued to below, and the penalty agreement issued below. We hope that this hotel will reward you to avoid violating work regulations in the future.')}}
                    </p>

                    <p style="margin: 10px 0"><strong>{{__('Reason')}}: </strong>{{ __($employeeViolation->violation->reason()) }}</p>
                    <p></p>

                    <p style="margin: 10px 0"><strong> {{__('Date')}}: </strong>{{ $employeeViolation->date->locale(app()->getLocale())->isoFormat('LL') }}</p>

                    <p style="margin: 10px 0"><strong>{{__('Violations Penalties')}} : </strong>
                        {{__($deduction)}}
                    </p>
                    @if($employeeViolation->addition_to > 0)
                        <p style="margin: 10px 0"><strong>{{__('Addition Penalties')}} : </strong>
                            {{ __('( ' . $employeeViolation->violation->addition_to . ' ) ') . $employeeViolation->addition_to . ' '. __(' S.R')}}
                        </p>
                    @endif

                    <p style="text-align: center">{{__('Wish you success')}}</p>

                    <div style="
    text-align: left;
">
                        <p>{{__('Human Resource Manager')}}</p>
                        <p></p>
                    </div>

                    <div style="
    text-decoration: underline;
">
                        <p>{{__('Employee Received')}}</p>
                        <p>{{__('Name')}}</p>
                        <p>{{__('Signature')}}</p>
                        <p>{{__('Date')}}</p>
                    </div>
                </div>
                </div>
                <div class="kt-invoice__actions">
                    <div class="kt-invoice__container">
                        <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">{{__('Print')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Portlet-->
@endsection


