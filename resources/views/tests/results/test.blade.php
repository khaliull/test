@extends('layouts.app')

@section('content')
<div class="bg-header-container">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center justify-content-end">
      <div class="col-12">
        <h1 class="fw-light text-center mb-5">Раздел: </h1>
        <p class="mb-1">Выполнив&nbsp;совместные&nbsp;тесты&nbsp;- </p><p class="ps-md-4 mb-md-4">можно понять многое о человеке</p>
      </div>
    </div>
  </div>
</div>
<div class="container bg-white py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row">
        <h3 class="mb-4">Результаты теста</h3>
        <div class="result-test-show">
        </div>
      </div>
    </div>
  </div>
</div>
<script>var questions = @json($questions)</script>
<script>var result = @json($result)</script>
<script>var test = @json($test)</script>

@endsection
