@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="post">
      @csrf
      <h1 class="text-center mb-5">Добавить категорию тестов</h1>
      <div class="mb-3">
         <label for="testTitle" class="form-label">Название категории</label>
         <input type="text" name="title" class="form-control" required id="testTitle">
         <small class="text-muted">Любовь</small>
      </div>
      <div class="mb-3">
         <label class="form-label">Заголовок текста</label>
         <input type="text" name="data[header_title]" class="form-control" required>
         <small class="text-muted">Пример: Прохождение совместных тестов с партнером может быть полезным по нескольким причинам:</small>
      </div>
      <div class="mb-3">
         <label class="form-label">Причина 1</label><br>
         <textarea class="w-100" rows="5" name="data[header_text][]" required></textarea>
      </div>
      <div class="mb-3">
         <label class="form-label">Причина 2</label><br>
         <textarea class="w-100" rows="5" name="data[header_text][]" required></textarea>
      </div>
      <div class="mb-3">
         <label class="form-label">Причина 3</label><br>
         <textarea class="w-100" rows="5" name="data[header_text][]" required></textarea>
      </div>
      <div class="mb-3">
         <label class="form-label">Текст после окончания (небольшой текст)</label><br>
         <textarea class="w-100" rows="5" name="data[footer]" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-5">Добавить</button>
    </form>
    <p class="h3 mb-4">Тесты</p>
    @foreach($categories as $category)
      <div class="card card-body mb-2">
        <div class="row">
          <div class="col-8">
            <h5>{{$category->title}}</h5>
            <p>{{$category->header_text}}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
