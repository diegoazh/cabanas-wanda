@if (session()->has('flash_notification'))
    @include('flash::message')
@endif
@if(count($errors) > 0)
    <div class="alert alert-warning" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif