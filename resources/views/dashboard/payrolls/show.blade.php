@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Payrolls')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.payrolls.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    @if($payroll->has_changes)
        <div class="alert alert-primary" role="alert">

            <div class="alert-icon"><i class="flaticon-warning"></i></div>

            <div class="alert-text">
                <strong>
                    {{__('There is salary operations not included in payroll. Please reissue the payroll to include operation')}}
                </strong>
            </div>
        </div>
    @endif
    <!-- end:: Content Head -->
    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Payroll Details')}}
                </h3>
            </div>
        </div>
        @if(session('reissue') == 1)
            <div class="kt-portlet__body" id="reissue_alert">
                <div class="alert alert-warning" style="margin: 0" role="alert">
                    <div class="alert-text">{{__('The Payroll  Has Been Reissued !')}}</div>
                </div>
            </div>
        @endif
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-xl">

                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-3 -->
                    <div class="kt-widget1">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Payrolls')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{ $payroll->date->translatedFormat('F Y') }}
                                </span>
                            </div>

                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Employees No')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{ $payroll->employees_no }}
                                </span>
                            </div>

                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Payroll Date')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{ $payroll->date->format('d-m-Y') }}
                            </span>
                            </div>

                        </div>
                    </div>

                    <!--end:: Widgets/Stats2-3 -->
                </div>

                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="kt-widget1">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Status')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                    @switch($payroll->status)
                                        @case('0')
                                        <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-badge--rounded">
                                                {{__('Pending')}}
                                            </span>
                                        @break
                                        @case('1')
                                        <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">
                                                {{__('Approved')}}
                                            </span>
                                        @break
                                        @case('2')
                                        <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">
                                                {{__('Rejected')}}
                                            </span>
                                        @break
                                    @endswitch
                                </span>
                            </div>

                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Operations Included')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                    <span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--pill kt-badge--rounded">
                                        {{__('Deductions')}}
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Issue Date')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{$payroll->issue_date->format('A h:i @ d-m-Y')}}
                            </span>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Stats2-1 -->
                </div>

                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-2 -->
                    <div class="kt-widget1">

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Total Deductions')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{__('Total salaries deductions')}}
                            </span>
                            </div>
                            <span class="kt-widget1__number kt-font-danger">
                                {{$payroll->total_deductions}}
                            </span>
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">
                                    {{__('Payroll total netpay')}}
                                </h3>
                                <span class="kt-widget1__desc">
                                {{__('Total netpay after deductions')}}
                            </span>
                            </div>
                            <span class="kt-widget1__number kt-font-success">
                                {{$payroll->total_net_salary}}
                            </span>
                        </div>

                    </div>
                    <!--end:: Widgets/Stats2-2 -->
                </div>


            </div>
        </div>
    </div>

    <div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-brand">
                        {{ $payroll->date->translatedFormat('F Y') }}
                        <small>
                            {{ $payroll->date->format('d-m-Y') }}
                        </small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        @can('proceed_payrolls')
{{--                            @if($payroll->status != 1)--}}
                            <a class="btn btn-warning btn-sm btn-loading" href="{{route('dashboard.payrolls.reissue', $payroll->id)}}">
                                <i class="fa fa-redo"></i>
                                {{__('Reissue')}}
                            </a>
                            <a href="{{route('dashboard.payrolls.approve', $payroll->id)}}" class="btn btn-success btn-sm ">
                                <i class="fa fa-check"></i>
                                {{__('Approve')}}
                            </a>
                            <a href="{{route('dashboard.payrolls.reject', $payroll->id)}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-times"></i>
                                {{__('Reject')}}
                            </a>
{{--                            @endif--}}
                        @endcan
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt-datatable" id="scrolling_horizontal"></div>

                <!--end: Datatable -->
            </div>
            <div id="kt_modal_sub_KTDatatable_remote" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" >
                        <div id="modal_sub_datatable_ajax_source"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        var payroll_id = {{$payroll->id}};
    </script>
    <script src="{{asset('js/datatables/salaries.js')}}" type="text/javascript"></script>
@endpush
