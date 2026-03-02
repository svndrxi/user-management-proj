<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <main class="login-card">
        <h1 class="title">Land Registration Authority</h1>
        <p class="subtitle">Please sign in to continue.</p>

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="you@example.com" required autofocus>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" required>
            </div>

            <label class="remember" for="remember">
                <input id="remember" name="remember" type="checkbox">
                Remember me
            </label>

            <button class="btn-login" type="submit">Login</button>
        </form>
    </main>
</body>
</html>