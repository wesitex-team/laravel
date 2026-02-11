@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Sign In to your account</p>
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="icon icon-user"></i>
                        </span>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-text">
                          <i class="icon icon-lock-locked"></i>
                        </span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit">Login</button>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-link px-0" type="button">Forgot password?</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>
<input type="hidden" id="login-error" value="{{ session('login_error') }}">
<script>
    <?php include resource_path('views/login/login-js/invalid.js'); ?>
</script>
@endsection