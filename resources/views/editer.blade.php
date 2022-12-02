@extends('master.layout')
@section('title')
editer le {{$post->title}}
@endsection
@section('content')
@include('master.navbar')
<div class="row my-4">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-hader">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <h3 class="card-title">
                  modifier la publication {{$post->title}}
                </h3>
                <div class="card-body">
                    <form action="{{ route('posts.update',$post->slug) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Titre</label>
                            <input type="text" class="form-control" value="{{ $post->title}}" name="title" placeholder="titre">
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Desciption</label>
                            <textarea class="form-control"  name="body" placeholder="description" id="exampleFormControlTextarea1" rows="3">{{ $post->body }}</textarea>
                          </div>
                          <div class="mb-3">
                            <button class="btn btn-primary">valider</button>
                          </div>
                          
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection