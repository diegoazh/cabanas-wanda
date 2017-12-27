@if(session()->has('flash_notification') || count($errors) > 0)
    <div id="alerts_errors_messages" class="row justify-content-center">
        <div class="col-12 col-md-6">
            @include('messages_alerts.messages-and-errors')
        </div>
    </div>
@endif
<div id="content">
    @yield('content')
</div>
