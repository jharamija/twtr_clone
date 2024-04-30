<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Return all posts from a single user.
     */
    public function getUserPosts($UID)
    {
        $userPosts = Post::where('user_id', $UID)->get();

        return response()->json($userPosts);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::with('user')->get();
        // $posts = DB::table('posts')->get();
        $posts = Post::with(['user' => function($query) {
            $query->select('id', 'name');
        }])->get();

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
        $post = new Post();
        $post->user_id = $request->input('UID');
        $post->body = $request->input('body');
        $post->likes = 0;
        $post->comments = 0;
        $post->retweets = 0;
        $post->save();

        return response([
            $request,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
