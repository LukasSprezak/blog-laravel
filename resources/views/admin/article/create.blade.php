@extends('baseAdmin')
@section('title', 'New Article')
@section('body')
<div class="container">
    <form method="POST" action="{{ route('admin.article.create') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-fieldset">
            <input class="form-field{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" placeholder="Title" value="{{ old('title') }}">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Image:</label>
            <input type="file" name="imageName">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Published:</label>
            <input type="checkbox" name="published" value="1">
        </div>
        <div class="form-fieldset">
            <label class="form-label">Tags:</label>
            <input class="form-field" type="text" name="tags">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Content">{{ old('content') }}</textarea>
        </div>
        <button class="button">Add post</button>
    </form>
</div>
@endsection