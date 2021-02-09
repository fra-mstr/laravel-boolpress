<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\PostInformation;

use App\Http\Requests\PostFormRequest;

use Faker\Generator as Faker;

use Illuminate\Support\Facades\DB;

// use App\Http\Requests\EditPostFormRequest;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        // $post = Post::first();
        // dd($post->postInformation);

        $columns = DB::getSchemaBuilder()->getColumnListing('posts');
        // dd($columns);

        return view('index', compact('posts', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();

      return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request, Faker $faker)
    {
      $validatedData = $request->validated();

      $newPost = new Post();
      $newPost->title = $validatedData["title"];
      $newPost->author = $validatedData["author"];
      $newPost->category_id = $validatedData["category_id"];
      $newPost->save();

      $postInfo = new PostInformation();
      $postInfo->description = $validatedData["description"];
      $postInfo->post_id = $newPost->id;
      $postInfo->slug = $faker->slug;
      $postInfo->save();

      return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $info = PostInformation::find($id);
        $category = $post->category;

        return view('show', compact('post', 'info', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $info = PostInformation::find($id);
        $categories = Category::all();

        return view('edit', compact('post', 'categories', 'info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
      $validatedData = $request->validated();
      // dd($validatedData["description"]);

      $oldPost = Post::find($id);
      $oldPostInformation = PostInformation::find($id);
      // dd($oldPostInformation);

      $oldPost->title = $validatedData["title"];
      $oldPost->author = $validatedData["author"];
      $oldPost->category_id = $validatedData["category_id"];
      $oldPost->save();

      $oldPostInformation->description = $validatedData["description"];
      $oldPostInformation->save();

      return redirect()->route('posts.show', $oldPost->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $postInformation = PostInformation::find($id);

      $post->delete();
      $postInformation->delete();

      return redirect()->route('posts.index');
    }
}
