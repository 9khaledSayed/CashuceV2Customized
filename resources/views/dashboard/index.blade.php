@extends('layouts.dashboard')

@section('content')
    <!--Begin::Dashboard 6-->

    <!--begin:: Widgets/Stats-->
    <div class="kt-portlet">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">

                                <a href="{{route('dashboard.employees.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('All Employees')}}
                                    </h4>
                                </a>

                                <a href="{{route('dashboard.employees.create')}}">
                                    <span class="kt-widget24__desc">
                                    {{__('New Employee')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">
                                <i class="flaticon2-group"></i>
                            </span>
                        </div>
                    </div>
                    <!--end::Total Profit-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">

                                <a href="{{route('dashboard.employees_violations.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Employees Violations')}}
                                    </h4>
                                </a>
                                <a href="{{route('dashboard.employees_violations.create')}}">
                                    <span class="kt-widget24__desc">
                                        {{__('New Violation')}}
                                    </span>
                                </a>

                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                <i class="flaticon2-open-box"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.reports.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Reports')}}
                                    </h4>
                                </a>
                                <a href="{{route('dashboard.reports.create')}}">
                                    <span class="kt-widget24__desc">
                                        {{__('New Report')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-danger">
                                <i class="flaticon2-document"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.conversations.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Conversations')}}
                                    </h4>
                                </a>
                                <a href="{{route('dashboard.conversations.create')}}">
                                    <span class="kt-widget24__desc">
                                        {{__('New Conversation')}}
                                    </span>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                <i class="flaticon-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>

    <!--end:: Widgets/Stats-->

    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-12">

            <!--begin:: Widgets/Sale Reports-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Employees')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin::Widget 11-->
                    <div class="kt-widget11">
                        <div class="table-responsive">
                            <table class="table" style="text-align: center">
                                <thead>
                                <tr>
                                    <td>{{__('Name')}}</td>
                                    <td>{{__('Email')}}</td>
                                    <td>{{__('Job Number')}}</td>
                                    <td>{{__('Role')}}</td>
                                    <td>{{__('Account Status')}}</td>
                                    <td class="">{{__('Created')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            <a href="{{route('dashboard.employees.show', $employee)}}" class="kt-widget11__title">{{$employee->name()}}</a>
                                            <span class="kt-widget11__sub">{{$employee->role->name()}}</span>
                                        </td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->job_number}}</td>
                                        <td><span class="kt-badge kt-badge--inline kt-badge--brand">{{$employee->role->name()}}</span></td>
                                        @if($employee->email_verified_at)
                                        <td>
                                            <span class="kt-badge kt-badge--inline kt-badge--success">
                                                {{__('Activated')}}
                                            </span>
                                        </td>
                                        @else
                                            <td>
                                            <span class="kt-badge kt-badge--inline kt-badge--danger">
                                                {{__('Not Activated')}}
                                            </span>
                                            </td>
                                        @endif
                                        <td class=" kt-font-brand kt-font-bold">{{$employee->created_at->format('D M d Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Widget 11-->
                </div>
            </div>

    <!--end:: Widgets/Sale Reports-->
        </div>
    </div>

    <!--End::Row-->
    <!--End::Dashboard 6-->
@endsection
