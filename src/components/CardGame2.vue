<template>
<button v-on:click="go" id="go" ref="btn">Раздача</button>
<div id="main-card">

<div id="table">
    <div id="col-1">
        <div>
            <img :src="cardshirt.many" v-if="cards.length > 1">
            <img :src="cardshirt.one" v-else-if="cards.length == 1">
            <img :src="cardshirt.zero" v-else>
            <div id="quantity">Количество карт: {{ cards.length }}</div>
        </div>
    </div>
    <div id="col-2">
        <div id="comp-cards">
            <div class="card" v-for="card in comp.player_cards">
                <img :src="cardshirt.one" class="player-cards">
            </div>
        </div>

        <div id="battle-place">
            <div id="battle-place__comp">
                <img :src="table.player_card_2.img">
            </div>
            <div id="battle-place__person">
                <img :src="table.player_card_1.img">
            </div>
        </div>

        <div id="person-cards">
            <div class="playercard" v-for="(card, index) in pl.player_cards" v-on:click="pl.dropCard(card, index)">
                <img :src="card.img">
            </div>
        </div>
    </div>
    <div id="col-3">
        <p>Ходит: {{ table.make_action }}</p>
    </div>
</div>
</div>
</template>
<script setup>
import { ref } from "vue";
let cardshirt = ref(
    {
        one: "images/1 (1).jpg",
        many: "images/1_2(1).jpg",
        zero: "images/1_zero(1).jpg"
    });

const btn = ref();
let cards = ref(
[
    {
        name: "2",
        id: 2,
        suit: "Черви",
        strength: 2,
        img: "images/1 (29).jpg"
    },
    {
        name: "3",
        id: 3,
        suit: "Черви",
        strength: 3,
        img: "images/1 (30).jpg"
    },
    {
        name: "4",
        id: 4,
        suit: "Черви",
        strength: 4,
        img: "images/1 (31).jpg"
    },
    {
        name: "5",
        id: 5,
        suit: "Черви",
        strength: 5,
        img: "images/1 (32).jpg"
    },
    {
        name: "6",
        id: 6,
        suit: "Черви",
        strength: 6,
        img: "images/1 (33).jpg"
    },
    {
        name: "7",
        id: 7,
        suit: "Черви",
        strength: 7,
        img: "images/1 (34).jpg"
    },
    {
        name: "8",
        id: 8,
        suit: "Черви",
        strength: 8,
        img: "images/1 (35).jpg"
    },
    {
        name: "9",
        id: 9,
        suit: "Черви",
        strength: 9,
        img: "images/1 (36).jpg"
    },
    {
        name: "10",
        id: 10,
        suit: "Черви",
        strength: 10,
        img: "images/1 (37).jpg"
    },
    {
        name: "J",
        id: 11,
        suit: "Черви",
        strength: 11,
        img: "images/1 (38).jpg"
    },
    {
        name: "Q",
        id: 12,
        suit: "Черви",
        strength: 12,
        img: "images/1 (39).jpg"
    },
    {
        name: "K",
        id: 13,
        suit: "Черви",
        strength: 13,
        img: "images/1 (40).jpg"
    },
    {
        name: "A",
        id: 14,
        suit: "Черви",
        strength: 14,
        img: "images/1 (28).jpg"
    },
    {
        name: "2",
        id: 15,
        suit: "Крести",
        strength: 2,
        img: "images/1 (3).jpg"
    },
    {
        name: "3",
        id: 16,
        suit: "Крести",
        strength: 3,
        img: "images/1 (4).jpg"
    },
    {
        name: "4",
        id: 17,
        suit: "Крести",
        strength: 4,
        img: "images/1 (5).jpg"
    },
    {
        name: "5",
        id: 18,
        suit: "Крести",
        strength: 5,
        img: "images/1 (6).jpg"
    },
    {
        name: "6",
        id: 19,
        suit: "Крести",
        strength: 6,
        img: "images/1 (7).jpg"
    },
    {
        name: "7",
        id: 20,
        suit: "Крести",
        strength: 7,
        img: "images/1 (8).jpg"
    },
    {
        name: "8",
        id: 21,
        suit: "Крести",
        strength: 8,
        img: "images/1 (9).jpg"
    },
    {
        name: "9",
        id: 21,
        suit: "Крести",
        strength: 9,
        img: "images/1 (10).jpg"
    },
    {
        name: "10",
        id: 22,
        suit: "Крести",
        strength: 10,
        img: "images/1 (11).jpg"
    },
    {
        name: "J",
        id: 23,
        suit: "Крести",
        strength: 11,
        img: "images/1 (12).jpg"
    },
    {
        name: "Q",
        id: 24,
        suit: "Крести",
        strength: 12,
        img: "images/1 (13).jpg"
    },
    {
        name: "K",
        id: 25,
        suit: "Крести",
        strength: 13,
        img: "images/1 (14).jpg"
    },
    {
        name: "A",
        id: 26,
        suit: "Крести",
        strength: 14,
        img: "images/1 (2).jpg"
    },
]
);
class Table
{
    constructor()
    {
        this.player_card_1 = {img: ""};
        this.player_card_2 = {img: ""};
        this.make_action = "player";
    }
    clearTable()
    {
        this.player_card_1 = {img: ""};
        this.player_card_2 = {img: ""};
    }
    checkPlayerCards()
    {
        if(pl.value.player_cards.length == 0 && comp.value.player_cards == 0) alert("Ничья");
        else if(pl.value.player_cards.length == 0)
        {
            alert("player win");
        } 
        else if(comp.value.player_cards == 0)
        {
            alert("comp win");
            pl.value.player_cards = [];
        } 
    }
}


class Player
{
    constructor()
    {
        this.max_cards = 3;
        this.player_cards = [];
    }
    getCards()
    {
        // Присвоение карты 
        for(let i = 0; i < this.max_cards; i++)
        {
            //выбор карты
            let num = Math.round(Math.random()*(cards.value.length-1));
        
            // Присвоение карты
            this.player_cards.push(cards.value[num]);
        
            // Удаление карты из колоды
            cards.value.splice(num, 1);
        }
    }
    takeMoreCards()
    {
        if(this.player_cards.length < this.max_cards && cards.value.length > 0)
        {
            while(this.player_cards.length < this.max_cards)
            {
                let num = Math.round(Math.random()*(cards.value.length-1));
                // Присвоение карты
                this.player_cards.push(cards.value[num]);
                // Удаление карты из колоды
                cards.value.splice(num, 1);
            }
        }
        else console.log(cards.value.length);
    }
}


//---------------------player
class Player1 extends Player
{
    dropCard(card, idx)
    {
        if(table.value.make_action == "player")
        {
            table.value.player_card_1 = card;
    
            //delete card from a player
            this.player_cards.splice(idx, 1);


            //call comp
            comp.value.checkSuitableCards();
        }
        else
        {
            if(this.checkSuitableCards())
            { 
                //ecli Bblbpana ne ta kapta
                if(card.strength <= table.value.player_card_2.strength)
                {
                    alert("Неверно");
                    return false;
                } 
                
                table.value.player_card_1 = card;
        
                //delete card from a player
                this.player_cards.splice(idx, 1);

                table.value.make_action = "player";

                setTimeout(() =>
                {
                    table.value.checkPlayerCards();
                    table.value.clearTable();
                    
                }, 2000);
                setTimeout(() =>
                {
                    this.takeMoreCards();    
                    
                    comp.value.takeMoreCards();
                }, 2300);

            }
            else
            {
                this.player_cards.push(table.value.player_card_2);
                table.value.checkPlayerCards();
                table.value.clearTable();

            }


        }
    }
    checkSuitableCards()
    {
        //наличие карт
        let suitableCards = this.player_cards.filter(item => item.strength > table.value.player_card_2.strength);
        // есть две+
        if(suitableCards.length >= 2)
        {
            suitableCards.sort((a,b) => a.strength - b.strength);
            return true;
        }
        //есть 1
        else if(suitableCards.length == 1)
        {
            return true;
        } 
        //нету 
        else
        {
            table.value.make_action = "comp";

            //call comp
            comp.value.actionComp();

            return false;
        }

    }
}






//-----------------------comp
class Comp extends Player
{
    actionComp()
    {
        setTimeout(() =>
            {
                table.value.checkPlayerCards();
                table.value.clearTable();
            }, 1500);

            setTimeout(() =>
            {
                //player take cards
                pl.value.takeMoreCards();

                // comp take cards
                this.takeMoreCards();

            }, 1900);

            setTimeout(() =>
            {
                //ход компа
                table.value.make_action = "comp";
                let i = this.lesserCard();
                this.dropCard(i);
                this.deleteCard(i);

            }, 2300);
    }
    lesserCard()
    {
        let i = this.player_cards.sort((a,b) => a.strength - b.strength);
        return i[0];
    }
    dropCard(card)
    {
        if(table.value.make_action == "player")
        {
            table.value.player_card_2 = card;
        }
        else
        {
            table.value.player_card_2 = card;
        }
    }
    deleteCard(card)
    {
        let idCard = this.player_cards.findIndex(item => item.id == card.id);
        this.player_cards.splice(idCard, 1);
    }
    checkSuitableCards()
    {
        //наличие карт
        let suitableCards = this.player_cards.filter(item => item.strength > table.value.player_card_1.strength);
        // есть две+
        if(suitableCards.length >= 2)
        {
            suitableCards.sort((a,b) => a.strength - b.strength);
            setTimeout(() => 
            {
                this.deleteCard(suitableCards[0]);
                this.dropCard(suitableCards[0]);



                //xod compa
                this.actionComp();
            }, 1000);
        }
        //есть 1
        else if(suitableCards.length == 1)
        {
            setTimeout(() => 
            {
                this.deleteCard(suitableCards[0]);
                this.dropCard(suitableCards[0]);

                //xod compa
                this.actionComp();
            }, 1000);
        } 
        //нету 
        else
        {
            setTimeout(() => {
                this.player_cards.push(table.value.player_card_1);
                table.value.clearTable();
                table.value.checkPlayerCards(); 
                

                pl.value.takeMoreCards();
                table.value.make_action = "player";
            }, 2000);

        }
    }
}


let comp = ref(new Comp());
let pl = ref(new Player1());
let table = ref(new Table());


function go()
{
    // pl.value.player_cards.push(cards.value[0]);
    // pl.value.player_cards.push(cards.value[1]);
    // pl.value.player_cards.push(cards.value[2]);
    
    // comp.value.player_cards.push(cards.value[3]);
    // comp.value.player_cards.push(cards.value[4]);
    // comp.value.player_cards.push(cards.value[5]);
    comp.value.getCards();
    pl.value.getCards();
    btn.value.style = "display: none;";
}
//козырь сделать числом от 100
</script>
<style>

#main-card
{
    background-image: url("../../public/background.jpg");
    background-size: cover;
    height: 50vw;
    width: 100%;
}
#table
{
    display: flex;
    justify-content: space-between;
    height: 100%;
    align-items: center;
    margin: 0 10px; 
}
#col-2
{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.playercard:hover
{
    opacity: 40%;
    transition: 300ms;
}

#comp-cards, #person-cards
{
    display: flex;
    justify-content: center;
    margin: 10px 0 0 0;
}
.card, .playercard
{
    margin: 0 10px;
    height: 120px;
}
.playercard
{
    margin-bottom: 10px;
}
.playercard img, .card img
{
    height: 120px;
}
#battle-place
{
    height: 250px;
}
#battle-place img
{
    height: 110px;
}
#battle-place__comp, #battle-place__person
{
    height: 120px;
}
#quantity
{
    color: white;
}
#go
{
    background-color: green;
    color: white;
    font-size: 25px;
    outline: none;
    border: none;
}
#col-3
{
    color: white;
    font-size: 40px;
}
</style>