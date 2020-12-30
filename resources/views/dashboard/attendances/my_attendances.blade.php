@extends('layouts.dashboard')
@push('styles')
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Attendance')}}
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

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('My Attendance')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!-- begin:: Content -->
            <div class="row">
                <div class="col-lg-12">

                    <!--begin::Portlet-->
                    <div class="kt-portlet" id="kt_portlet">
                        <div class="kt-portlet__body">
                            <div id="kt_calendar"></div>
                        </div>
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
            <!-- end:: Content -->
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>

{{--    <script src="{{asset('assets/js/pages/components/calendar/basic.js')}}" type="text/javascript"></script>--}}
    <script>
        $(function (){
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                isRTL: KTUtil.isRTL(),
                header: {
                    @if(App::isLocale('ar')) left: 'next,prev today' @else left: 'prev,next today' @endif,
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    dayGridMonth: { buttonText: '{{__('month')}}' },
                    timeGridWeek: { buttonText: '{{__('week')}}' },
                    timeGridDay: { buttonText: '{{__('day')}}' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: false,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: [
                    @foreach($my_attendances as $attendance)
                        {
                            title: '{{__('Time In')}} : {{$attendance->time_in->format("h:i A")}}',
                            start: '{{$attendance->created_at->format('Y-m-d')}}',
                            description: '{{__('Time In')}}',
                            className: "fc-event-white fc-event-solid-warning"
                        },
                    @if(isset($attendance->time_out))
                        {
                            title: '{{__('Time Out')}} : {{$attendance->time_out->format("h:i A")}}',
                            start: '{{$attendance->created_at->format('Y-m-d')}}',
                            description: '{{__('Time Out')}}',
                            className: "fc-event-white fc-event-solid-brand"
                        },
                    @endif
                    @endforeach
                ],

                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });
            calendar.setOption('locale', '{{App::getLocale()}}');
            calendar.render();
        });
    </script>
@endpush
