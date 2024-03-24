<template>
    <span>{{ login_user }}</span>
</template>

<script>
export default
{
    data() { return {
        login_user: " "
    }},
    methods:
    {
        getLogin()
        {
            axios.get('/sanctum/csrf-cookie').then(res =>
            {
                axios.get("/api/getAccountName")
                .then(res => 
                {
                    if(localStorage["x_xsrf_token"])
                    {
                        console.log("aalolx");
                        this.login_user = res.data.name;
                    } 
                    else
                    {
                        this.login_user = ""; 
                    } 
                    // this.login_user = res.data.name;
                })
            })
        }
    },
    mounted()
    {
        this.getName();
    },
    updated()
    {
        this.getName();
    }
}
</script>

<style>

</style>