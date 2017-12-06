@if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div class="row">
            <div class="col-md-2">
                <span class="text-center" style="display: block">
                    <i class="fa @if(session('flash_notification.level') === 'danger') fa-exclamation-circle @elseif(session('flash_notification.level') === 'warning') fa-exclamation-triangle @elseif(session('flash_notification.level') === 'info') fa-info-circle @else fa-check @endif"
                       aria-hidden="true" style="font-size: 6em"></i>
                </span>
            </div>
            <div class="col-md-9">
                {!! session('flash_notification.message') !!}
            </div>
        </div>
    </div>
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