@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 800px;">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('forum.show', $post->id) }}" style="color: var(--primary-color); text-decoration: none;">&larr; Cancel</a>
        </div>

        <div class="auth-card" style="max-width: 100%; text-align: left;">
            <h2 style="margin-bottom: 20px; text-align: center;">Edit Question</h2>

            <form action="{{ route('forum.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="form-group">
                    <label for="title">Question Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" required>
                </div>

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea name="body" rows="6" required>{{ $post->body }}</textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Update Question</button>
            </form>
        </div>
    </div>

    <style>
        textarea {
            width: 100%; padding: 10px; background: var(--input-bg);
            color: var(--text-color); border: 1px solid var(--border-color);
            border-radius: 5px; resize: vertical; font-family: inherit;
        }
    </style>
@endsection
