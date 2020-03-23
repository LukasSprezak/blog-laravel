<?php


namespace App\Http\Controllers\UI;


use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function showSort()
    {
        $posts = Post::orderBy('position','ASC')->select('id', 'title', 'position', 'created_at')->get();

        return view('sort.sort',compact('posts'));
    }

    public function position_update(Request $request){
        $request->validate([
            'positions'=>'required'
        ]);

        foreach ($request->positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            $menu = Post::find($index);

            $menu->position = $newPosition;

            $menu->save();
        }

        return response()->json('success');
    }
}