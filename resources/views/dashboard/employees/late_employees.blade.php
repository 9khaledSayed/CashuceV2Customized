@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Dashboard')}}
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
    <!-- end:: Content Head -->
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Late Employees')}}
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
                        @foreach($lateEmployees as $employee)
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
@endsection

