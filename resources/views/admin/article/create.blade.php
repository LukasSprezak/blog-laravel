@extends('baseAdmin')
@section('title', 'New Article')
@section('body')
<div class="container">
    <form method="POST" action="{{ route('admin.article.create') }}">
        @csrf
        <div class="form-fieldset">
            <input class="form-field{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" placeholder="Title" value="{{ old('title') }}">
        </div>
        <div class="form-fieldset">
            <input class="form-field{{ $errors->has('status') ? ' is-invalid' : '' }}" type="text" name="status" placeholder="Status" value="{{ old('status') }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Content">{{ old('content') }}</textarea>
        </div>
        <button class="button">Add post</button>
    </form>
</div>
@endsection