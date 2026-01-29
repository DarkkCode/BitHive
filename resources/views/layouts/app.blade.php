<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitHive</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="container">
    <nav>
        <div class="logo">
            <h2 id="nav-brand" style="color:var(--primary-color); min-width: 150px;">
                @auth Hi {{ Auth::user()->name }} @else BitHive @endauth
            </h2>
        </div>
        <div class="nav-links">
            @auth
                <a href="{{ route('forum.create') }}">Ask Question</a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="margin-left:20px;">Logout</button>
                </form>

                <a href="{{ route('account.confirm') }}" style="color: #ef4444; margin-left: 20px; font-size: 1rem; font-weight: 500; text-decoration: none;">Delete Account</a>

            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endauth
            <button class="btn-toggle" onclick="toggleTheme()"><i id="theme-icon" class="fas fa-moon"></i></button>
        </div>
    </nav>
    @yield('content')
</div>

<script>
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) { document.documentElement.setAttribute('data-theme', currentTheme); }

    function toggleTheme() {
        const html = document.documentElement;
        let theme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
    }

    function typeWriter(elementId, text) {
        const el = document.getElementById(elementId);
        if (!el) return;
        el.innerHTML = "";
        let i = 0;
        function type() {
            if (i < text.length) { el.innerHTML += text.charAt(i); i++; setTimeout(type, 100); }
            else { el.classList.add('typing-cursor'); }
        }
        type();
    }

    window.addEventListener('load', function() {
        @auth typeWriter("nav-brand", "Hi {{ Auth::user()->name }}");
        @else typeWriter("nav-brand", "BitHive"); @endauth
    });
</script>
</body>
</html>
