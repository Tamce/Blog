<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Post extends Controller
{
    public function create(Request $request)
    {
        if (!$request->has('topic')) {
            return response()->json(['status' => 'error', 'message' => 'Bad Request!'], 400);
        }
        $post = \App\Post::create($request->all());
        $post->user()->associate(Auth::user());
        $post->save();
        return response()->json($post);
    }

    public function update($id, Request $request)
    {
        $post = \App\Post::findOrFail($id);
        $post->fill($request->all());
        $post->save();
        return response()->json($post);
    }

    public function read(Request $request)
    {
        if ($request->has('id'))
        {
            $post = \App\Post::findOrFail($request->id);
            return response()->json($post);
        }

        $skip = $request->input('skip', 0);
        $take = $request->input('take', 10);
        $count = \App\Post::count();
        $posts = \App\Post::skip($skip)->take($take)->get();
        return response()->json(['count' => $count, 'skip' => $skip, 'take' => $take, 'data' => $posts]);
    }

    public function delete($id)
    {
        $post = \App\Post::findOrFail($id);
        $post->delete();
        return response()->json(['status' => 'success', 'message' => 'Done.']);
    }
}
