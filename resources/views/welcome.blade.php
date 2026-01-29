@extends('layouts.app')

@section('content')
    <div style="text-align: center; margin-top: 100px;">

        <h1 id="welcome-title" style="font-size: 3rem; margin-bottom: 20px; min-height: 60px;"></h1>

        <p id="welcome-subtitle" style="font-size: 1.5rem; color: #888; min-height: 40px;"></p>

    </div>

    <script>
        // addEventListener is used so the Navbar animation doesn't break
        window.addEventListener('load', function() {


            typeWriter("welcome-title", "Welcome to the Forum");


            typeWriter("welcome-subtitle", "A community for nerds.", 2000);
        });
    </script>
@endsection
