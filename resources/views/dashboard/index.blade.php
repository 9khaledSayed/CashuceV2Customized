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
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon kt-hidden">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="kt-portlet__head-title">
                            {{__('Employees In Departments')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="kt_flotcharts_11" style="height: 300px;"></div>
                </div>
            </div>
            <!--End::Dashboard 6-->
        </div>
    </div>
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-6">

            <!--begin:: Widgets/Sale Reports-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Ended Employees')}}
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
                                @foreach($endedEmployees as $employee)
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
        <div class="col-xl-6">

            <!--begin:: Widgets/Audit Log-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Employees Activities')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget4_tab11_content">
                            <div class="kt-scroll" data-scroll="true" data-height="400" style="height: 400px;">
                                <div class="kt-list-timeline">
                                    <div class="kt-list-timeline__items">
                                        @forelse($activities as $activity)
                                            <div class="kt-list-timeline__item">
                                                <span class="kt-list-timeline__badge kt-list-timeline__badge--{{$activity->statusColor()}}"></span>
                                                <span class="kt-list-timeline__text">{{$activity->description . " by ( " . $activity->causer->name() . " )"}}</span>
                                                <span class="kt-list-timeline__time">{{$activity->created_at->diffForHumans()}}</span>
                                            </div>
                                        @empty
                                            <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                                <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                                    <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                                        {{__('There Is No Activities Yet !')}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Audit Log-->
        </div>


    </div>

    <!--End::Row-->


@endsection

@push('scripts')
    <script src="{{asset('assets/plugins/custom/flot/flot.bundle.js')}}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <script>
        $(function () {
            var demo11 = function() {
                var data = [
                    @foreach($departments as $department)
                    {label: "{{$department['label']}}", data: {{$department['percentage']}}, color:  KTApp.getStateColor("{{$department['color']}}")},
                    @endforeach
                ];



                $.plot($("#kt_flotcharts_11"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 1,
                                formatter: function(label, series, ) {
                                    return '<div style="font-size:12pt;font-weight:900;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {
                                    opacity: 0.8
                                }
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
            }
            demo11();
        })
    </script>
@endpush
