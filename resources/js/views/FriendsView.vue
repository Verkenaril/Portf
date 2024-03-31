<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
<div v-if="persons == 0" class="void">Пусто</div>
<div class="items" v-else>

    <div v-for="p in persons" class="item">
        <div class="avatar">
            <img :src="p.avatar" alt="" width="150" height="150">
        </div>
        <div class="item__info">
            <div class="item__name">
                <router-link :to="{name: 'person_page', params: {id: p.id}}">{{p.first_name}} {{p.second_name}}</router-link>
            </div>
            <div class="item__actions">
                <button v-on:click="deleteFriend(p.id, p)" class="btn btn-danger">Удалить из друзей</button>
            </div>
            <div class="item__actions mt-2">
                <router-link :to="{name: 'chat_user', params: {id: p.id}}" class="btn btn-primary">Написать сообщение</router-link>
            </div>
        </div>
    </div>
</div>
    <ul v-if="pagination.last_page > 1" class="pagination">
        <li class="page-item"><a class="page-link" v-on:click.prevent="getFriends(pagination.current_page - 1)" v-if="pagination.current_page !== 1" href="">&lt&lt&lt</a></li>
    
        <li class="page-item"
            v-for="link in pagination.links">
            <template v-if="Number(link.label)
            && (pagination.current_page - link.label < 2
            && pagination.current_page - link.label > -2)
            || Number(link.label) === 1 || Number(link.label) === pagination.last_page">
                <a class="page-link" v-on:click.prevent="getFriends(link.label)" :class="link.active ? 'active' : ''" href="#0">{{ link.label }}</a>
            </template>
            <template v-if="Number(link.label)
            && pagination.current_page !== 3
            && pagination.current_page - link.label === 2
            || Number(link.label)
            && pagination.current_page !== pagination.last_page - 2
            && pagination.current_page - link.label === -2">
                <a class="page-link">...</a>
            </template>
        </li>  
        <li class="page-item">
            <a class="page-link" v-on:click.prevent="getFriends(pagination.current_page + 1)" v-if="pagination.current_page !== pagination.last_page" href="">&gt&gt&gt</a>
        </li>
    </ul>
</div>

</template>

<script>
import axios from "axios";

export default
{
    data() {return {
        persons: null,
        links: "",
        pagination: [],
        TF: true,
    }},
    methods:
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        getFriends(page = 1)
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get(`/api/getFriends?page=${page}`)
                .then(res => 
                {
                    this.pagination = res.data.meta;
                    this.persons = res.data.data;
                    this.links = res.data.links;

                    this.pageLoader(false);
                })
            })
        },
        deleteFriend(id)
        {
            this.pageLoader(true);
            
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.delete(`/api/deleteFriend/${id}`)
                .then(res => 
                {
                    this.getFriends();
                })
            })
        },
    },
    mounted()
    {
        this.getFriends();
    },
}
</script>

<style>

</style>