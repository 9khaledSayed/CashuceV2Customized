@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Employee Info')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.employees.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet">
        <div class="modal-header">
            <h3 class="modal-title">
                {{__('Details')}}
            </h3>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
            <div id="payslip-details-div">
                <div class="kt-widget kt-widget--user-profile-1 row" style="padding-bottom:unset;">
                    <div class="kt-widget__head col-lg-4">
                        <div class="kt-widget__media">
                            <div class="kt-badge kt-badge--xl kt-badge--success">{{ mb_substr( $employee->name() ,0,2,'utf-8')}}</div>
                            <div class="text-center kt-font-bold kt-margin-t-5">
                                {{$employee->job_number}}
                            </div>
                        </div>
                        <div class="kt-widget__content">
                            <div class="kt-widget__section">
                                <a href="#" class="kt-widget__username">
                                    {{$employee->name()}}
                                </a>
                                <span class="kt-widget__subtitle">
                               {{$employee->role->name()}}
                            </span>
                                <span class="kt-widget__subtitle">
                                {{$employee->created_at->format('Y-m-d')}}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget4 kt-padding-15 col-lg-4">
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="fa fa-plus-circle kt-font-success"></i>
                            </span>
                            <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                {{__('Salary')}}
                            </a>
                            <span class="kt-widget4__number kt-font-success">
                                {{$employee->salary . __(' S.R')}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget4 kt-padding-15 col-lg-4">
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon-coins kt-font-danger"></i>
                            </span>
                            <a href="#" class="kt-widget4__title kt-widget4__title--light">
                                {{__('Total Deductions')}}
                            </a>
                            <span class="kt-widget4__number kt-font-success">
                               {{$employee->deductions() . __(' S.R')}}
                            </span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Employee Violation')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <td style="width:15%">{{__('Violation')}}</td>
                                        <td style="width:15%">{{__('Repeats')}}</td>
                                        <td style="width:15%">{{__('Violation Date')}}</td>
                                        <td style="width:15%">{{__('Created At')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($employee->employee_violations as $violation)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{__($violation->reason())}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{__($violation->repeats)}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub kt-font-danger">{{$violation->date->format('Y-m-d')}}</span>
                                            </td>

                                            <td>{{$violation->created_at->format('Y-m-d')}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"> {{__('There is no violations to this employee')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/New Users-->
        </div>
    </div>
    <!--End::Row-->

@endsection
