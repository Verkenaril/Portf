@extends("app")
@section("content")
<div id="catalog">
    <a href="/products/1">
        <div class="catalog__item">
                <div class="catalog__img">
                    <img src="/img/catalog/smartfon.jpg">
                </div>
            <div class="catalog__name">
                Смартфоны
            </div>
        </div>  
    </a>

    <a href="/products/2">
        <div class="catalog__item">
            <div class="catalog__img">
                <img src="/img/catalog/ebook.jpg">
            </div>
            <div class="catalog__name">
                Электронные книги
            </div>
        </div>  
    </a>

    <a href="/products/3">
        <div class="catalog__item">
            <div class="catalog__img">
                <img src="/img/catalog/pc.png">
            </div>
            <div class="catalog__name">
                ПК
            </div>
        </div> 
    </a> 

    <a href="/products/4">
    <div class="catalog__item">
        <div class="catalog__img">
            <img src="/img/catalog/laptop.png">
        </div>
        <div class="catalog__name">
            Ноутбуки
        </div>
    </div>  
        </a> 
    <div class="catalog__item">
        <a href="#"><div class="catalog__img">
            <img src="/img/catalog/TV.png">
        </div>
        <div class="catalog__name">
            ТВ
        </div></a>
    </div>  
    <div class="catalog__item">
        <a href="#"><div class="catalog__img">
            <img src="/img/catalog/wifi.jpg">
        </div>
        <div class="catalog__name">
            wi-fi
        </div></a>
    </div>  
    <div class="catalog__item">
        <a href="#"><div class="catalog__img">
            <img src="/img/catalog/speakers.jpg">
        </div>
        <div class="catalog__name">
            Колонки
        </div></a>
    </div>  
    <div class="catalog__item">
        <a href="#"><div class="catalog__img">
            <img src="/img/catalog/microfone.jpg">
        </div>
        <div class="catalog__name">
            Микрофоны
        </div></a>
    </div>  
    <div class="catalog__item">
        <a href="#"><div class="catalog__img">
            <img src="/img/catalog/planschet.jpg">
        </div>
        <div class="catalog__name">
            Плантшеты
        </div></a>
    </div>  
</div>
<div id="slider-company">
    <div id="slider-company__wrapper">
        <img src="img/company/1.png">
        <img src="img/company/2.png">
        <img src="img/company/3.png">
        <img src="img/company/4.png">
        <img src="img/company/5.png">
        <img src="img/company/6.png">
        <img src="img/company/7.png">
        <img src="img/company/8.png">
        <img src="img/company/9.png">
        <img src="img/company/10.png">
        <img src="img/company/11.png">
    </div>
</div>
<div id="bonus_programm">
    <div id="bonus_programm__header_img">
        <img src="img/bonus/header-lg.jpg">
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_wallet.png">
        </div>
        <div class="bonus_programm__text">
            <p>
                <b>Зачем участвовать в программе?</b> Участникам программы ProZaPass мы
            </p>
            <p class="bonus_programm__orange_text">
                вернём часть стоимости покупок 
            </p>
            <p>
                на персональный бонусный счет. И Вам приятно, и нам не жалко!
            </p>
        </div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_bonusin.png">
        </div>
        <div class="bonus_programm__text">
        Вы совершаете покупки и автоматически получаете бонусы на свой бонусный счет
        </div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
        <img src="img/bonus/icon_bonusout.png">
        </div>
        <div class="bonus_programm__text">
        Используя накопленные бонусы, можно получить скидку до 100% стоимости новых покупок.
        </div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_moneybox.png">
        </div>
        <div class="bonus_programm__text">
        <p><b>Как копить бонусы?</b></p>
        <p class="bonus_programm__orange_text">Получайте бонусы при покупке</p>
        <p>любого товара, участвующего в программе ProZaPass, в магазинах или на сайтах сети DNS.</p>
        <p><b>Количество бонусов</b>, начисляемых за товар, Вы можете увидеть рядом с ценой каждого товара, участвующего в программе ProZaPass.</p>
        <p></p>
    
    </div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_timer.png">
        </div>
        <div class="bonus_programm__text">
        Сразу после регистрации на сайте и подтверждения номера телефона, Вам открывается бонусный счет и уже с этого момента Вы можете копить бонусы.        </div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_cart.png">
        </div>
        <div class="bonus_programm__text">
        <p><b>Как тратить бонусы?</b></p>
        <p class="bonus_programm__orange_text">Получайте скидки при приобретении товара!</p>
        <p>При покупке в магазине Вам нужно предъявить карту на кассе до момента оплаты покупки.</p></div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_rouble.png">
        </div>
        <div class="bonus_programm__text">
        <p><b>Что такое бонусы?</b></p>
        <p class="bonus_programm__orange_text">1 накопленный бонус − это 1 рубль скидки!</p>
        <p>Всё просто и без обмана!</p></div>
    </div>
    <div class="bonus_programm__element">
        <div class="bonus_programm__img">
            <img src="img/bonus/icon_maintenance.png">
        </div>
        <div class="bonus_programm__text">
        <p class="bonus_programm__orange_text">Получай сервисное обслуживание по номеру телефона.</p>
        <p>Не храни и не ищи кучу бумаг о покупке товара, мы найдем их сами по номеру телефона</p></div>
    </div>
</div>
@endsection

@section("partjs")
<script src="catalog.js"></script>
@endsection