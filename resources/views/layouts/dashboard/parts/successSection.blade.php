<div class="alert alert-solid-success alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
    <div class="alert-icon"><i class="fa fa-check-circle"></i></div>
    <div class="alert-text">{{__('Changes Has Been Saved Successfully !')}}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>

@push('scripts')
    <script>
        $(function (){
            $(".alert").fadeOut(3000)
        });
    </script>
@endpush
