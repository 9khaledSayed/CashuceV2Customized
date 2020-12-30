@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-5" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Notifications')}}
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
    <div class="kt-portlet kt-portlet--mobile">

        <!--begin:: Widgets/Notifications-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{__('All Notifications')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_widget6_tab1_content" role="tab">
                                {{__('All Notifications')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget6_tab2_content" role="tab">
                                {{__('Read Notifications')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget6_tab3_content" role="tab">
                                {{__('Unread Notifications')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget6_tab1_content" aria-expanded="true">
                        <div class="kt-notification">
                            @forelse($allNotifications as $notification)
                                <a href="{{route('dashboard.notifications.mark_as_read', $notification->id)}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg> </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            {{__($notification->data['message']) . ' ' .  \Carbon\Carbon::today()->translatedFormat('Y-M-d')}}
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{$notification->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                    <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                        <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                            {{__('All caught up!')}}
                                            <br>{{__('No new notifications.')}}
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <div class="tab-pane" id="kt_widget6_tab2_content" aria-expanded="false">
                        <div class="kt-notification">
                            @forelse($readNotifications as $notification)
                                <a href="{{route('dashboard.notifications.mark_as_read', $notification->id)}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg> </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                                {{__($notification->data['message']) . ' ' .  \Carbon\Carbon::today()->translatedFormat('Y-M-d')}}
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{$notification->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                    <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                        <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                            {{__('All caught up!')}}
                                            <br>{{__('No new notifications.')}}
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_widget6_tab3_content" aria-expanded="false">
                        <div class="kt-notification">
                            @forelse($unReadNotifications as $notification)
                                <a href='{{route('dashboard.notifications.mark_as_read', $notification->id)}}' class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg> </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                                {{__($notification->data['message']) . ' ' .  \Carbon\Carbon::today()->translatedFormat('Y-M-d')}}
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{$notification->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                    <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                        <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                            {{__('All caught up!')}}
                                            <br>{{__('No new notifications.')}}
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end:: Widgets/Notifications-->
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/datatables/roles.js')}}" type="text/javascript"></script>
@endpush
