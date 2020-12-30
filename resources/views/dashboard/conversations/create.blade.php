@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Employees')}}
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
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('New Conversation')}}
                </h3>
            </div>
        </div>
        @include('layouts.dashboard.parts.errorSection')
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.conversations.store')}}">
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
                            @forelse($employees as $employee)
                                <option
                                    value="{{$employee->id}}"
                                    @if($employee->id == old('employee_id')) selected @endif
                                >{{$employee->name()}}</option>
                            @empty
                                <option disabled>{{__('There is no employees')}}</option>
                            @endforelse
                        </select>
                    </div>
                </div>


            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.conversations.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
    <script>
        $(function (){
            $(".kt-selectpicker").selectpicker();
        });
    </script>
@endpush
