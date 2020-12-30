@extends('layouts.dashboard')


@section('content')

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_chat_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
            <div class="kt-chat">
                <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                    <div class="kt-portlet__head">
                        <div class="kt-chat__head ">
                            <div class="kt-chat__left">

                                <!--begin:: Aside Mobile Toggle -->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md kt-hidden-desktop" id="kt_chat_aside_mobile_toggle">
                                    <i class="flaticon2-open-text-book"></i>
                                </button>

                                <!--end:: Aside Mobile Toggle-->
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-more-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-left dropdown-menu-md">

                                        <!--begin::Nav-->
                                        <ul class="kt-nav">
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-group"></i>
                                                    <span class="kt-nav__link-text">New Conversation</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!--end::Nav-->
                                    </div>
                                </div>
                            </div>
                            <div class="kt-chat__center">
                                <div class="kt-chat__label">
                                    <a href="#" class="kt-chat__title">{{$receiver->name}}</a>
{{--                                    <span class="kt-chat__status">--}}
{{--                                        <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active--}}
{{--                                    </span>--}}
                                </div>
{{--                                <div class="kt-chat__pic kt-hidden">--}}
{{--                                    <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Jason Muller" data-original-title="Tooltip title">--}}
{{--                                        <img src="assets/media/users/300_12.jpg" alt="image">--}}
{{--                                    </span>--}}
{{--                                    <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Nick Bold" data-original-title="Tooltip title">--}}
{{--                                        <img src="assets/media/users/300_11.jpg" alt="image">--}}
{{--                                    </span>--}}
{{--                                    <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Milano Esco" data-original-title="Tooltip title">--}}
{{--                                        <img src="assets/media/users/100_14.jpg" alt="image">--}}
{{--                                    </span>--}}
{{--                                    <span class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-placement="right" title="Teresa Fox" data-original-title="Tooltip title">--}}
{{--                                        <img src="assets/media/users/100_4.jpg" alt="image">--}}
{{--                                    </span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="kt-chat__right">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon2-add-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="" data-mobile-height="300">
                            <div class="kt-chat__messages">
                                @forelse($messages as $message)
                                    @if($message->sender_id == auth()->user()->id)
                                        <div class="kt-chat__message kt-chat__message--right">
                                            <div class="kt-chat__user">
                                                <span class="kt-chat__datetime">{{$message->created_at->diffForHumans()}}</span>
                                                <a href="#" class="kt-chat__username">You</a>
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <div class="kt-user-card-v2">
                                                        <div class="kt-user-card-v2__pic">
                                                            <div class="kt-badge kt-badge--xl kt-badge--success">{{ ucwords(mb_substr( auth()->user()->name() ,0,2,'utf-8'))}}</div>
                                                        </div>
                                                    </div>
                                                </span>

                                            </div>
                                            <div class="kt-chat__text kt-bg-light-brand" dir="auto">
                                                {{$message->content}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="kt-chat__message">
                                            <div class="kt-chat__user">
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <div class="kt-user-card-v2">
                                                        <div class="kt-user-card-v2__pic">
                                                            <div class="kt-badge kt-badge--xl kt-badge--success">{{ ucwords(mb_substr( $message->sender->name ,0,2,'utf-8'))}}</div>
                                                        </div>
                                                    </div>
                                                </span>
                                                <a href="#" class="kt-chat__username">{{$message->sender->name}}</span></a>
                                                <span class="kt-chat__datetime">{{$message->created_at->diffForHumans()}}</span>
                                            </div>
                                            <div class="kt-chat__text kt-bg-light-success" dir="auto">
                                                {{$message->content}}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="kt-chat__message text-center" style="padding: 8% 0">
                                        <div class="">
                                            Enter new message
                                        </div>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-chat__input">
                            <form id="message_body" method="post" action="{{route('dashboard.messages.store')}}">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{$receiver->id}}">
                                <input type="hidden" name="conversation_id" value="{{$conversation->id}}">
                                <div class="kt-chat__editor">
                                    <textarea id="message" name="message" style="height: 50px" placeholder="Type here..."></textarea>
                                </div>
                                <div class="kt_chat__actions">
                                    <button id="reply" disabled  type="submit" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply">reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--End:: App Content-->
    </div>

    <!--End::App-->
@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/custom/chat/chat.js')}}" type="text/javascript"></script>
    <script>
        $(function(){
            let message = $("#message");
            let replyBtn = $("#reply");
            message.keyup(function (){
                if ($.trim(message.val()) === ""){
                    replyBtn.attr('disabled', true);
                }else{
                    replyBtn.attr('disabled', false);
                }
            });
           // $("#reply").click(function (){
           //     $.ajax({
           //         url: '/dashboard/messages',
           //         type: 'post',
           //         data:  $("#message_body").serialize() ,
           //         success: function (data) {
           //             swal.fire("Good job!", "Message Sent Successfully!", "success");
           //
           //
           //         },
           //         error:function(data)
           //         {
           //             let response = data.responseJSON;
           //             let errors = '';
           //             $.each(response.errors, function( index, value ) {
           //                 errors += value + '\n';
           //             });
           //             swal(locator.__(response.message), errors, "info");
           //         }
           //
           //     });
           // });;
        });
        document.getElementById( 'reply' ).scrollIntoView();
    </script>
@endpush
