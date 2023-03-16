@extends('layouts.app')

@section('content')
<div class="bg-header-container">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center justify-content-end">
      <div class="col-12">
        <h1 class="fw-light text-center mb-5">Раздел: {{$category->title}}</h1>
        <p class="mb-1">Выполнив&nbsp;совместные&nbsp;тесты&nbsp;- </p><p class="ps-md-4 mb-md-4">можно понять многое о человеке</p>
        <div class="">
          <p class="fw-bold">Вас пригласили?</p>
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
