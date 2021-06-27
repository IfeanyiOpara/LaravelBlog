<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Post;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $get_post_id;

    public function index()
    {
        //

        $post_id = $this->get_post_id;
        //$comment = Comment::where('post_id', $post_id)->get();

        $data = array(
            "posts" => Post::orderBy('created_at','desc')->paginate(10),
            "users" => User::orderBy(DB::raw('RAND()'))->paginate(10),
            "comments" => Comment::where('post_id', $post_id)->get()
        );

        // $dates = Carbon::now()->addDays('{{$posts->created_at}}')->diffForHumans();

        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->get_post_id = $request->input('post_id');


        // $comment = new Comment;
        // $comment->user_id = auth()->user()->id;
        // $comment->post_id = $get_post_id;
        // $comment->comment = $request->input('comment');
        // $comment->save();

        // return redirect('/comment');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
