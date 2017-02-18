@if (session()->has('flash_notification.message') || count($errors) > 0)
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            @include('messages_alerts.flash-and-errors')
        </div>
    </div>
@endif
@if(isset($customContent) && $customContent)
    @yield('content')
@else
    <div id="content" class="row">
        @yield('content')
    </div>
@endif