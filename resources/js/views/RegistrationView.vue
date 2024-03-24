<template>
 <div class="container">
    <div class="mb-3">
        <input v-model="email_inp" type="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input v-model="name_inp" type="text" class="form-control" placeholder="Логин" required>
    </div>
    <div class="mb-3">
        <input v-model="first_name_inp" type="text" class="form-control" placeholder="Имя" required>
    </div>
    <div class="mb-3">
        <input v-model="second_name_inp" type="text" class="form-control" placeholder="Фамилия" required>
    </div>
    <div class="mb-3">
        <input v-model="password_inp" type="password" class="form-control" placeholder="Пароль" required>
    </div>
    <div class="mb-3">
        <input v-model="password_confirm_inp" type="password" class="form-control" placeholder="Подтверждение пароля" required>
    </div>
    <div class="mb-3">
        <input v-on:click="registration" type="submit" class="btn btn-primary">
    </div>
    <h4 v-if="fail_inp" v-text="message" class="fail">
    </h4>

</div>
</template>

<script>
import axios from 'axios';

export default
{
    data() { return {
        email_inp: null,
        name_inp: null,
        password_inp: null,
        password_confirm_inp: null,
        first_name_inp: null,
        second_name_inp: null,
        fail_inp: false,
        message: null,
        saved_token_inp: null,
        }
    },
    methods:
    {
        test() 
        {
            axios.post("/api/test", 
            {
                name: this.name_inp,
                email: this.email_inp,
                password: this.password_inp,
                password_confirmation: this.password_confirm_inp,
                first_name: this.first_name_inp,
                second_name: this.second_name_inp,
            })
            .then(res => console.log(res.data));
            
        },

        registration()
        {
            this.checkConfPass();
            this.checkFillInput();
            this.checkExistUser();
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.post("/register", 
                {
                    name: this.name_inp,
                    email: this.email_inp,
                    password: this.password_inp,
                    password_confirmation: this.password_confirm_inp,
                    first_name: this.first_name_inp,
                    second_name: this.second_name_inp,
                }).then(res =>
                {
                    localStorage["x_xsrf_token"] = res.config.headers["X_XSRF_TOKEN"];
                    
                    this.$router.push({name: "peoples"});
                    
                })
            })
            .catch(err => alert("client"))
        },
        checkConfPass()
        {
            if(this.password_inp === this.password_confirm_inp)
            {
                this.fail_inp = false;
            }
            else
            {
                this.fail_inp = true;
                this.message = "Пароли не совпадают";
                throw this.message;
            }
        },
        checkFillInput()
        {
            if(this.name_inp != null && this.email_inp != null && this.password_inp != null && this.first_name_inp != null && this.second_name_inp != null)
            {
                this.fail_inp = false;
            }
            else
            {
                this.message = "Заполните все поля";
                this.fail_inp = true;
                throw this.message;
            }
        },
        checkExistUser()
        {
            axios.post("/api/existuser", {email: this.email_inp, name: this.name_inp})
            .then(res =>
            {
                if(res.data != 0)
                {
                    this.message = "Пользователь с таким email или именем уже существует";
                    this.fail_inp = true;
                    throw this.message;
                }
            })
        }
    },
}
</script>

<style>

</style>