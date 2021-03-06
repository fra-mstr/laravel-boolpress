@extends('layouts.boolpress')

@section('title')
  Informazioni Post
@endsection

@section('content')
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      <div class="">
        <b>Author</b>
      </div>
      <div class="">
        {{$post->author}}
      </div>
    </li>
    <li class="list-group-item">
      <div class="">
        <b>Title</b>
      </div>
      <div class="">
        {{$post->title}}
      </div>
    </li>
    <li class="list-group-item">{{$info->description}}</li>
    <li class="list-group-item">
      <div class="">
        <b>Categories</b>
      </div>
      <div class="">
        <ul>
          <li>{{$category->title}}</li>
        </ul>
      </div>
    </li>
  </ul>
  <a href="{{ route('posts.edit', $post->id) }}">Modifica</a><br>
  <a href="{{ route('posts.index')}}">Indietro</a><br>
  <form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    @method("delete")
    <button type="submit" class="btn btn-danger">Elimina</button>
  </form>
</div>
@endsection
