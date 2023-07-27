@extends('layouts.app')

@section('content')
<div class="bg-header-container">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center justify-content-end">
      <div class="col-12">
        <h1 class="fw-light text-center mb-5">История/результаты прохождения тестов</h1>
        <p class="mb-1">Выполнив&nbsp;совместные&nbsp;тесты&nbsp;- </p><p class="ps-md-4 mb-md-4">можно понять многое о человеке</p>
      </div>
    </div>
  </div>
</div>
<div class="container bg-white py-5">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="row mb-3">
        <div class="col-6">
          <a href="#" class="btn btn-primary btn h-100 w-100">Все тесты</a>
        </div>
        <div class="col-6">
          <a href="#" class="btn btn-primary h-100 w-100">Совместные тесты</a>
        </div>
      </div>
      @foreach($tests as $key => $test)
      <div class="result-card @if($test->finished == 1) result-card-closed @else result-card-active @endif">
        @if($test->finished == 1)
        <a class="" href="{{route('results.test', ['key' => $test->key, 'passedTest' => $test->passed_test_id])}}">
          <p class="text-end mb-0 small">{{$test->finished == 0 ? 'Активный' : 'Пройден'}}</p>
          <div class="row">
            <div class="col-8">
              {{$key + 1}}) {{$test->name}}
            </div>
            <div class="col-4">
              {{$test->created_at}}
            </div>
          </div>
        </a>
        @else
        <a class="" href="{{route('test.show', ['category' => $test->name, 'key' => $test->key])}}">
          <p class="text-end mb-0 small">{{$test->finished == 0 ? 'Активный' : 'Пройден'}}</p>
          <div class="row">
            <div class="col-8">
              {{$key + 1}}) {{$test->name}}
            </div>
            <div class="col-4">
              {{$test->created_at}}
            </div>
          </div>
        </a>
        @endif

      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
