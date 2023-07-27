@extends('layouts.app')

@section('content')
<div class="container pt-lg-5 pt-4 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 mb-5">
      <h1 class="h2 text-center mb-4">Последние новости сервиса</h1>
      @foreach($articles as $article)
      <a href="{{ route('articles.show', ['title' => $article->title]) }}" class="card article-card mb-3 text-decoration-none text-body">
        <div class="card-body">
          <div class="">
            <h4 class="card-title">{{$article->title}}</h4>
            <p class="fw-light">{{$article->content}}</p>
          </div>
        </div>
        <div class="d-flex justify-content-between pe-4">
          <p class="mb-0 px-4 text-link">Подробнее </p>
          <span class="text-muted text-fs-small text-end">{{$article->created_at->format('d-m-Y H:i')}}</span>
        </div>
      </a>
      @endforeach
    </div>

  </div>
</div>
@endsection
