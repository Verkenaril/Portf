<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="{{ asset('app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>

        </style>

    </head>
    <body>
        <div id="nav">
            <ul id="nav__ul" data-state="false">
                <li id="nav__open-close">Меню</li>
                <li class="nav__element closed">
                    <a href="/work" class="opacity-c">Акции</a>
                </li><li class="nav__element closed">
                    <a href="/work" class="opacity-c">Магазины</a>
                </li><li class="nav__element closed">
                    <a href="#">Покупателям</a>
                    <ul class="nav__submenu">
                        <li><a href="/payments">Способы оплаты<a></li>
                        <li><a href="/credit">Кредиты<a></li>
                    </ul>
                </li><li class="nav__element closed">
                    <a href="/catalog">Каталог</a>
                </li><li class="nav__element closed">
                    <a href="/entities">Юридическим лицам</a>
                </li><li class="nav__element closed">
                    <a href="/career">Вакансии</a>
                </li>
            </ul>
        </div>
        <div id="under_nav">
            <form id="find_form" method="get" action="/findresult">
                <input id="find" name="query" "type="search" placeholder="Поиск по сайту">
                <input id="find_btn" type="submit" value="Поиск">
            </form>
        </div>
        @yield("content")
        <div id="footer">
            <div class="footer__element">
                <div class="footer__group-menu">
                    <p>Компания</p>
                    <ul class="footer__menu">
                        <a href="/about"><li>О Компании</li></a>
                        <a href="/work" class="opacity-c"><li>Новости</li></a>
                        <!-- <a href="#"><li>Партнерам</li></a> -->
                        <a href="/vacancy"><li>Вакансии</li></a>
                        <a href="/policy"><li>Политика конфиденциальности</li></a>
                        <a href="/work" class="opacity-c"><li>Персональные данные</li></a>
                        <a href="/work" class="opacity-c"><li>Правила продаж</li></a>
                        <a href="/work" class="opacity-c"><li>Правила пользования сайта</li></a>
                        <a href="/work" class="opacity-c"><li>На информационном ресурсе применяются рекомендательные технологии</li></a>
                        <a href="/work" class="opacity-c"><li>Сервисные центры</li></a>
                    </ul>
                </div>

                <div class="footer__group-menu">
                    <p>Покупателям</p>
                    <ul class="footer__menu">
                        <a href="/work" class="opacity-c"><li>Как оформить заказ</li></a>
                        <a href="/payments"><li>Способы оплаты</li></a>
                        <a href="/credit"><li>Кредиты</li></a>
                        <a href="/work" class="opacity-c"><li>Доставка</li></a>
                        <a href="/work" class="opacity-c"><li>Статус заказа</li></a>
                        <a href="/work" class="opacity-c"><li>Обмен, возврат, гарантия</li></a>
                        <a href="/work" class="opacity-c"><li>Проверка статуса ремонта</li></a>
                    </ul>
                </div>
            </div>
            
            <div class="footer__element">
                <div class="footer__group-menu">
                    <p>Оставайтесь на связи</p>
                    <ul class="footer__menu">
                        <a href="#"><li>8-800-77-07-999 (c 03:00 до 22:00)</li></a>
                        <a href="/work" class="opacity-c"><li>Адреса магазинов в г. Москва</li></a>
                    </ul>
                </div>
            </div>    
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="{{ asset('main.js') }}"></script>
        @yield("partjs")  
    </body>
</html>