<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  @vite(['resources/css/app.css', 'resources/js/frontend/login.js'])
</head>
<body>

  <div class="login-page">
    <!-- Blurred background -->
    <div class="login-bg"></div>

    <!-- Login card -->
    <div class="login-card">

      <div class="login-logo">
        <div class="login-logo-row">
          <img
            src="{{ Vite::asset('resources/images/frontend/lra_logo.png') }}"
            alt="LRA Seal"
            onerror="this.style.display='none'"
          />
          <span class="lra-text">LRA</span>
        </div>
        <p class="login-logo-sub">Land Registration Authority</p>
      </div>

      <div class="login-form">
        @if ($errors->has('email'))
          <p style="color:#b91c1c;font-size:13px;margin-bottom:10px;">{{ $errors->first('email') }}</p>
        @endif
        <div class="login-input-wrap">
          <input type="email" id="loginEmail" value="{{ old('email') }}" placeholder="Email" autocomplete="email" />
        </div>
        <div class="login-input-wrap">
          <input
            type="password"
            id="loginPassword"
            placeholder="Password"
            autocomplete="current-password"
            onkeydown="if(event.key==='Enter') handleLogin()"
          />
          <button class="toggle-pass" type="button" onclick="togglePassword()" aria-label="Show/hide password">
            <span id="eyeIcon"></span>
          </button>
        </div>
        <button class="btn-login" onclick="handleLogin()">Log in</button>
      </div>

      <a class="forgot-link" href="#">Forgot Password</a>

    </div>
  </div>

  <div class="toast-container" id="toastContainer"></div>

  <form id="loginForm" method="POST" action="{{ route('frontend.login.submit') }}" style="display:none;">
    @csrf
    <input type="hidden" name="email" id="formEmail" />
    <input type="hidden" name="password" id="formPassword" />
  </form>

</body>
</html>