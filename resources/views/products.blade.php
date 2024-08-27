@extends("app")
@section("content")
<div id="catalog__main">
    <div id="filters">
    
    </div>
    <div id="items">
        @foreach($data as $d)
        <div class="item">
            <div class="item__img">
                <img src="{{$d->picture}}">
            </div> 
            <div class="item__info">

                <a href="/work">
                <!-- <a href="/products/{{$id}}/{{$d->id}}"> -->
                    <div class="item__name">
                        {{$d->name}}
                    </div>
                </a>
                <div class="item__end-elem">
                    <div class="item__installment">
                    Рассрочка 0-0-12 или Выгода 8 800 ₽
                    </div>
                    <div class="item__raiting">
                        <span class="raiting-elem max-raiting">{{$d->raiting}}</span> <span class="number-of-ratings">Оценок:{{$d->num_raiting}}</span>
                    </div>
                    <div class="item__in-stock">
                        <span>В наличии в</span>&nbsp<span class="blue-elem">180 магазинах</span> 
                        <span>Доставим на дом</span>&nbsp<span class="blue-elem">2 часа</span>
                    </div>
                </div>
            </div> 
            <div class="item__actions">
                <!-- <div class="item__price-old"><s>900 500 ₽</s></div> -->
                <div class="item__price">{{$d->price}} ₽</div>
                <div class="item__price-in-mounth">от {{$d->in_mounth}} ₽/ мес.</div>
                <div class="item__btn-buy"><button>Купить</button></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{  $data->links()}}

@endsection