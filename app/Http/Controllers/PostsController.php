<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Friendship;
use DB;
use App\Comment;
use Carbon\Carbon;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $get_post_id;
    private $dd;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function comment(Request $request){
        $this->get_post_id = $request->input('post_id');

        $comments = Comment::where('post_id', $this->get_post_id)->get();

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $this->get_post_id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect('/posts');
        return view('posts.index')->with('comments', $comments);
    }

    public function index()
    {

        if(auth()->user()->id == null){
            redirect('/login');
        }else{
            //$posts = Post::all();
            //return Post::where('title', 'First Post')->get();
            //$posts = DB::select('select * from posts');
            //$posts = Post::orderBy('title','desc')->take(1)->get();
            //$posts = Post::orderBy('title','desc')->get();

            // $comment = Comment::where('post_id', $this->get_post_id)->get();
            // echo $this->get_post_id;
            // echo $this->dd;

            $user_id = Auth()->user()->id;
            $friends = Friendship::where('user_requested', $user_id);   

            $data = array(
                "posts" => Post::orderBy('created_at','desc')->paginate(10),
                "users" => User::orderBy('created_at','desc')->paginate(10),
                'friends' => Friendship::where('user_requested', $user_id)->get(),
                'auth_user' => Auth()->user()->id
                //"comments" => Comment::where('post_id', $this->get_post_id)->get(),
                //"under" => $this->get_post_id
            );

            // $dates = Carbon::now()->addDays('{{$posts->created_at}}')->diffForHumans();

            return view('posts.index')->with($data);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->id == null){
            redirect('/login')
        }else{
            return view('posts.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->id == null){
            redirect('/login');
        }else{
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);
    
            //Handle file Upload
            if($request->hasFile('cover_image')){
                //Get file name with extension
                $fileNameWWithExt = $request->file('cover_image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //FileNameToStore
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }else{
                $fileNameToStore = 'noimage.jpg';
            }
    
            //Create Post
            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->cover_image = $fileNameToStore;
            $post->save();
    
            return redirect('/posts')->with('success','Post Created');
        }
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
        if(Auth()->user()->id === null){
            redirect('/login');
        }else{
            $user_id = Auth()->user()->id;

            $data = array(
                "posts" => Post::orderBy('created_at','desc')->get(),
                "users" => User::orderBy('created_at','desc')->paginate(10),
                'friends' => Friendship::where('user_requested', $user_id)->get(),
                'auth_user' => Auth()->user()->id,
                'post1' => Post::find($id)
                //"comments" => Comment::where('post_id', $this->get_post_id)->get(),
                //"under" => $this->get_post_id
            );

            
            return view('posts.show')->with($data);
        }
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
        $post = Post::find($id);

        // check for correct user
        if(auth()->user()->id == null){
            redirect('login');
        }else{
            if(auth()->user()->id !== $post->user_id){
                return redirect('/posts')->with('error', 'Unauthorized Page');    
            }
    
            return view('posts.edit')->with('post', $post);
        }
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            //Get file name with extension
            $fileNameWWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //FileNameToStore
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
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
        $post = Post::find($id);

        if(auth()->user()->id == null){
            redirect('/login')
        }
        else{
            if(auth()->user()->id !== $post->user_id){
                return redirect('/posts')->with('error', 'Unauthorized Page');    
            }
    
            if($post->cover_image != 'noimage.jpg'){
                //Delete Image
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
    
            $post->delete();
    
            return redirect('/posts')->with('success','Post Deleted');
        }
    }

    
}
