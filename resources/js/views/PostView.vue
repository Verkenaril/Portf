<template>
<Transition>
<div id="create-chat-label" v-if="show">
    <div id="create-post-form">
        <div class="mb-3">
            <label for="name_post" class="form-label" >Заголовок</label>
            <input type="text" id="name_post" class="form-control" v-model="name_post_inp">
        </div>
        <div class="mb-3">
            <label for="bosy_post" class="form-label" >Содержание</label>
            <textarea class="form-control" id="bosy_post" v-model="body_post_inp"></textarea>
        </div>
        <div id="create-post-form__actions">
            <div> 
                <button id="create-post-form__ok" class="btn btn-primary" v-on:click="createPost_fn">
                    ОК
                </button>
                <button id="create-post-form__cancel" v-on:click="formToggle_fn" class="btn btn-danger">
                    Отмена
                </button>
            </div>
        </div>
    </div>
</div> 
</Transition>

<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
    <div id="create-post">
        <div>
            <button class="btn btn-primary" v-on:click="formToggle_fn">Добавить пост</button>
        </div>
    </div>
<br>

<div class="card item-post" title="Нажмите на текст для редактирования" v-for="(p, idx) in posts">
    <!-- <img src="" class="card-img-top" alt="..."> -->
    <div class="card-body">
        <h5 class="card-title" contenteditable="true">{{ p.name }}</h5>
        <p class="card-text" contenteditable="true">{{ p.post }}</p>
        <button class="btn btn-primary" v-on:click="savePost_fn(idx, p.id)">Сохранить</button>&nbsp
        <button class="btn btn-danger" v-on:click="deletePost_fn(p.id)">Удалить</button>
    </div>
    
</div>



</div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            show: false,
            name_post_inp: "",
            body_post_inp: "",
            posts: "",
            show_body: false,

            TF: true,
        }
    },

    methods:
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        formToggle_fn()
        {
            this.show = !this.show;
        },
        createPost_fn()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/api/createPost", {name: this.name_post_inp, post: this.body_post_inp,})
                .then(res =>
                {    
                    this.name_post_inp = "";
                    this.body_post_inp = "";
                    console.log(res);
                })
            })
            
            this.formToggle_fn();
            this.getPost_fn();
        },
        getPost_fn()
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get("/api/getPosts")
                .then(res =>
                {    
                    this.posts = res.data;
                    this.pageLoader(false);
                })
            })
        },
        savePost_fn(idx, idDB)
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.put("/api/savePost", {name: document.getElementsByClassName("card-title")[idx].innerText, post: document.getElementsByClassName("card-text")[idx].innerText, id: idDB})
                .then(res =>
                {    
                    console.log(res.data);
                })
            })
            this.getPost_fn();
        },
        deletePost_fn(idDB)
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.delete(`/api/deletePost/${idDB}`)
                .then(res =>
                {    
                    console.log(res.data);
                })
            })
            this.getPost_fn();
        }
    },
    mounted()
    {
        this.getPost_fn();
    },
}

</script>
<style>
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
    z-index: 10;
}
#create-post-form
{
    width: 50%;
    background-color: #cfd2d5;
    padding: 15px;
    border-radius: 11px;
}
#create-post-form__actions button
{
 margin-right: 10px;
}
#posts
{
    margin: 5px 0 5px 0;
}
.item-post
{
    margin-bottom: 15px;
    z-index: 1;
    max-width: 424px;
}
.card-text
{
    white-space: nowrap; 	
    overflow: hidden; 		
    text-overflow: ellipsis; 

}
.card-text:focus, .card-title:focus
{
    color: rgb(0 147 255);
    font-weight: 600;
    white-space: wrap;
    overflow: visible;
    word-wrap: break-word;
    padding: 9px;
}
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

@media (max-width: 605px)
{
#person
{
    width: 70%;
}
#create-post-form 
{
    width: 90%;
}
.card-text
{

}
}
@media (max-width: 501px)
{
    .card-text
    {
        width: 300px;
    }
}
@media (max-width: 450px)
{
    .card-text
    {
        width: 235px;
    }
}

@media (max-width: 391px)
{

    .card-text
    {
        width: 220px;
    }
}

@media (max-width: 360px)
{
    .card-text
    {
        width: 190px;
    }
}


</style>