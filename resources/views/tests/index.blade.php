@extends('layouts.app')

@section('content')
<div class="bg-header-container">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center justify-content-end">
      <div class="col-12">
        <h1 class="fw-light text-center mb-5">Выбор тестов для прохождения</h1>
        <p class="mb-1">Выполнив&nbsp;совместные&nbsp;тесты&nbsp;- </p><p class="ps-md-4 mb-md-4">можно понять многое о человеке</p>

        <div class="test-invited-block">
          <p class="fw-bold mb-0">Вас пригласили?</p>
          <small>Для прохождения совместного теста необходимо ввести код который вам прислали</small>
          <form class="pt-3" action="{{ route('test.paired_test') }}" method="get">
            <input class="form-control mb-2" type="text" name="key" required>
            <button class="btn btn-info text-white w-100">Перейти к тесту</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row">
        <h3 class="text-center mb-5">Темы тестов</h3>
        @foreach($categories as $category)
        <div class="col-6 align-items-center mb-3">
          <a href="{{ route('tests.category', ['category' => $category->id]) }}" class="test-link">
            <div class="test-card">
              <div class="card-body">
                <h5 class="text-center mb-0">{{$category->title}}</h5>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
