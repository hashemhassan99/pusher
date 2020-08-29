<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewNotification;
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
        $posts = Post::with(['comments' => function($q){
            $q->select('id','post_id','comment');
        }])->get();
        return view('home',compact('posts'));
    }

    public function save(Request $request){
        Comment::create([
            'post_id' =>$request->post_id ,
            'user_id' => Auth::id(),
            'comment' => $request->post_content,
        ]);
        $data = [
            'user_id' => Auth::id(),
            'comment' => $request->post_content,
            'post_id' => $request->post_id,
        ];
        event(new NewNotification($data));
        return redirect()->back()->with(['success' => 'your comment is added successfully']);
    }
}
