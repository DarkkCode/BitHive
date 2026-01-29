@extends('layouts.app')
@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <h2 id="reg-title" style="min-height: 40px;"></h2>
            <p style="color:#888; margin-bottom:20px;">Join the community.</p>

            <form method="POST" action="/register">
                @csrf
                <div class="form-group"><label>Name</label><input type="text" name="name" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" required></div>

                <div class="form-group password-wrapper">
                    <label>Password</label>
                    <input type="password" name="password" id="p1" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePass('p1', this)"></i>
                </div>

                <div class="form-group password-wrapper">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" id="p2" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePass('p2', this)"></i>
                </div>

                <div style="background:#f1f1f1; padding:10px; margin-bottom:20px; display:inline-flex; align-items:center; border-radius:4px; color:#333;">
                    <input type="checkbox" style="width:20px; height:20px; margin-right:10px;"> I'm not a robot
                </div>

                <button type="submit" class="btn-primary">Sign Up</button>
                <div class="divider">OR</div>
                <a href="#" class="btn-google"><i class="fab fa-google"></i> Sign up with Google</a>
            </form>
        </div>
    </div>
    <script>
        window.onload = function() { typeWriter("reg-title", "Join BitHive"); };
        function togglePass(id, icon) {
            let x = document.getElementById(id);
            x.type = x.type === "password" ? "text" : "password";
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
