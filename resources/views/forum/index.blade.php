@extends('layouts.app')

@section('content')
    <div class="forum-header">
        <div class="welcome-section" style="width: 100%; text-align: center;">
            <h1 id="forum-welcome" style="min-height: 50px;"></h1>
        </div>
    </div>

    <div class="posts-container">
        @foreach($posts as $post)
            <div class="post-card">
                <h3>
                    <a href="{{ route('forum.show', $post->id) }}" style="text-decoration:none; color:var(--text-color);">
                        {{ $post->title }}
                    </a>
                </h3>
                <p style="font-size: 0.85rem; color: #888; margin-bottom: 10px;">
                    Posted by <span class="highlight">{{ $post->user->name }}</span>
                    on {{ $post->created_at->format('M d, Y') }}
                </p>
                <p>{{ Str::limit($post->body, 100) }}</p>
            </div>
        @endforeach

        @if($posts->isEmpty())
            <div style="text-align:center; margin-top:50px; color:#888;">
                <p>No questions yet.</p>
            </div>
        @endif
    </div>

    <script>
        window.addEventListener('load', function() {

            // or if it's older than that (returning).
            @if(auth()->user()->created_at->diffInMinutes(now()) < 1)
            typeWriter("forum-welcome", "Welcome to the community.");
            @else
            typeWriter("forum-welcome", "Welcome back to the community.");
            @endif
        });
    </script>

    <style>
        .forum-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .post-card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin-bottom: 15px;
            transition: transform 0.2s;
        }
        .post-card:hover { transform: translateY(-3px); border-color: var(--primary-color); }
        .highlight { color: var(--primary-color); font-weight: bold; }
    </style>
@endsection
