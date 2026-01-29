<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // --- POSTS ---
    public function index() {
        $posts = Post::with('user')->latest()->get();
        return view('forum.index', compact('posts'));
    }

    public function create() { return view('forum.create'); }

    public function store(Request $request) {
        $request->validate(['title' => 'required', 'body' => 'required']);
        Post::create(['user_id' => Auth::id(), 'title' => $request->title, 'body' => $request->body]);
        return redirect()->route('forum.index');
    }

    public function show($id) {
        $post = Post::with(['user', 'answers.user'])->findOrFail($id);
        return view('forum.show', compact('post'));
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        if(Auth::id() !== $post->user_id) abort(403);
        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        if(Auth::id() !== $post->user_id) abort(403);
        $post->update($request->only('title', 'body'));
        return redirect()->route('forum.show', $post->id);
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        if(Auth::id() !== $post->user_id) abort(403);
        $post->delete();
        return redirect()->route('forum.index');
    }

    // --- ANSWERS ---
    public function storeAnswer(Request $request, $postId) {
        $request->validate(['body' => 'required']);
        Answer::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'body' => $request->body
        ]);
        return back();
    }


    public function editAnswer($id) {
        $answer = Answer::findOrFail($id);
        if(Auth::id() !== $answer->user_id) abort(403);
        return view('forum.edit_answer', compact('answer'));
    }


    public function updateAnswer(Request $request, $id) {
        $answer = Answer::findOrFail($id);
        if(Auth::id() !== $answer->user_id) abort(403);

        $answer->update(['body' => $request->body]);
        return redirect()->route('forum.show', $answer->post_id);
    }

    public function destroyAnswer($id) {
        $answer = Answer::findOrFail($id);
        if(Auth::id() !== $answer->user_id) abort(403);
        $answer->delete();
        return back();
    }
}
