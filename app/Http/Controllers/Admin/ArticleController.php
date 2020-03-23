<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddProductPhoto;
use App\Model\Article;
use App\Model\ArticlePhotos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use File;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administerArticle');
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
            'content' => 'nullable',
            'imageName' => 'nullable|image|mimes:jpg,jpeg,png|max:1024'

        ]);

        if (isset($data['imageName'])) {
            $path = $request->file('imageName')->store('article_image');
            $data['imageName'] = $path;
        }

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
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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

        $oldImage = $article->image;

        if (isset($data['imageName'])) {
            $path = $request->file('imageName')->store('article_image');
            $data['imageName'] = $path;
        }

        $article->update($data);

        if (isset($data['image'])) {
            Storage::delete($oldImage);
        }

        return back()->with('message', 'Post has been updated!');
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

    public function addPhoto($product_id, AddProductPhoto $request) {
        $photo = $request->file('photo');
        $filename = uniqid() . '.' . $photo->getClientOriginalExtension();

        $product = Article::findOrFail($product_id);
        $product->photos()->create([
            'photo' => $filename,
        ]);

        Storage::disk('public')->putFileAs(
            'article/',
            $photo,
            $filename
        );

        return back()->with([
            'status' => [
                'type' => 'success',
                'content' => 'Zdjęcie zostało dodane',
            ]
        ]);
    }

    public function deletePhoto($article_id, $photo_id) {
        $photo = ArticlePhotos::where('article_id', $article_id)->findOrFail($photo_id);

        File::delete('article/' . $photo->photo);

        $photo->delete();

        return back()->with([
            'status' => [
                'type' => 'success',
                'content' => 'Zdjęcie zostało usunięte',
            ]
        ]);
    }
}
