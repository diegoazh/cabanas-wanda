@if (session()->has('flash_notification.message') || count($errors) > 0)
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            @include('messages_alerts.flash-and-errors')
        </div>
    </div>
@endif
<div id="content">
    @yield('content')
</div>
