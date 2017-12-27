@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-{{ $message['level'] }} {{ $message['important'] ? 'alert-important' : '' }}" role="alert">
            @if ($message['important'])
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @endif
            <div class="row justify-content-center">
                <div class="col-2">
                <span class="text-center d-block">
                    <i class="fa @if($message['level'] === 'danger') fa-exclamation-circle @elseif($message['level'] === 'warning') fa-exclamation-triangle @elseif($message['level'] === 'info') fa-info-circle @else fa-check @endif"
                       aria-hidden="true" style="font-size: 6rem"></i>
                </span>
                </div>
                <div class="col-9">
                    {!! $message['message'] !!}
                </div>
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
