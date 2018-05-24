@auth
    @if($user->subscribedTo($media))
        <a href="{{ route('media.unsubscribe', $media) }}" class="btn btn-sm btn-secondary unsubscribe">
            Unsubscribe
        </a>
    @else
        <a href="{{ route('media.subscribe', $media) }}" class="btn btn-sm btn-info subscribe">
            Subscribe
        </a>
    @endif
@endauth
