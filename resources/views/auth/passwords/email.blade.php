@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="card blog-card">
        <div class="card-body">
          <h1 class="h2">Восстановление пароля</h1>
          <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
          </div>
          <form method="post" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Адрес электронной почты *</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Электронная почта" value="{{ old('email') }}" required>
              @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
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
