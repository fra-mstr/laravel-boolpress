@extends('layouts.boolpress')

@section('title')
  Elenco Post
@endsection

@section('content')
<table class="table">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Author</th>
    <th scope="col">Title</th>
    <th scope="col"></th>
    <th scope="col"></th>
  </tr>
</thead>
<tbody>
  @foreach ($posts as $post)
  <tr>
    <th scope="row">{{$post->id}}</th>
    <td>{{$post->author}}</td>
    <td>{{$post->title}}</td>
    <td>
      <a href="{{ route('posts.show', $post->id) }}">Mostra Post</a>
    </td>
    <td>
      <a href="{{ route('posts.edit', $post->id) }}">Modifica</a>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
@endsection
