<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
<div class="items">
        <div v-for="p in persons" class="item" v-on:click="goToChat(p.id)">
            <div class="avatar">
                <img :src="p.avatar" alt="" width="50" height="50">
                <!-- <img src="" alt="" width="50" height="50"> -->
            </div>
            <div class="item__info">
                <div class="item__name">
                    <router-link :to="{name: 'chat_user', params: {id: p.id}}">{{p.first_name}} {{p.second_name}}</router-link>
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
        persons: null,

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
                axios.get("/api/getChats")
                .then(res => 
                { 
                    this.persons = res.data;  
                    
                    this.pageLoader(false);
                })
            });
        }
    },
}
</script>

<style>

.items__chat:hover
{
    background-color: rgb(231, 231, 231);
    opacity: 0.5;
}
</style>