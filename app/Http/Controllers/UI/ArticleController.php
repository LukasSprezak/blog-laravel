<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Model\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::latest('created_at')
            ->enabled()
            ->paginate(5);
        return view('ui.index', compact('articles'));
    }

    public function details($slug)
    {
        $article = Article::enabled()
            ->whereSlug($slug)
            ->first();
        if(is_null($article)) return abort(404);
        return view('ui.single_article', compact('article'));
    }
}
