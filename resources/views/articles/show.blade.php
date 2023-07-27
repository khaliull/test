@extends('layouts.app')

@section('content')
<div class="container pt-lg-5 pt-4 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 mb-5 px-md-4">
        <h4 class="card-title">{{$article->title}}</h4>
        <p class="fw-light">{{$article->content}}</p>
        <div class="text-muted text-fs-small text-end pt-4">{{$article->created_at->format('d-m-Y H:i')}}</div>
    </div>
  </div>
</div>
@endsection
