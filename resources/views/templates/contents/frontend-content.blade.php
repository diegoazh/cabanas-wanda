@if(isset($customContent) && $customContent)
    @yield('content')
@else
    <div id="content" class="row">
        @yield('content')
    </div>
@endif