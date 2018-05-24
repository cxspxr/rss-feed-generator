@extends('layouts.app')

@section('title')
    Suggested media
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($media as $m)
                <div class="nostyle card" style="display:block; margin-bottom: 10px;">
                    <div class="card-header" style="display:flex; justify-content: space-between; align-items: center">
                        <a href="{{ route('media.feed', $m) }}">{{ $m->title }}</a>
                        @include('partials.subscription', [
                            'media' => $m
                        ])
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
            @empty
                <div class="card">
                    <div class="card-body">
                        There are no media resources yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
