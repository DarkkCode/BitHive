@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 800px;">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('forum.index') }}" style="color: var(--primary-color); text-decoration: none;">&larr; Back to Forum</a>
        </div>

        <div class="post-card" style="border-left: 5px solid var(--primary-color);">
            <h1 style="margin-bottom: 10px;">{{ $post->title }}</h1>
            <p style="color: #888; font-size: 0.9rem; margin-bottom: 20px;">
                Asked by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
            </p>
            <div style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 30px; white-space: pre-wrap;">{{ $post->body }}</div>

            @if(Auth::id() == $post->user_id)
                <div style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 15px;">
                    <a href="{{ route('forum.edit', $post->id) }}" class="btn-sm" style="background: #fbbf24; color: black; text-decoration: none; border-radius: 4px; padding: 5px 10px;">Edit</a>
                    <form action="{{ route('forum.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this question?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            @endif
        </div>

        <div style="margin-top: 50px;">
            <h3>Answers ({{ $post->answers->count() }})</h3>

            @foreach($post->answers as $answer)
                <div class="post-card" style="margin-top: 15px; padding: 15px;">
                    <p style="font-size: 0.9rem; color: #888; margin-bottom: 10px;">
                        <strong>{{ $answer->user->name }}</strong> answered:
                    </p>
                    <p style="white-space: pre-wrap;">{{ $answer->body }}</p>

                    @if(Auth::id() == $answer->user_id)
                        <div style="margin-top: 10px;">
                            <a href="{{ route('answers.edit', $answer->id) }}" class="btn-sm" style="background: #fbbf24; color: black; text-decoration: none; border-radius: 4px; padding: 2px 8px; font-size: 0.7rem;">Edit</a>

                            <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete answer?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger btn-sm" style="font-size: 0.7rem;">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            <div style="margin-top: 40px; margin-bottom: 50px;">
                <h4>Your Answer</h4>
                <form action="{{ route('answers.store', $post->id) }}" method="POST">
                    @csrf
                    <textarea name="body" rows="4" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-color); margin-bottom: 10px;" required placeholder="Type your answer here..."></textarea>
                    <button type="submit" class="btn-primary">Post Answer</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .post-card {
            background-color: var(--card-bg); padding: 30px;
            border-radius: 8px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
    </style>
@endsection
