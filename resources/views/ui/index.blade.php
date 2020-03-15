@extends('base')
@section('title', 'Articles')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Article</h2>
                @foreach($articles as $article)
                    <div class="card mb-4">
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ $article->title }}</h2>
                            <p class="card-text">{{ $article->content }}</p>
                            <p class="card-text">{{ $article->created_at->diffForHumans() }} by {{ $article->owner->name }}</p>
                            <a href="{{ route('single.article', ['slug' => $article->slug]) }}" class="btn btn-primary">Czytaj dalej &rarr;</a>
                        </div>
                        @if($article->tags->count() > 0)
                            <div class="card-footer text-muted">
                                <p>Tagi:</p>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('article.tags', $tag->slug) }}" class="badge badge-primary">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 mt-4">
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <h5 class="card-header">Kategoria</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">

                                    <li>
                                        <a href=""></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-4">
                    <h5 class="card-header">Widget</h5>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        {{ $articles->links() }}
    </div>
@if($articles->count() > 0)
    <h2>Nie masz żadnego posta.</h2>
@endif
@endsection