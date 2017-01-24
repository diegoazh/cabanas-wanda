@include('flash::message')
@if(count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif