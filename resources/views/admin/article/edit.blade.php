@extends('baseAdmin')
@section('title', 'Edit Article')
@section('body')
    <div class="container">
        <form method="POST" action="{{ route('admin.article.edit', $article->id) }}">
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
        <div class="col-4">
            <div class="card">
                <div class="card-header">Zdjęcia</div>
                <div class="card-body">
                    <form action="{{ route('addPhoto', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-1">
                            <div class="custom-file">
                                <input type="file" name="photo" id="photo" class="custom-file-input">
                                <label for="photo" class="custom-file-label">Wybierz plik</label>
                            </div>
                            @if ($errors->has('photo'))
                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Dodaj zdjęcie</button>
                        </div>

                        @if ($article->photos->count())
                            <table class="table">
                                @foreach ($article->photos as $photo)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/article/' . $photo->photo) }}" width="100">
                                        </td>
                                        <td>
                                            <a href="{{ route('deletePhoto', [$article->id, $photo->id]) }}" class="btn btn-danger btn-sm">Usuń</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection