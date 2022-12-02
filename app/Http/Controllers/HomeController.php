<?php

namespace App\Http\Controllers;

use App\Models\Post;
// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use App\Http\Controllers\paginate;
// use App\Http\Requests\PostRequest;
// use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    //
    public function index($name=null){
       $posts=Post::latest()->paginate(6);
     
        return view('home')->with([
            // 'hello'=>$helo ,
            // 'name'=>$name
            'posts'=>$posts
        ]);
    }
 
  
    // public function store(PostRequest $request) {
    //         // return dd($request->all());pour l affichge des elements ajoutes par la forme
    //         // $this->validate($request,['title'=>'required|min:3|max:10','body'=>'required|min:3|max:12']);
    //         //ou :$request->validate(['title'=>'required|min:3|max:10','body'=>'required|min:3|max:12']);
    //        if($request->has('image')){
    //            $file=$request->image;
    //            $image_name=time().'_'.$file->getClientOriginalName();
    //            $file->move(public_path('uploads'),$image_name);
    //        }
           
    //         Post::create(
    //             [
    //               'title'=>$request->title,
    //               'body'=>$request->body,
    //               'slug'=>Str::slug($request->title),
    //               'image'=>$image_name,
    //               'user_id'=>auth()->user()->id
    //             ]
    //             );
    //              return redirect()->route('home')->with([
    //                  'success'=>'article ajoute'
    //              ]);
    //         // $post=new Post();
    //         // $post->title=$request->title;
    //         // $post->slug=Str::slug($request->title);
    //         // $post->body=$request->body;
    //         // $post->image="";
    //         // $post->save();
    // }

    // public function editer($slug){
    //     $post=Post::where('slug',$slug)->first();
    //     return view('editer')->with([
    //         'post'=>$post
    //     ]);
    // }
    // public function update(PostRequest $request,$slug){
    //     $post=Post::where('slug',$slug)->first();
    //     if($request->has('image')){
    //         $file=$request->image;
    //         $image_name=time().'_'.$file->getClientOriginalName();
    //         $file->move(public_path('uploads'),$image_name);
    //         if($post->image!=null){
    //         unlink(public_path('uploads/').$post->image);}
    //         $post->image=$image_name;
          
    //     }
    //     if(auth()->user() !== null){
    //         $d=auth()->user()->id;
    //     }
    //     else
    //     $d=0;
        
    //     $post->update(
    //         [
    //           'title'=>$request->title,
    //           'body'=>$request->body,
    //           'slug'=>Str::slug($request->title),
    //           'image'=>$post->image,
    //           'user_id'=>$d
    //         ]
    //         );
    //         return redirect()->route('home')->with([
    //             'success'=>'article edite!!'
    //         ]);
    // }
    // public function delete($slug){
    //     $post=Post::where('slug',$slug)->first();
    //     if($post->image!=null){
    //         unlink(public_path('uploads/').$post->image);}
    //      $post->delete();
    //      return redirect()->route('home')->with([
    //         'success'=>'article deleted'
    //     ]);
    //         }

}

