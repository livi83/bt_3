<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category', 'tags')
            ->orderBy('created_at', 'desc')
            ->get();

        //return response()->json($posts);
        return view('admin.posts.index', compact('posts')); // namiesto JSON
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id' //kazdy prvok v array tags musi existovat
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        if ($request->has('tags')) {
            //$post->tags() vracia vztah, teda vrati m:n
            $post->tags()->attach($request->tags); //attach pridava do tabuliek m:n
        }
        //return response()->json(['message' => 'Post bol vytvorený', 'post' => $post], Response::HTTP_CREATED);
        return redirect()->route('posts.index')->with('success', 'Post bol vytvorený.');
    }

    public function show(string $id)
    {
        $post = Post::with('user', 'category', 'tags')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        //return response()->json($post);
        return view('admin.posts.show', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'sometimes|exists:categories,id', //sometimes = param nemusi byt vzdy pritomny
            'tags' => 'sometimes|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $post->update($request->only('title', 'content', 'category_id'));

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags); //synchronizuje priradenia
        }

        //return response()->json($post);
        return redirect()->route('posts.index')->with('success', 'Post bol aktualizovaný.');
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        $post->tags()->detach(); //odstrani vazbu medzi modelmi
        $post->delete();

        //return response()->json(['message' => 'Post bol vymazaný']);
        return redirect()->route('posts.index')->with('success', 'Post bol vymazaný.');

    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();

        return view('admin.posts.create', compact('categories', 'tags', 'users'));
    }

    public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        /*
            
            $post = Post::findOrFail($id);
            $post_tags = $post->tags();
        */
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'users'));

    }
}

