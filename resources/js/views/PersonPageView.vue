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
        <div id="other__media">Медиа</div>
        <div id="gallery" class="void-media" v-if="filesImg.length == 0">Пусто
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
</div>
</template>

<script>
import axios from "axios";
import VueGallery from 'vue-gallery';

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

        TF: true,
    }},
    components: {
        'gallery': VueGallery
        },
    methods: 
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        getSetting()
        {
            this.pageLoader(true);

            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get(`/api/getUser/id${this.$route.params.id}`)
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
#other__media
{
    background-color: #0d6efd7d;
    padding: 5px;
    color: white;
    font-weight: 500;
}
.void-media
{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 30px;
    color: #c9c9c9;
}
</style>