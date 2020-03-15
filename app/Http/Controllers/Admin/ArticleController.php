<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{
    public function __construct()
    {
       // $this->authorize('administerArticle');
        $this->middleware('auth');
    //    $this->middleware('can:administerArticle');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $article = new Article();
        $article->save();
        */
        $data = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'nullable'

        ]);
        $data['user_id'] = $request->user()->id;
        $article = Article::create($data);
        session()->flash('message', "Success add article");
        return redirect(route('single.article', $article->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::whereId($id)->first();
        if(is_null($article)) return abort(404);
        return view('admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::whereId($id)->first();
        if(is_null($article)) return abort(404);
        $article->update($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $article = Article::whereId($id)->first();
        if(is_null($article)) return abort(404);
        $article->delete();
        return redirect('/');
    }
}
