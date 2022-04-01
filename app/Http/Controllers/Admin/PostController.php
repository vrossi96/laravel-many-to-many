<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $post = new Post();
        $tags = Tag::all();
        return view('admin.posts.create', compact('post', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $post = new Post();

        $request->validate([
            'title' => ['required', 'string', 'unique:posts', 'min:5'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'img' => ['image', 'nullable'],
            'tags' => ['nullable', 'exists:tags,id'],
        ]);

        // IMG input
        if (array_key_exists('img', $data)) {
            $img_path = Storage::put('post_images', $data['img']);
            $data['img'] = $img_path;
        }

        $data['user_id'] = Auth::id();

        // dd($data);
        $post->fill($data);
        $post->slug = Str::slug($request->title, '-');

        $post->save();
        // Prende l'array di id dei tag e li associa
        if (array_key_exists('tags', $data)) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selected_ids = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'tags', 'selected_ids', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'img' => ['image', 'nullable'],
            'tags' => ['nullable', 'exists:tags,id'],
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');

        // IMG input
        if (array_key_exists('img', $data)) {
            if ($post->img) Storage::delete($post->img);
            $img_path = Storage::put('post_images', $data['img']);
            $data['img'] = $img_path;
        }


        $post->update($data);

        // Prende l'array di id dei tag e li associa
        if (!array_key_exists('tags', $data)) {
            $post->tags()->detach();
        } else {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Delete relations between the post and tags if they exist.
        if (count($post->tags)) $post->tags()->detach();
        // Clear storage from the img of the post
        if ($post->img) Storage::delete($post->img);

        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    // CUSTOM

    public function tagPosts(Tag $tag)
    {
        return view('admin.tags.posts', compact('tag'));
    }
}
