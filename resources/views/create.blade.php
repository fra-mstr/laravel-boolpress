@extends('layouts.boolpress')

@section('title')
  Crea Nuovo Post
@endsection

@section('content')
  <form method="POST" action="{{route('posts.store')}}">
    @csrf
    @method('Post')
    <div class="mb-3">
      <label for="author" class="form-label">Author</label>
      <input name="author" type="text" class="form-control" id="author" placeholder="Author">
      @error('author')
            <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Title">
      @error('title')
            <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input name="description" type="text" class="form-control" id="description" placeholder="Description">
      @error('description')
            <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <label class="form-label">Categories</label>
    <select name="category_id" class="form-select" aria-label="Default select example">
      <option selected>Choose the category</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{$category->title}}</option>
      @endforeach
      @error('category_id')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </select>
    <br>
    <button type="submit" class="btn btn-primary">Crea</button><br><br>
    <a href="{{ route('posts.index')}}">Indietro</a>
  </form>
@endsection
