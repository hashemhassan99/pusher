<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::get();
        return view('home',compact('posts'));
    }

    public function save(Request $request){
        Comment::create([
            'post_id' =>$request->post_id ,
            'user_id' => Auth::id(),
            'comment' => $request->post_content,
        ]);
        return redirect()->back()->with(['success' => 'your comment is added successfully']);
    }
}
