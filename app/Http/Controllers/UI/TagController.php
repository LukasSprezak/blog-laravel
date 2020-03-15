<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Model\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug)
    {
        $articles = Article::published()
            ->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->latest('created_at')
            ->paginate(5);

        return view('pages.posts', compact('articles'));
    }
}
