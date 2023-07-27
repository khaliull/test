@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="post">
      @csrf
      <h1 class="text-center mb-5">Добавить тест</h1>
      <div class="mb-3">
         <label class="form-label">Название раздела</label><br>
         <select name="category_id" class="form-select" required>
           @foreach($categories as $category)
           <option value="{{$category->id}}">{{$category->title}}</option>
           @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Тип теста</label><br>
         <select name="type" class="form-select" required>
           @foreach($types as $type)
           <option value="{{$type->name}}">{{$type->title}}</option>
           @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Вывод результата</label><br>
         <select name="result" class="form-select" required>
           <option value="text">Текстом</option>
           <option value="answer">Таблица с правильным вариантом</option>
           <option value="paired">Совместные тесты</option>
           <option value="psychology">Текст психологии зависит от ответов</option>
         </select>
      </div>
      <div class="mb-3">
        <label for="testName" class="form-label">Название теста</label>
        <input type="text" name="name" class="form-control" required id="testName">
      </div>
      <div class="mb-3">
        <label class="form-label">Результат плохо</label><br>
        <textarea class="w-100" rows="4" name="data[result_bad]" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Результат нормальный</label><br>
        <textarea class="w-100" rows="4" name="data[result_normal]" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Результат идеальный</label><br>
        <textarea class="w-100" rows="4" name="data[result_good]" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-5">Добавить</button>
    </form>
    <p class="h3 mb-4">Тесты</p>
    @foreach($tests as $test)
    <a href="{{ route('test.question.create', ['test' => $test->id]) }}" class="card mb-1 text-body text-decoration-none">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h5 class="text-center">Раздел: {{$test->title}}</h5>
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
