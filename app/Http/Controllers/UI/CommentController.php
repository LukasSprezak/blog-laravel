<?php
declare(strict_types=1);

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommentController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'article_id' => 'required|numeric',
            'comment' => 'required|min:3'
        ]);

        Comment::create(Arr::add($data, 'user_id', $request->user()->id));
        return back()->with('message', 'Success, add comment.');
    }
}