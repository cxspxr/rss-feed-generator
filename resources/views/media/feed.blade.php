@extends('layouts.app')

@section('title')
    {{ $media->title }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $media->title }}</h1>
            @foreach($articles as $article)
                @auth
                    <form
                        action="{{ route('media.read') }}"
                        method="post"
                        class="card"
                        name="read-form"
                        style="cursor:pointer; margin-bottom: 10px;"
                        onclick = "document.forms['read-form'].submit()"
                    >
                        {{ csrf_field() }}
                        <input type="hidden" name="tags" value="{{ $article->tags }}">
                        <input type="hidden" name="link" value="{{ $article->link }}">

                        @include('partials.article', ['article' => $article])
                    </form>
                @else
                    <a class="nostyle card" style="display:block; margin-bottom: 10px;"
                        href="{{ $article->link }}">

                        @include('partials.article', ['article' => $article]);
                    </a>
                @endauth
            @endforeach
        </div>
    </div>
</div>
@endsection
