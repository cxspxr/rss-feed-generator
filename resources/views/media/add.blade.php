@extends('layouts.app')

@section('title')
    Add media
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new media resource') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('media.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('*Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rss" class="col-md-4 col-form-label text-md-right">{{ __('*RSS') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Valid RSS" id="rss" type="text" class="form-control{{ $errors->has('rss') ? ' is-invalid' : '' }}" name="rss" value="{{ old('rss') }}">

                                @if ($errors->has('rss'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rss') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('*Categories') }}</label>

                            <div class="col-md-6">
                                <input id="categories" placeholder="Separated by commas..." type="text" class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }}" name="categories" value="{{ old('categories') }}" >

                                @if ($errors->has('categories'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add a media') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
