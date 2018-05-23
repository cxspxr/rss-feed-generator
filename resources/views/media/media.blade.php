@extends('layouts.app')

@section('title')
    Suggested media
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($media as $m)
                <div class="nostyle card" style="display:block; margin-bottom: 10px;">
                    <div class="card-header">
                        <a href="{{ route('media.feed', $m) }}">{{ $m->title }}</a>
                        @if($user->subscribedTo($m))
                            <a href="{{ route('media.unsubscribe', $m) }}" class="btn btn-sm float-right btn-secondary unsubscribe">
                                Unsubscribe
                            </a>
                        @else
                            <a href="{{ route('media.subscribe', $m) }}" class="btn btn-sm btn-info float-right subscribe">
                                Subscribe
                            </a>
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($m->categories as $category)
                            <li class="list-group-item">
                                {{ $category->title }}
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            <b>Subscribers: {{ count($m->subscribers) }}</b>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
