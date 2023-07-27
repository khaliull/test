@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="post">
      @csrf
      <h1 class="text-center mb-5">Добавить факт</h1>

      <div class="mb-3">
         <label class="form-label">Факт</label><br>
         <textarea class="w-100" rows="5" name="content" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-5">Добавить</button>
    </form>
    <p class="h3 mb-4">Интересные факты</p>
    @foreach($facts as $fact)
      <div class="card card-body mb-2">
        <div class="row">
          <div class="col-12">
            <p class="mb-0 fact-show">{{$fact->content}}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
