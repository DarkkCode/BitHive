@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 800px;">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('forum.index') }}" style="color: var(--primary-color); text-decoration: none;">&larr; Back to Forum</a>
        </div>

        <div class="auth-card" style="max-width: 100%; text-align: left;">
            <h2 style="margin-bottom: 20px; text-align: center;">Ask a Question</h2>

            <form action="{{ route('forum.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Question Title</label>
                    <input type="text" name="title" id="title" placeholder="e.g. How do I use Laravel migrations?" required>
                </div>

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea name="body" id="body" rows="6" placeholder="Describe your problem in detail..." required></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Post Question</button>
            </form>
        </div>
    </div>

    <style>

        textarea {
            width: 100%;
            padding: 10px;
            background: var(--input-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            border-radius: 5px;
            resize: vertical;
            font-family: inherit;
        }
    </style>
@endsection
