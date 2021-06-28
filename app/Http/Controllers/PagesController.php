<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Welcome to my Social Media application";
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title',$title);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return("This is the show method");
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

    public function about()
    {
        $data = array(
            'title' => 'About',
            'services' => ['web design', 'programming' , 'SEO'] 
        );
        return view('pages.about')->with($data);
    }

    public function profile(){

        // $data = array(
        //     "user_name" => auth()->user()->name,
        //     "email" => auth()->user()->email,
        // );

        

    }

    public function notification(){


        if(!Auth::check()){
            return view('auth.login');
            
        }
        else{
            $user = Auth()->user()->id;
            $pendings = User::find($user)->pending_friend_request();

            return view('pages.notification')->with('pendings',$pendings);
        }

    }

    public function search_user(Request $request){

    

        $name = $request->input('name');

        $users = User::where('name', $name)->get();
        return view('pages.search_user')->with('users',$users);
    }

    public function search_post(Request $request){

        $title = $request->input('title');

        $posts = Post::where('title', $title)->get();
        return view('pages.search_post')->with('posts',$posts);
    }

    public function services()
    {
        $title = 'Services';
        return view('pages.services')->with('title' ,$title);
    }
}
