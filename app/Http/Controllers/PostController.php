<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class PostController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::latest()->paginate(6);
        // $helo="hello man";
        return view('home')->with([
            // 'hello'=>$helo ,
            // 'name'=>$name
            'posts'=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
        return view('create');
       
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
        if($request->has('image')){
            $file=$request->image;
            $image_name=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'),$image_name);
        }
        
         Post::create(
             [
               'title'=>$request->title,
               'body'=>$request->body,
               'slug'=>Str::slug($request->title),
               'image'=>$image_name,
               'user_id'=>auth()->user()->id
             ]
             );
              return redirect()->route('home')->with([
                  'success'=>'article ajoute'
              ]);
         // $post=new Post();
         // $post->title=$request->title;
         // $post->slug=Str::slug($request->title);
         // $post->body=$request->body;
         // $post->image="";
         // $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        
        return view('show')->with([
            'post'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('editer')->with([
            'post'=>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        if($request->has('image')){
            $file=$request->image;
            $image_name=time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'),$image_name);
            if($post->image!=null){
            unlink(public_path('uploads/').$post->image);}
            $post->image=$image_name;
          
        }
        if(auth()->user() !== null){
            $d=auth()->user()->id;
        }
        else
        $d=0;
        
        $post->update(
            [
              'title'=>$request->title,
              'body'=>$request->body,
              'slug'=>Str::slug($request->title),
              'image'=>$post->image,
              'user_id'=>$d
            ]
            );
            return redirect()->route('home')->with([
                'success'=>'article edite!!'
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if(file_exists(public_path('./uploads/').$post->image)){
        if($post->image!=null){
            unlink(public_path('uploads/').$post->image);}}
         $post->delete();
         return redirect()->route('home')->with([
            'success'=>'article deleted'
        ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function delete($slug)
    {
        //
        $post=Post::withTrashed()->where('slug',$slug)->first();
        if(file_exists(public_path('./uploads/').$post->image)){
        if($post->image!=null){
            unlink(public_path('uploads/').$post->image);}}
         $post->forceDelete();
         return redirect()->route('home')->with([
            'success'=>'article deleted definitivement'
        ]);

    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function restore($slug)
    {
        //
        $post=Post::withTrashed()->where('slug',$slug)->first();
      
         $post->restore();
         return redirect()->route('home')->with([
            'success'=>'article recupere'
        ]);

    }
}
