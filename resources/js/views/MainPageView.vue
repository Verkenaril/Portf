<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
    <div id="person">
        <div class="mb-3">
            <img alt="" v-bind:src="avatar_src" width="250" height="250" id="avatar_setting">
        </div>
        <div id="person__info">
            <div id="name" class="mb-3">
                {{ summaname }}
            </div>
            <div class="mb-1">
                Страна: {{ country_inp }}
            </div>
            <div class="mb-4">
                Город: {{ city_inp }}
            </div>
            <div class="mb-1">
                Увлечения: {{ hobbies_inp }}
            </div>
            <div class="mb-1">
                О себе: {{ description_inp }}
            </div>
        </div>

    </div>
    <div id="other">
        <div id="other__media">
            <div id="other__media-title" class="other__title">Медиа</div>
            <div id="gallery" class="void-content" v-if="filesImg.length == 0">Пусто
            </div>
            <div id="gallery" v-else>

                <gallery :images="array_hrefs_img" :index="index" @close="index = null"></gallery>
                <div v-for="(image, imageIndex) in filesImg" class="gallery__item">
                    <div class="image"
                        :key="imageIndex"
                        @click="index = imageIndex"
                        :style="{ backgroundImage: 'url(' + image.file + ')', width: '75px', height: '50px' }">
                    </div>
                </div>
            </div>
        </div>
        <post-component :allposts="posts"></post-component>
    </div>
</div>
</template>

<script>
import axios from "axios";
import VueGallery from 'vue-gallery';
import PostComponent from "../components/PostComponent.vue";

export default
{
    data() { return {
        first_name_inp: "",
        second_name_inp: "",
        date_born_inp: null,
        city_inp: null,
        country_inp: null,
        description_inp: null,
        hobbies_inp: null,
        avatar_src: null,
        cities: null,

        filesImg: [],
        array_hrefs_img: [],
        index: null,
        posts: [],

        TF: true,
    }},
    components: {
        'gallery': VueGallery,
        PostComponent,
        },
    methods: 
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        getPost_fn()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get("/api/getPosts")
                .then(res =>
                {   
                    this.posts = res.data;
                })
            })
        },
        getSetting()
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                this.getPost_fn();

                axios.get("/api/getSetting")
                .then(res => 
                {
                    this.first_name_inp = res.data.user_info.first_name;
                    this.second_name_inp = res.data.user_info.second_name;
                    this.date_born_inp = res.data.user_info.date_born;
                    this.city_inp = res.data.user_info.city;
                    this.country_inp = res.data.user_info.country;
                    this.avatar_src = res.data.user_info.avatar;
                    this.cities = res.data.user_info.cities;
                    this.description_inp = res.data.user_info.description;
                    this.hobbies_inp = res.data.user_info.hobbies;

                    for(let key in res.data.media)
                    {
                        this.filesImg.push(res.data.media[key]);
                        this.array_hrefs_img.push(res.data.media[key].file);
                    }

                    this.pageLoader(false);

                })
            })
        }
    },
    computed:
    {
        summaname()
        {
            return this.first_name_inp + " " + this.second_name_inp;
        }
    },
    mounted()
    {
        this.getSetting();
    }
}
</script>

<style>
#avatar_setting 
{
    object-position: 50% 50%;
    object-fit: cover;
    width: 250px;
}
#person
{
    display: flex;
    flex-direction: row;
}
#person__info
{
   margin-left: 5px;
}
#name
{
    background-color: #0d6efd;
    color: white;
    border-radius: 5px;
    text-align: center;
    padding: 0 4px 0 4px;
}
@media (max-width: 605px){
#person
{
  flex-direction: column;
}
}
</style>