<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
    <h5>{{ person.first_name }} {{ person.second_name }}</h5>
    <h6 id="loadMore" v-on:click="getMoreMsg">Загрузить предыдущие</h6>
    <div id="chat">
        <div class="item-msg" v-for="m in arrMsg">
            <div v-if="m.sender == $route.params.id" class="message">{{m.message}}</div>
            <div v-else class="message mmsg">{{m.message}}</div>
        </div>
    </div>
        <div>
        <textarea class="form-control" v-model="msg"></textarea>        
    </div>

    <button v-if="msg != ''" v-on:click="sendMsg($route.params.id)" class="btn btn-primary mt-2">Отправить</button>
    <button v-else disabled v-on:click="sendMsg($route.params.id)" class="btn btn-primary mt-2">Отправить</button>
</div>

</template>

<script>
import axios from "axios";
export default
{
    data() {return {
        msg: "",
        arrMsg: [],
        person: "",
        a: null,
        chatId: 0,
        skip_count: 16,

        TF: true,
    }},
    props: ["auth_user"],
    created()
    {
        if(localStorage["auth_user_id"] > this.$route.params.id)
        {
            window.Echo.channel("store_message" + this.$route.params.id + localStorage["auth_user_id"]) // имя заданное в broadcastOn()
            .listen(".store.m", res => 
            {
                this.arrMsg.push({message: res.message.message, sender: res.message.sender});
            });
        }
        else
        {
            window.Echo.channel("store_message" + localStorage["auth_user_id"] + this.$route.params.id) // имя заданное в broadcastOn()
            .listen(".store.m", res => 
            {
                this.arrMsg.push({message: res.message.message, sender: res.message.sender});
            });
        }

    },
    methods:
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        sendMsg(id)
        {
            this.arrMsg.push({message : this.msg});
            this.a = this.msg;
            this.msg = "";
            

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/api/sendMessage", {user_other_id: id, message: this.a, chat_id: this.chatId})
                .then(res =>
                {                   
                 
                })
            })
        },
        getMsg()
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get(`/api/getMessage?uoi=${this.$route.params.id}&c_i=${this.chatId}`)
                .then(res =>
                {
                    this.arrMsg = res.data.message;
                    this.person = res.data.person;
                    this.chatId = res.data.chat_id;

                    this.pageLoader(false);

                })
            })
        },
        getMoreMsg()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get(`/api/getMoreMessage?c_i=${this.chatId}&skip=${this.skip_count}`)
                .then(res =>
                {
                    this.skip_count+= 16;
                    let m = res.data.message;
                    for(let key in m)
                    {
                        this.arrMsg.unshift(m[key]);
                    }
                })
            })
        }
    },
    mounted()
    {
        this.getMsg();
    },
    updated()
    {
        let h = document.querySelector("#chat").clientHeight;
        document.querySelector("#chat").scroll(0, h);
    }
}
</script>

<style>
h5
{
    text-align: center;
}
.mmsg
{
    text-align: right;
    background-color: rgb(231, 239, 250); 
}
.item-msg
{

}
.message
{
    padding: 0 9px 0px 9px;
    border-radius: 10px;
    margin-bottom: 2px;
    word-wrap: break-word;
}
#chat
{
    border: 1px solid #a3beff;
    margin-bottom: 13px;
    padding: 9px;
    height: 400px;
    width: 450px;
    overflow-x: hidden;
    scrollbar-gutter: stable;
}
#loadMore
{
    cursor: pointer;
    text-align: center;
    background-color: #b9b9ff;
}
</style>