@extends('layouts.app')

@section('content')
<div class="bg-header">
  <div class="container pt-lg-5 pt-4 pb-5">
    <div class="row align-items-center justify-content-end">
      <div class="col-6">
        <h1 class="fw-light mb-5">Проверь свою совместимость с человеком </h1>
        <p class="mb-1">Выполнив&nbsp;совместные&nbsp;тесты&nbsp;- </p><p class="ps-md-4 mb-md-4">можно понять многое о человеке</p>
        <button class="btn btn-sm  btn-outline-info px-5">Пройти тест</button>
      </div>
      <div class="col-lg-5 col-6">
        <img class="img-fluid" src="/images/home/header.png">
      </div>
    </div>
  </div>
</div>
<div class="container py-5">
  <h2 class="text-center">Хочешь больше узнать о человеке?</h2>
  <p class="text-center mb-5">Наш сервис поможет тебе в этом!</p>
  <div class="row">
    <div class="col-lg-3">
      <h5 class="text-center pt-lg-3">Пройдя тест вы получите:</h5>
      <p class=" text-center  small mb-4 mb-lg-0">прохождение тестов позволяет понять человека</p>
    </div>
    <div class="col-lg-9">
      <div class="row">
        <div class="col-md-4 mb-2 pe-md-2">
          <div class="information-card information-card-bg-one h-100">
            <h6 class="text-center">Совместимость</h6>
            <p class="mb-0">- Сервис позволяет узнать вашу совместимость с человеком</p>
          </div>
        </div>
        <div class="col-md-4 mb-2 pe-md-2">
          <div class="information-card information-card-bg-two h-100">
            <h6 class="text-center">Статистику</h6>
            <p class="mb-0">- Вы получите общую статистику ваших интересов</p>
          </div>
        </div>
        <div class="col-md-4 mb-2">
          <div class="information-card information-card-bg-three h-100">
            <h6 class="text-center">Вкусы человека</h6>
            <p class="mb-0">- Пройдя тест можно понять вкус любого человека</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-md-4 mb-2  pe-md-2 offset-4">
          <div class="information-card information-card-bg-four h-100">
            <h6 class="text-center">Приоритеты</h6>
            <p class="mb-0">- Позволяет понять что предпочитает ваш партнер (друг, подруга)</p>
          </div>
        </div>
        <div class="col-md-4 mb-2">
          <div class="information-card information-card-bg-five h-100">
            <h6 class="text-center">Выбор партнера</h6>
            <p class="mb-0">- Вы можете выбрать любого человека и сравнить с ним результаты</p>
          </div>
        </div>
        <div class="col-md-4 mb-2">
          <div class="information-card information-card-bg-six h-100">
            <h6 class="text-center">Новые знакомства</h6>
            <p class="mb-0">- Вы сможете получать новые знакомства и начать общение если оно еще не началось</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
