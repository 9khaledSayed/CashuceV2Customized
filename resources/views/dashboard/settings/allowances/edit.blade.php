@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-5" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Memos')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit" >
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add"
                 data-ktwizard-state="step-first" >
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper" >
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.allowance_types.update',$allowanceType->id)}}" method="post" class="kt-form"
                          id="kt_contacts_add_form" style="width:60%">
                    @method('PUT')
                    @csrf
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                             data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <div class="kt-portlet__body">
                                                            <div class="form-group form-group-marginless">


                                                                <div class="form-group row mt-5 mb-5">
                                                                    <div class="col-6">
                                                                        <label>{{__('Name')}} *</label>
                                                                        <input name="name" class="form-control" type="text" value="{{$allowanceType->name}}">
                                                                        @error('name')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label>{{__('Allowance Type')}} *</label>
                                                                        <select class="form-control kt-selectpicker" data-val="true" name="type" >
                                                                            <option value="">
                                                                                {{__('Choose')}}
                                                                            </option>
                                                                            <option value="1">
                                                                                {{__('Addition')}}
                                                                            </option>
                                                                            <option value="0">
                                                                                {{__('Deduction')}}
                                                                            </option>
                                                                        </select>

                                                                        @error('type')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mt-5 mb-5">
                                                                    <div class="col-6">
                                                                        <label>{{__('Value In Ryal')}} *</label>
                                                                        <input name="value" class="form-control" type="number"  value="{{$allowanceType->value ?? ''}}">
                                                                        @error('value')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label>{{__('Value In Percentage')}} *</label>
                                                                        <input name="value_perc" class="form-control"  type="number"  value="{{$allowanceType->value_perc ?? ''}}">
                                                                        @error('value_perc')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
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
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div
                                class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto"
                                style="display: block" data-ktwizard-type="action-submit">
                                {{__('Submit')}}
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

    <script type="text/javascript">
        var editPage = true;
    </script>

    <script src="{{asset('js/pages/salary_types.js')}}" type="text/javascript"></script>
@endpush
