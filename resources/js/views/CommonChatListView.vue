<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
<div v-if="chats == 0" class="void">Пусто</div>
<div class="items">
        <div v-for="p in chats" class="item comchat-list" v-on:click="goToChat(p.id)">
            <div class="item_picter">
                <img :src="p.picters" alt="" width="50" height="50">
                <!-- <img src="" alt="" width="50" height="50"> -->
            </div>
            <div class="item__info chat">
                <div class="item__name">
                    <router-link :to="{name: '', params: {id: p.id}}">{{p.name}}</router-link>
                </div>
                <div class="item__desciption">{{ p.description }}</div>
            </div>
            <div class="item__other">
                <div class="item__members">
                    Участников: {{ p.members }}
                </div>
                <div class="item__actions">
                    <button class="btn btn-danger">Покинуть чат</button>
                </div>
            </div>
        </div>
</div>
</div>
</template>

<script>
import axios from "axios";


export default
{
    data() {return {
        chats: null,
        TF: true,
    }},
    mounted()
    {
        this.getChats(); 
    },
    methods: 
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        goToChat(id_user)
        {
            this.$router.push({name: 'chat_user', params: {id: id_user}});
        },
        getChats()
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get("/api/getComChat")
                .then(res => 
                { 
                    console.log(res);
                    this.chats = res.data;
                    this.pageLoader(false);
                })
            });
        }
    },
}
</script>
    
<style>
.chat
{
    flex-basis: 150px;
}
.items__chat:hover
{
    background-color: rgb(231, 231, 231);
    opacity: 0.5;
}
.item_picter img
{
    width: 75px;
    height: 75px;
}


@media (max-width: 605px){
.item.comchat-list
{
    flex-direction: column;
    border-bottom: 1px solid black;
    padding-bottom: 10px;
}
.chat
{
    flex-basis: 70px;
}
.item_picter, .item__other
{
    margin-left: 15px
}
}
</style>