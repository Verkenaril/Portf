<template>
<div class="container forLoader" v-if="TF">
    <div class="loader"></div>
</div>
<div class="container" v-else>
    <div class="actions">
            <input type="file" class="form-control mb-1 files" name="myfile">
            <button class="btn btn-primary" v-on:click="fileUpload">Добавить</button>
    </div>

    <div id="gallery">

        <gallery :images="array_hrefs_img" :index="index" @close="index = null"></gallery>
            <div v-for="(image, imageIndex) in filesImg" class="gallery__item">
                <div class="image"
                    :key="imageIndex"
                    @click="index = imageIndex"
                    :style="{ backgroundImage: 'url(' + image.file + ')', width: '150px', height: '100px' }">
                </div>
                <div class="trash">
                        <button class="trash-icon" v-on:click="deleteImg(imageIndex, image.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
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
        deleteImg(number, id)
        {
            this.filesImg.splice(number, 1);
            this.array_hrefs_img.splice(number, 1);
            axios.get('/sanctum/csrf-cookie').then(res =>
                {
                    axios.delete(`/api/deleteMedia/${id}`)
                    .then(res =>
                    {
                        
                    })
                })
        },
        showGallery()
        {
            this.pageLoader(true);
            this.filesImg = [];
            axios.get('/sanctum/csrf-cookie').then(res =>
                {
                    axios.get("/api/getGallery")
                    .then(res =>
                    {
                        for(let key in res.data)
                        {
                            this.filesImg.push(res.data[key]);
                            this.array_hrefs_img.push(res.data[key].file);
                        }
                        this.pageLoader(false);

                    })
                })
        },
        fileUpload()
        {
            if(document.getElementsByTagName("input")[0].value == "") alert("Нужно указать файл формата png, jpg, jpeg, bmp");
            else if(document.getElementsByTagName("input")[0].files[0].type == "image/jpeg" 
            || document.getElementsByTagName("input")[0].files[0].type == "image/bmp"
            || document.getElementsByTagName("input")[0].files[0].type == "image/png"
            || document.getElementsByTagName("input")[0].files[0].type == "image/jpg")
            {

                axios.get('/sanctum/csrf-cookie').then(res =>
                {
                    const form = new FormData();
                    form.append("file1", document.querySelector(".files").files[0]);
                    document.getElementsByTagName("input")[0].value = "";
                    
                    this.pageLoader(true);

                    axios.post("/api/uploadGallery", form)
                    .then(res =>
                    {
                        this.showGallery();
                    })
                })
            }
            else
            {
                alert("Нужно указать файл формата png, jpg, jpeg, bmp");
            } 
        },
    },
    mounted()
    {
        this.showGallery();
    }
}

</script>

<style>
  .image {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid #ebebeb;
    margin: 5px;
  }
.gallery__item
{
    display: inline-block;
}

.trash-icon
{
    background-color: white;
    border-radius: 50%;
    border: none;
    margin: 3px;
}
.trash
{
    display: inline-block;
}
</style>
