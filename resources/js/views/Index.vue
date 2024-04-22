<template>
<!-- <page-loader v-if="!ready"></page-loader> -->
    <div id="new_msg">
        <div class="new_msg__item" v-for="(n, index) in new_msg">
            <p>Новое сообщение</p>
            <p>{{ n.message }}</p>
            <p class="new_msg_answer" v-on:click="answerOnMsg">Ответить</p>
            <!-- <span class="new_msg__close" v-on:click="delNotification(index)">X</span> -->
        </div>
        <div class="new_msg__close-all" v-if="this.new_msg.length > 0" v-on:click="closeAllMsg">Закрыть все</div>
    </div>
    <div id="nav">
            <ul class="nav flex-column">
            <li id="loginshow">
                {{ login_user}} 
            </li>
            {{ first_name_inp }}
            <li v-if="!token" class="nav-item">
                <router-link :to="{name: 'login'}" class="nav-link">Вход</router-link>
            </li>
            <li v-if="!token" class="nav-item">
                <router-link :to="{name: 'registration'}" class="nav-link">Регистрация</router-link>
            </li>
            <li v-if="token" class="nav-item">
                <router-link :to="{name: 'main'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
</svg> <span>Моя Страница</span></router-link>
            </li>
            <li v-if="token" class="nav-item">
                <router-link :to="{name: 'gallery'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
</svg> <span>Медиа</span></router-link>
            </li>
            <li v-if="token" class="nav-item">
                <router-link :to="{name: 'friends'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg> <span>Друзья</span></router-link>
            </li>
            <li v-if="token" class="nav-item">
                <router-link :to="{name: 'chats'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg> <span>Сообщения</span></router-link>
            </li>
            <li v-if="token" class="nav-item">
                <!-- <router-link :to="{name: 'comchatslist'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
</svg> <span>Мои чаты</span></router-link> -->
            </li>
            <li v-if="token" class="nav-item">
                <router-link :to="{name: 'peoples'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-arms-up" viewBox="0 0 16 16">
  <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="m5.93 6.704-.846 8.451a.768.768 0 0 0 1.523.203l.81-4.865a.59.59 0 0 1 1.165 0l.81 4.865a.768.768 0 0 0 1.523-.203l-.845-8.451A1.5 1.5 0 0 1 10.5 5.5L13 2.284a.796.796 0 0 0-1.239-.998L9.634 3.84a.7.7 0 0 1-.33.235c-.23.074-.665.176-1.304.176-.64 0-1.074-.102-1.305-.176a.7.7 0 0 1-.329-.235L4.239 1.286a.796.796 0 0 0-1.24.998l2.5 3.216c.317.316.475.758.43 1.204Z"/>
</svg> <span>Люди</span></router-link>
            </li>
            <li v-if="token" class="nav-item">
                <!-- <router-link :to="{name: 'comchats'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
  <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
</svg> <span>Общие чаты</span></router-link> -->
            </li>
            <li v-if="token" class="nav-item">
                <a href="#" v-on:click.prevent="logout" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg> <span>Выход</span></a>
            </li>
            <li v-if="token" class="nav-item" id="setting">
                <hr>
                <router-link :to="{name: 'setting'}" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg> <span>Настройки</span></router-link>
            </li>
        </ul>
    </div>
    <div id="content">
        <router-view :key="$route.fullPath"></router-view>
    </div>

</template>

<script>
import axios from 'axios';
import PageLoader from "./PageLoader.vue";
import Echo from 'laravel-echo';

export default
{
    data() {return {
        token: null,
        first_name_inp: "",
        second_name_inp: "",
        login_user: "",
        auth_user_id: "",
        ready: false,
        new_msg: [],
        oneMsg: null,
        }
    },
    components:
    {
        PageLoader
    },
    created()
    {
        window.Echo.channel("user_recipient" + localStorage["auth_user_id"]) // имя заданное в broadcastOn()
            .listen(".store.m", res => 
            {
                this.new_msg.push(res.message);

                this.oneMsg = res.message;
            });
    },
    updated()
    {
        this.getToken();
        this.getLogin();

    },
    methods:
    {
        answerOnMsg()
        {
            this.closeAllMsg();
            this.$router.push({name: 'chat_user', params: {id: this.oneMsg.sender}});
        },
        closeAllMsg()
        {
            this.new_msg = [];
        },
        delNotification(el)
        {
            this.new_msg.splice(el, 1);
        },
        myfun(zopa)
        {
            this.ready = zopa;
        },
        getToken()
        {
            this.token = localStorage["x_xsrf_token"];
        },
        logout()
        {
            axios.post("/logout")
            .then(res => 
            {
                delete localStorage["x_xsrf_token"];
                delete localStorage["auth_user_id"];
                delete localStorage["login_user"];

                this.login_user = "";
                this.$router.push({name: "login"});
            })
        },
        getLogin()
        {
            if(localStorage["login_user"])
            {
                this.login_user = localStorage["login_user"];
                this.auth_user_id = localStorage["auth_user_id"];
            }
            else if(localStorage["x_xsrf_token"])
            {
                axios.get('/sanctum/csrf-cookie').then(res =>
                {
                    axios.get("/api/getAccountName")
                    .then(res => 
                    {
                        this.login_user = res.data.name;
                        localStorage["login_user"] = res.data.name;
                        this.auth_user_id = res.data.id;
                        localStorage["auth_user_id"] = res.data.id;
                    })
                })
            }
        }
    },
}
</script>

<style>
#nav
{
    border-right: 1px solid black;
}
#content
{
    flex-basis: 450px;
}
.nav-item:hover
{
    background-color: #0d6dfd4e;
}
hr
{
    width: 80%;
    border: none;
    background-color: rgb(0, 0, 0);
    height: 2px;
    margin: 0;
}
#new_msg
{
    position: fixed;
    bottom: 0%;
    left: 80%;
    color: white;
}
.new_msg__close-all
{
    background-color: rgba(0, 0, 0, 0.5);
    width: 200px;
    margin-bottom: 10px;
    text-align: center;
    cursor: pointer;
}
.new_msg__item
{
    background-color: rgba(0, 0, 0, 0.5);
    width: 200px;
    padding: 7px;
    margin-bottom: 10px;
}
.new_msg__item p
{
    text-overflow: ellipsis;
    padding: 0;
    margin: 0;
}
.new_msg__close
{
    position: relative;
    cursor: pointer;
    bottom: 80%;
    left: 95%;
}
.new_msg_answer
{
    text-align: right;
    font-size: 16px;
    cursor: pointer;
}

/* @media (max-width: 600px)
{
#content 
{
  flex-basis: 250px;
}
} */
</style>