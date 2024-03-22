<template>
test 1
</template>

<script>
import axios from "axios";
export default
{
    methods:
    {
        send()
        {
            axios.get("/api/test").then(res => console.log(res))
        }
    },
    mounted()
    {
        this.send();
    },
    created()
	{
		window.Echo.channel("store_message") // имя заданное в broadcastOn()
		.listen(".store.m", res => {
			console.log(res) // res.message  имя заданное в broadcastWith()
		})
	}

}
</script>

<style>

</style>