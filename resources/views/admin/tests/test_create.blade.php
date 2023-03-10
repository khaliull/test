@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="post">
      @csrf
      <h1 class="text-center mb-5">Добавить тест</h1>
      <div class="mb-3">
         <label for="testName" class="form-label">Название теста</label>
         <input type="text" name="name" class="form-control" required id="testName">
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-5">Добавить</button>
    </form>
    <p class="h3 mb-4">Тесты</p>
    @foreach($tests as $test)
    <a href="{{ route('test.question.create', ['test' => $test->id]) }}" class="card mb-1 text-body text-decoration-none">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            {{$test->name}}
          </div>
          <div class="col-4 text-end">
            @if($test->active)
            <span class="text-success small">Запущен</span>
            @else
            <span class="text-danger small">Не запущен</span>
            @endif
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
@endsection
