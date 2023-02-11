@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="card blog-card">
        <div class="card-body">
          <h1>Войти</h1>
          <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="mb-2">
              <label for="email" class="form-label">Адрес электронной почты *</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Электронная почта" value="{{ old('email') }}" required>
              @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Пароль *</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
              <label class="form-check-label ps-3" for="remember">
                  Запомнить
              </label>
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">Войти</button>
            </div>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Восстановить пароль
                </a>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
