@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Settings')}}
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
    <div class="kt-portlet kt-portlet--mobile mt-5">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Allowance Type')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{route('dashboard.index')}}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        {{__('Back')}}
                    </a>
                    <a href="#" class="btn btn-brand btn-icon-sm"  data-toggle="modal" data-target="#myModal">
                        <i class="flaticon2-plus"></i> {{__('Add New')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" style="width: 100%">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="{{__('Search')}}..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>{{__('Date')}}:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_date">
                                            <option value="">{{__('All')}}</option>
                                            <option value="1">{{__('Today')}}</option>
                                            <option value="2">{{__('Last Week')}}</option>
                                            <option value="3">{{__('Last Month')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>

            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('New Allowance')}}</h4>
                    <button type="button" class="close" id="close" data-dismiss="modal"></button>

                </div>
                <div class="modal-body">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add"
                             data-ktwizard-state="step-first">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                                <!--begin: Form Wizard Form-->
                                <form action="{{route('dashboard.allowances.store')}}" method="post" class="kt-form"
                                      id="kt_contacts_add_form">
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
                                                                                    <label>{{__('Name In Arabic')}} *</label>
                                                                                    <input name="name_ar" class="form-control" type="text">
                                                                                    @error('name_ar')
                                                                                    <div class="invalid-feedback">
                                                                                        {{$message}}
                                                                                    </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>{{__('Name In English')}} *</label>
                                                                                    <input name="name_en" class="form-control" type="text">
                                                                                    @error('name_en')
                                                                                    <div class="invalid-feedback">
                                                                                        {{$message}}
                                                                                    </div>
                                                                                    @enderror
                                                                                </div>

                                                                            </div>



                                                                            <div class="form-group row mt-5 mb-5">
                                                                                <div class="col-4">
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
                                                                                <div class="col-4">
                                                                                    <label>{{__('Value In Ryal')}} *</label>
                                                                                    <input name="value" class="form-control" type="number">
                                                                                    @error('value')
                                                                                    <div class="invalid-feedback">
                                                                                        {{$message}}
                                                                                    </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label>{{__('Value In Percentage')}} *</label>
                                                                                    <input name="percentage" class="form-control"  type="number" >
                                                                                    @error('percentage')
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
                                            class="col-3 btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto"
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
            </div>

        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">
        var editPage = false;
        $('.kt-selectpicker').selectpicker();
    </script>

    <script src="{{asset('js/datatables/allowances.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pages/allowances.js')}}" type="text/javascript"></script>
@endpush
