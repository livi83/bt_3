<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //treba pridat
use Symfony\Component\HttpFoundation\Response; //treba pridat

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$posts = DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->paginate(1);*/

            $posts = DB::table('posts')
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
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $posts = DB::table('posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $posts
            ? response()->json(['message' => 'Post bol vytvorený'], Response::HTTP_CREATED)
            : response()->json(['message' => 'Post nebol vytvorený'], Response::HTTP_FORBIDDEN);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $affected = DB::table('posts')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'updated_at' => now(),
            ]);

        if (!$affected) {
            return response()->json(['message' => 'Post sa nenašiel alebo nebol aktualizovaný'], Response::HTTP_NOT_FOUND);
        }

        $updatedPost = DB::table('posts')->where('id', $id)->first();

        return response()->json($updatedPost, Response::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return response()->json(['message' => 'Post sa nenašiel'], Response::HTTP_NOT_FOUND);
        }

        DB::table('posts')->where('id', $id)->delete();

        return response()->json(['message' => 'Post bol vymazaný'], Response::HTTP_OK);
    }



    
    public function postsWithUsers()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name')
            ->get();

        return response()->json($posts);
    }

    public function usersWithPostsCount()
    {
        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->selectSub(function ($query) {
                $query->from('posts')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('posts.user_id', 'users.id');
            }, 'post_count')
            ->get();

        return response()->json($users);
    }


}
