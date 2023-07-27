@extends('layouts.app')

@section('content')
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
<script>var text = @json($text)</script>
<script>var facts = @json($facts)</script>
<script>var progress = @json($progress)</script>
@endsection
