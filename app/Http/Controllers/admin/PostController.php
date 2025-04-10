<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //treba pridat
use Symfony\Component\HttpFoundation\Response; //treba pridat
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$posts = DB::table('posts')
        ->orderBy('created_at', 'desc')
        ->get();*/

        $posts = Post::with('user', 'category', 'tags')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($posts);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id',
            //pridavame validaciu pre tagy
            'tags' => 'array',
            'tags.*' => 'exists:tags,id' //kazdy prvok v array tags musi existovat
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($request->has('tags')) {
            //$post->tags() vracia vztah, teda vrati m:n
            $post->tags()->attach($request->tags); //attach pridava do tabuliek m:n
        }

        return $post
            ? response()->json(['message' => 'Post bol vytvorený'], Response::HTTP_CREATED)
            : response()->json(['message' => 'Post nebol vytvorený'], Response::HTTP_FORBIDDEN);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$post = DB::table('posts')->where('id', $id)->first();
        $post = Post::with('user', 'category', 'tags')->find($id);
        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($post);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            //sometimes = param nemusi byt vzdy pritomny
            'category_id' => 'sometimes|exists:categories,id', 
            'tags' => 'sometimes|array',
            'tags.*' => 'exists:tags,id'
        ]);
       
        $post->update($request->only('title', 'content', 'category_id'));

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags); //synchronizuje priradenia
        }

        return response()->json($post);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        $post->tags()->detach(); //odstrani vazbu medzi modelmi
        $post->delete();

        return response()->json(['message' => 'Post bol vymazaný']);
    }
    
}
