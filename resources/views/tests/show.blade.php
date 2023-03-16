@extends('layouts.app')

@section('content')
<div class="container py-5 test-bg">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="test-show"></div>
    </div>
  </div>
</div>
<script>var test = @json($test)</script>
<script>var pairedTestKeyShow = @json($pairedTestKeyShow)</script>
@endsection
