@if ($errors->any())
    <div class="alert alert-danger text-center" style="margin: 0 40px">
        <div class="col-lg-4 mx-auto">
            <h3>{{ __('Whoops! Something went wrong.') }}</h3>
{{--            <ul>--}}
                @foreach ($errors->all() as $error)
                    <h4>{{ $error }}</h4>
                @endforeach
{{--            </ul>--}}
        </div>
    </div>
@endif
