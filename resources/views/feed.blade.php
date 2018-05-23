@extends('layouts.app')

@section('title')
    My Feed
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($articles as $article)
                    @auth
                        <form
                            action="{{ route('media.read') }}"
                            method="post"
                            class="card card-info"
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
                @empty
                    <div class="card">
                        <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            <div class="alert alert-warning">
                                You have no subscriptions,
                                <a href="{{ route('media.index') }}">choose at least one</a>
                                to begin with
                            </div>

                            News are one step ahead buddy.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
