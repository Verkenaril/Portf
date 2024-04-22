<template>
<Transition>
<div id="create-chat-label" v-if="show">
    <div id="create-chat-form" >
        <div class="mb-3">
            <label for="name_chat" class="form-label" >Название чата</label>
            <input type="text" id="name_chat" class="form-control" v-model="name_chat_inp">
        </div>
        <div class="mb-3">
            <label for="desription_chat" class="form-label" >Описание чата</label>
            <input type="text" id="desription_chat" class="form-control" v-model="description_chat_inp">
        </div>
        <div id="error-msg" v-if="TF">Заполните все поля</div>
        <div id="create-chat-form__actions">
            <div> 
                <button id="create-chat-form__ok" class="btn btn-primary" v-on:click="createChat_fn">
                    ОК
                </button>
                <button id="create-chat-form__cancel" v-on:click="formToggle_fn" class="btn btn-danger">
                    Отмена
                </button>
            </div>
        </div>
    </div>
</div> 
</Transition>
<div class="container">
<div id="create-chat">
    <div>
        <button class="btn btn-primary" v-on:click="formToggle_fn">Создать чат</button>
    </div>
</div>


<div class="item comchat">
    <div class="item__pic-comchat">
        <img src="" alt="" width="100" height="100">
    </div>
    <div class>
        <div class="item__name">Name chats</div>
        <div class="item__descripton">Description chatsdfg tyyrrtert etrrehgfфы выв</div>
    </div>
    <div class="actions">
        <button class="btn btn-primary">Вступить</button>
    </div>
</div>
</div>
</template>

<script>

export default {
    data() { return {
        show: false,
        name_chat_inp: "",
        description_chat_inp: "",
        error_msg: "",
        TF: false
    }},
    methods:
    {
        formToggle_fn()
        {
            this.show = !this.show;
        },
        checkFill()
        {
            if(this.name_chat_inp == "" )
            {
                this.error_msg = "Заполните все поля";
                this.TF = true;
                throw "Заполните все поля";
            } 
            if(this.description_chat_inp == "")
            {
                this.error_msg = "Заполните все поля";
                this.TF = true;
                throw "Заполните все поля";
            }
            this.TF = false;
        },
        createChat_fn()
        {
            this.checkFill();
            
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/api/createComChat", {name: this.name_chat_inp, description: this.description_chat_inp,})
                .then(res =>
                {    
                    this.description_chat_inp = "";
                    this.name_chat_inp = "";                 
                    console.log(res);
                })
            })
                   
            this.show = !this.show;
        },
        getComChat()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/api/getComChat", {name: this.name_chat_inp, description: this.description_chat_inp,})
                .then(res =>
                {

                })
            })
        },
    },
    mounted()
    {
        // this.getComChat();
    }
}
</script>

<style>
.item__pic-comchat
{
    margin: 0 5px 0 0;
}
.item__descripton
{
    font-size: 14px;
    color: rgb(165, 165, 165);
}
.item__name
{
    font-size: 17px;
}
#create-chat
{
    margin: 0 0 10px 0;
}
#hrmax
{
    width: 100%;
    margin: 0 0 10px 0;
}
#create-chat-label
{
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.712);
    display: flex;
    justify-content: center;
    align-content: center;
    flex-wrap: wrap;
}
#create-chat-form
{
    width: 50%;
    background-color: #cfd2d5;
    padding: 15px;
    border-radius: 11px;
}
#create-chat-form__actions button
{
 margin-right: 10px;
}
.active-form
{
    display: none !important;
}
#error-msg 
{
    color: red;
}
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

@media (max-width: 605px){
.comchat
{
    flex-direction: column;
}
.item__pic-comchat, .item__descripton
{
    margin-left: 15px;
}
}
</style>