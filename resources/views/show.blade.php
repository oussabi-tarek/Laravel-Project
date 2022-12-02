@extends('master.layout')
@section('titl')
{{$post->image}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                
                  <div class="col-md-6">
                  <div class="card" style="width: 18rem;">
                    <img src="{{asset('./uploads/'.$post->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $post['title']}}</h5>
                      <h5 class="card-title">{{ $post['body']}}</h5>
                      
                    </div>
                </div>
               @if(auth()->check())
               @if(auth()->user()->id==$post->user_id || auth()->user()->is_admin)
               <a href="{{route('posts.edit',$post->slug)}}" class="btn btn-warning">editer</a>
               <form id="{{$post->id}}" method="POST" action="{{route('posts.destroy',$post->slug)}}">
               @csrf
               @method('DELETE')
               </form>
               <button type="submit" onclick="event.preventDefault();
                        if(confirm('etes vous sur?')) document.getElementById({{$post->id}}).submit();"
                        class="btn btn-danger">supprimer</button>
               @endif
               @endif
                </div>
              
                </div>
            
        </div>
    </div>
</div>
@endsection