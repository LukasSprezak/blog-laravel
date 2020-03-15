@extends('base')
@section('title', $article->title)
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ $article->title }}</h2>
                    <p class="card-text">{{ $article->content }}</p>
                    <p>{{ $article->created_at->diffForHumans() }}</p>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>

        <div class="col-md-4">
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
                <h5 class="card-header">Tagi</h5>
                <div class="container">
                    @if($article->tags->count() > 0)
                        @foreach($article->tags as $tag)
                            <a href="{{ route('article.tags', $tag->slug) }}" class="badge badge-primary">{{ $tag->name }}</a>
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @if($article->comments->count() > 0)
        <h2>{{ $article->comments->count() > 1 ? 'Comments' : 'Comment' }} {{ $article->comments->count() }}</h2>
    </div>
        <form method="POST" action="{{ route('comment.article.create') }}">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="Comment content...">{{ old('comment') }}</textarea><br/>
            <button class="btn btn-primary">Send</button>
        </form>
    <hr>
    @foreach($article->comments as $comment)
    <div class="row comment">
        <div class="head">
            <small><strong class='user'>{{ $comment->owner->name }}</strong> {{ $comment->created_at->format('d.m.Y') }}</small>
        </div>
        <p>{{ $comment->comment }}</p>
    </div>
    <hr>
    @endforeach
</div>
    @endif
@endsection