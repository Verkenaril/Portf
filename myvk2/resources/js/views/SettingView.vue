<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
    <div class="mb-3">
        <img alt="" v-bind:src="avatar_src" width="250" height="250" id="avatar_setting">
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Фото профиля</label>
        <input type="file" id="avatar" class="form-control">
    </div>
    <div class="mb-3">
        <input v-model="first_name_inp" type="text" class="form-control" placeholder="Имя">
    </div>
    <div class="mb-3">
        <input v-model="second_name_inp" type="text" class="form-control" placeholder="Фамилия">
    </div>
    <div class="mb-3">
        <label for="date-born">Дата рождения</label>
        <input v-model="date_born_inp" type="date" id="date-born" class="form-control">
    </div>


    <div class="mb-3">
        <label for="list-country">Страна проживания</label>
        <input v-model="country_inp" placeholder="Страна" list="country" class="form-control" id="list-country" name="country-choice" />
        <datalist id="country">
            <option value="Россия">Россия</option>
        </datalist>
    </div>
    <div class="mb-3">
        <label for="list-city">Город проживания</label> 
        <input v-model="city_inp" placeholder="Город" list="city" class="form-control" id="list-city" name="city-choice" />
        <datalist id="city" >
            <option v-for="c in cities" :value="c.city">{{ c.city }}</option>
        </datalist>
    </div>
    <div class="mb-3">
        <label for="date-born">Увлечения</label>
        <input v-model="hobbies_inp" type="text" class="form-control" placeholder="Увлечения">
    </div>
    <div class="mb-3">
        <label for="date-born">Описание о себе</label>
        <textarea v-model="description_inp" resize="none" class="form-control" placeholder="Описание о себе">
        </textarea>
    </div>

    <div class="mb-3">
        <input v-on:click="setSetting" type="submit" class="btn btn-primary" value="Сохранить">
    </div>
    <div class="mb-3">
        <router-link :to="{name: 'peoples'}" class="btn btn-secondary">Отменить</router-link>
    </div>
    

</div>
</template>
<script>
import axios from "axios";

export default
{
    data() { return {
        first_name_inp: "",
        second_name_inp: "",
        date_born_inp: "",
        city_inp: "",
        country_inp: "",
        description_inp: "",
        hobbies_inp: "",
        avatar_src: "",
        cities: "",
        
        TF: true,
    }},
    methods:
    {
        pageLoader(el)
        {
            this.TF = el;
        },
        setSetting()
        {
            
            if(this.date_born_inp == null)
            {
                alert("Укажите дату рождения");
            }
            else
            {
                axios.get('/sanctum/csrf-cookie').then(res =>
                {
                    const form = new FormData();
                    form.append("first_name_inp", this.first_name_inp);
                    form.append("second_name_inp", this.second_name_inp);
                    form.append("date_born_inp", this.date_born_inp);
                    form.append("city_inp", this.city_inp);
                    form.append("country_inp", this.country_inp);
                    form.append("description_inp", this.description_inp);
                    form.append("hobbies_inp", this.hobbies_inp);
                    form.append("photo", document.querySelector("#avatar").files[0]);

                    axios.post("/api/setSetting", form).then(res =>
                    {
                        this.$router.push({name: "peoples"})  
                    })
                })
            }
        },
        getSetting()
        {
            this.pageLoader(true);
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get("/api/getSetting")
                .then(res => 
                {
                    this.first_name_inp = res.data.user_info.first_name;
                    this.second_name_inp = res.data.user_info.second_name;
                    this.date_born_inp = res.data.user_info.date_born;
                    this.city_inp = res.data.user_info.city;
                    this.country_inp = res.data.user_info.country;
                    this.avatar_src = res.data.user_info.avatar;
                    this.description_inp = res.data.user_info.description;
                    this.hobbies_inp = res.data.user_info.hobbies;
                    
                    this.cities = res.data.cities;
                    
                    this.pageLoader(false);
                })
            })
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
    object-fit: contain;
    width: 250px;
}
</style>