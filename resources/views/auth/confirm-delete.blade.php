@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-card" style="border-color: var(--danger-color);">
            <h2 style="color: var(--danger-color); margin-bottom: 10px;">Delete Account</h2>
            <p style="margin-bottom: 20px;">This action is permanent. Please enter your password to confirm.</p>

            <form method="POST" action="{{ route('account.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <div class="password-wrapper">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required placeholder="Enter your password">

                        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                    </div>

                    @error('password')
                    <span style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <a href="{{ route('forum.index') }}" class="btn-primary" style="background: #ccc; color: #333 !important; flex: 1; text-align: center;">Cancel</a>
                    <button type="submit" class="btn-danger" style="flex: 1; font-size: 1rem; padding: 10px;">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
