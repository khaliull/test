@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="test-question-create"></div>
  </div>
</div>

<script>
  var test = @json($test);
  var questions = @json($test->questions()->get());
</script>
@endsection
