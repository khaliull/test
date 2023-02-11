@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="card blog-card">
        <div class="card-body">
          <h1 class="h2">Восстановление пароля</h1>
          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-2">
              <label for="email" class="form-label">Адрес электронной почты *</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Пароль *</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
              @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password-confirm" class="form-label">Повторите пароль *</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">Восстановить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
