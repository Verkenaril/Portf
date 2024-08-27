@extends("app")
@section("content")
<div id="career">
<h1>Сотрудники ABS профессионалы своего дела</h1>
<br>
<div id="career__advantages">
    <div class="advantages__element">
        <div class="advantages__img"><img src="img/career/robot.svg"></div>
        <div class="advantages__info">Одними из первых знакомятся с новинками</div>
    </div>
    <div class="advantages__element">
        <div class="advantages__img"><img src="img/career/sparkles.svg"></div>
        <div class="advantages__info">Огромное пространство возможностей</div>
    </div>
    <div class="advantages__element">
        <div class="advantages__img"><img src="img/career/bulb.svg"></div>
        <div class="advantages__info">Постоянное обучение и развитие</div>
    </div>
    <div class="advantages__element">
        <div class="advantages__img"><img src="img/career/chart-arrow-up.svg"></div>
        <div class="advantages__info">Быстрый и прозрачный карьерный рост</div>
    </div>
</div>
<br>
<hr>
<div id="career__search">
    <input id="career__search-input"type="search" placeholder="Найти вакансию">
</div>
<div id="career__vacancy">

</div>



</div>
@endsection

@section("partjs")
<script src="career.js"></script>
@endsection