@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="card blog-card">
        <div class="card-body">
          <h1 class="">Создание аккаунта</h1>
          <form method="post">
            @csrf
            <div class="mb-2">
              <label for="name" class="form-label">Имя пользователя *</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Имя пользователя" value="{{ old('name') }}" required autocomplete="off">
              <small class="text-muted">Пример: denisRS293</small>
            </div>
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
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
              @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="passwordConfirmation" class="form-label">Повторите пароль *</label>
              <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" required>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">Создать</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
