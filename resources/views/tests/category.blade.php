@extends('layouts.app')

@section('content')
<div class="bg-header-container">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center">
      <div class="col-12">
        <h1 class="fw-light mb-4 h2">Категория теста: {{$category->title}}</h1>
        @isset($category->data['header_title'])
          <h5 class="w-75 mb-3 fw-light">{{$category->data['header_title']}}</h4>
            <div class="row category-header-cards">
              @foreach($category->data['header_text'] as $key => $text)
              <div class="col-lg-4 col-md-6 mb-3">
                <div class="card card-body py-2 h-100 small fw-light category-header-card-{{$key}}">
                  {{$text}}
                </div>
              </div>
              @endforeach
          </div>
        @endisset
        <div class="test-invited-block">
          <p class="fw-bold mb-0">Вас пригласили?</p>
          <small>Для прохождения совместного теста необходимо ввести код который вам прислали</small>
          <form class="pt-3" action="{{ route('test.paired_test') }}" method="get">
            <input class="form-control mb-2" type="text" name="key" required>
            <button class="btn btn-info text-white w-100">Перейти к тесту</button>
          </form>
          @if (session('pairedTestVerification'))
              <div class="small text-danger pt-3">
                {{ session('pairedTestVerification') }}
              </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row">
        <h3 class="text-center mb-5">Виды тестов</h3>
        @isset($tests)
        @foreach($tests as $test)
        <div class="col-6 align-items-center mb-3">
          <a href="{{ route('test.show', ['category' => $category->title, 'key' => $test->key]) }}" class="test-link">
            <div class="test-card">
              <div class="card-body">
                <h5 class="text-center mb-0">{{$test->name}}</h5>
              </div>
            </div>
          </a>
        </div>
        @endforeach
        @endisset
      </div>
    </div>
  </div>
</div>
@endsection
