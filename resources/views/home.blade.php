@extends('master.layout')
@section('titl')
Acceuil

@endsection

@section('content')
@include('master.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-10">
          @if(session()->has('success'))
            <div class="alert alert-success">
              {{session()->get('success')}}
            </div>
          @endif
            <div class="row">
                @foreach ($posts as $item)
                  <div class="col-md-6 ">
                  <div class="card h-100"  style="width: 18rem;">
                    @if(Str::contains($item->image, 'http'))
                    <img src="{{ $item['image'] }}" class="card-img-top" alt="...">                
                    @else 
                    <img src="{{asset('./uploads/'.$item->image) }}" class="card-img-top" alt="...">                
                    @endif
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->title}}</h5>                      
                      <h5 class="card-title">{{ $item->user ? $item->user->name:null}}</h5>
                      <h5 class="card-title">{{ $item['body']}}</h5>
                      <a href="{{ route('posts.show',$item->slug)}}" class="btn btn-primary">voir</a>
                    </div>
                </div>
                </div>
                @endforeach
                </div>
                <div class="justify-content-center">
                  {{$posts->links()}}
                </div>
        </div>
    </div>
</div>
@endsection