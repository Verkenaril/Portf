<template>
<div class="container" :key="componentKey">
    <div class="mb-3">
        <input type="email" v-model="email_inp" class="form-control" placeholder="Email">
    </div>
    <div class="mb-3">
        <input type="password" v-model="password_inp" class="form-control" placeholder="Password">
    </div>
    <div class="mb-3">
        <input type="submit" v-on:click="login" class="btn btn-primary">
    </div>
        <h4 v-if="fail_inp" v-text="message" class="fail">
    </h4>
</div>
</template>

<script>
import axios from "axios";

export default
{
    data() { return {
        email_inp: "",
        password_inp: "",
        fail_inp: null,
        componentKey: 0,
        }
    },
    methods:
    {
        forceRender() 
        {
            this.componentKey++;
        },
        login()
        {
            this.forceRender();
            if(this.checkFillInput() != 1) return 0;
            this.checkExistUser();
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/login", 
                {
                    email: this.email_inp,
                    password: this.password_inp 
                }).then(res =>
                {
                    localStorage["x_xsrf_token"] = res.config.headers["X_XSRF_TOKEN"];
                    console.log(res);
                    // this.$router.push({name: "peoples"});
                }).catch(err => 
                {
                    if(err)
                    {
                        this.message = "Имя пользователя или пароль введены неверно"
                        this.fail_inp = true;
                    } 
                })
            })
        },
        checkFillInput()
        {
            if(this.email_inp == "" || this.password_inp == "")
            {
                this.message = "Заполните все поля";
                this.fail_inp = true;
                return 0;
            }
            else
            {
                this.fail_inp = false;
                return 1;
            }
        },
        checkExistUser()
        {
            axios.post("/api/existuser", {email: this.email_inp, password: this.password_inp})
            .then(res =>
            {
                if(res.data != 1)
                {
                    this.message = "Пользователя с таким email не существует";
                    this.fail_inp = true;
                }
            })
            .catch(err => console.log(err))
        }
    }
}
</script>

<style>

</style>