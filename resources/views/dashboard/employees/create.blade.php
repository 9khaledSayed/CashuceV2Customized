@extends('layouts.dashboard')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (app()->isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('New Employee')}}
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
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v1__nav">
                        <div class="kt-wizard-v1__nav-items">

                            <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg> </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        1. {{__('Basic Information')}}
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
                                                <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        2. {{__('Job')}}
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        3. {{__('Contract Information')}}
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                                <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        4. {{__('Salary Information')}}
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"/>
                                                <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        5. {{__('Contact')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.employees.store')}}" method="post" class="kt-form" style="width: 65%" id="kt_contacts_add_form" >
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Basic Information')}} :</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label>{{__('First Name Arabic')}} *</label>
                                                                <input name="fname_ar" class="form-control" type="text">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Middle Name Arabic')}}</label>
                                                                <input name="mname_ar" class="form-control" type="text">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Last Name Arabic')}} *</label>
                                                                <input name="lname_ar" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label>{{__('First Name English')}} *</label>
                                                                <input name="fname_en" class="form-control" type="text">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Middle Name English')}}</label>
                                                                    <input name="mname_en" class="form-control" type="text">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Last Name English')}} *</label>
                                                                <input name="lname_en" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Birthdate')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="birthdate" type="text" class="form-control datepicker" readonly/>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Nationality')}} *</label>
                                                                <select name="nationality_id" class="form-control kt-selectpicker" title="Choose">
                                                                    <option value="">{{__('Choose')}}</option>
                                                                    @foreach($nationalities as $nationality)
                                                                        <option value="{{$nationality->id}}">{{$nationality->name()}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label >{{__('Marital Status')}}</label>
                                                                <div class="kt-checkbox-inline">
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="marital_status" value="0">
                                                                        {{__('Single')}}
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="marital_status" value="1">
                                                                        {{__('Married')}}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Gender')}}</label>
                                                                <div class="kt-checkbox-inline">
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="gender" value="0">
                                                                        {{__('Male')}}
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="gender" value="1">
                                                                        {{__('Female')}}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Address Details')}}</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <label>{{__('Identity Type')}}</label>
                                                                <div class="kt-checkbox-inline">
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="identity_type" value="0">
                                                                        {{__('National ID')}}
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                                        <input type="radio" name="identity_type" value="1">
                                                                        {{__('Iqama')}}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label>{{__('ID Number')}} *</label>
                                                                <input name="id_num" class="form-control" type="number">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Issue Date')}}</label>
                                                                <div class="input-group date">
                                                                    <input name="id_issue_date" type="text" class="form-control datepicker" readonly/>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Expire Date')}}</label>
                                                                <div class="input-group date">
                                                                    <input name="id_expire_date" type="text" class="form-control datepicker" readonly/>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Passport Information')}}</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <label>{{__('Passport Number')}}</label>
                                                                <input name="passport_num" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label>{{__('Issue Date')}}</label>
                                                                <div class="input-group date">
                                                                    <input name="passport_issue_date" type="text" class="form-control datepicker" readonly />
                                                                    <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Expire Date')}}</label>
                                                                <div class="input-group date">
                                                                    <input name="passport_expire_date" type="text" class="form-control datepicker" readonly />
                                                                        <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Issue Place')}}</label>
                                                                <input name="issue_place" class="form-control" type="text">
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

                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Job')}} :</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Employee Number')}} *</label>
                                                                <input name="job_number" class="form-control"  value="" type="text">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Joined Date')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="joined_date" type="text" class="form-control datepicker" readonly />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Job Title')}} *</label>
                                                                <select name="role_id" class="form-control kt-selectpicker" title="Choose">
                                                                    @foreach($roles as $role)
                                                                        <option value="{{$role->id}}">{{$role->name()}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="supervisor_id">{{__('Supervisor')}}</label>
                                                                <select class="form-control @error('supervisor_id') is-invalid @enderror kt-selectpicker"
                                                                        id="supervisor_id"
                                                                        data-size="7"
                                                                        data-live-search="true"
                                                                        data-show-subtext="true" name="supervisor_id" title="{{__('Select')}}">
                                                                    <option value="">{{__('choose')}}</option>
                                                                    @forelse($supervisors as $supervisor)
                                                                        <option
                                                                                value="{{$supervisor->id}}"
                                                                                @if($supervisor->id == old('supervisor_id')) selected @endif
                                                                        >{{$supervisor->name()  . '( ' . $supervisor->job_number . ' )'}}</option>
                                                                    @empty
                                                                        <option disabled>{{__('There is no supervisors')}}</option>
                                                                    @endforelse
                                                                </select>
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

                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Contract Information')}} :</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <label>{{__('Contract Type')}} *</label>
                                                                <select name="contract_type" class="form-control kt-selectpicker" title="Choose">
                                                                    @foreach($contract_type as $key => $value)
                                                                        <option value="{{$key}}">{{__($value)}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Contract Start Date')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="contract_start_date" type="text" class="form-control datepicker" readonly />
                                                                    <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6" id="period">
                                                                <label>{{__('Contract period in months')}} *</label>
                                                                <input name="contract_period" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Work Shift')}}:</h3>
                                                        <div class="form-group">
                                                            <label>{{__('Work Shift')}}</label>
                                                            <div class="kt-radio-list">
                                                                @foreach($workShifts as $workShift)
                                                                    <label class="kt-radio kt-radio--tick kt-radio--brand">
                                                                        <input
                                                                                type="radio" name="work_shift_id"
                                                                                value="{{$workShift->id}}"
                                                                                @if(old('work_shift_id') == $workShift->id) checked @endif>
                                                                        {{$workShift->name()}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                            @error('work_shift_id')
                                                            <span class="form-text text-danger">{{$message}}</span>
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

                        <!--end: Form Wizard Step 3-->

                        <!--begin: Form Wizard Step 4-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Salary Information')}} :</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <label>{{__('Basic Salary')}} *</label>
                                                                <input name="salary" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="form-group">
                                                                <div class="col-lg-12">
                                                                    <h3 class="kt-section__title kt-section__title-lg" style="margin: 25px 0 20px 0;">{{__('Allowances')}}</h3>

                                                                    <div class="kt-checkbox-list">

                                                                        @foreach($allowances as $allowance)
                                                                            <label class="kt-checkbox kt-checkbox--bold  @if($allowance->type == 1) kt-checkbox--success @else kt-checkbox--danger @endif ">
                                                                                <input name="allowance[]" value="{{$allowance->id}}" type="checkbox">
                                                                                {{$allowance->name()}}
                                                                                @if($allowance->value)
                                                                                    ( {{$allowance->value . __(' S.R')}} )
                                                                                @else
                                                                                    {{ '( ' .$allowance->percentage . ' % )' }}
                                                                                @endif
                                                                                <span></span>
                                                                            </label>
                                                                        @endforeach
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

                        <!--end: Form Wizard Step 4-->

                        <!--begin: Form Wizard Step 5-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <h3 class="kt-section__title kt-section__title-lg">{{__('Contact')}} :</h3>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Mobile')}} *</label>
                                                                <input name="phone" class="form-control" type="text">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Email')}} *</label>
                                                                <input name="email" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-6">
                                                                <label>{{__('Password')}} *</label>
                                                                <input name="password" class="form-control" type="password" autocomplete="new-password">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('Confirm Password')}} *</label>
                                                                <input name="password_confirmation" class="form-control" type="password" autocomplete="new-password">
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

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                {{__('Previous')}}
                            </div>
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                {{__('Submit')}}
                            </div>
                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                {{__('Next')}}
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
    <script src="{{asset('js/pages/employees.js')}}" type="text/javascript"></script>

@endpush
