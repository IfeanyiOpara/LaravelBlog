<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Friendship;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->id){
            redirect('/login');
        }else{
            $id = Auth()->user()->id;
    
            $data = Array(
                "user" => User::find($id),
                "friends" => collect(User::find($id)->friends()),
                "posts" => Post::orderBy('created_at','desc')->paginate(10),
                "friends_list" => User::find($id)->friends()
            );


                return view('pages.profile')->with($data);   
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
        
        if(auth()->user()->id){
            redirect('//login');
        }
        else{
            $this->validate($request, [
                // 'title' => 'required',
                // 'body' => 'required',
                'profile_image' => 'image|nullable|max:1999'
            ]);
    
            if($request->hasFile('profile_image')){
                //Get file name with extension
                $fileNameWWithExt = $request->file('profile_image')->getClientOriginalName();
                //Get just file name
                $fileName = pathinfo($fileNameWWithExt, PATHINFO_FILENAME);
                //Get just ext
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                //FileNameToStore
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('profile_image')->storeAs('public/profile_image', $fileNameToStore);
            }
    
            $user = User::find($id);
            $user->name = $request->input('name');
            // $user->password = $request->input('password');
            if($request->hasFile('profile_image')){
                $user->profile_image = $fileNameToStore;
            }
            $user->save();
    
            return redirect('/profile')->with('success','Profile Updated');
        }
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
