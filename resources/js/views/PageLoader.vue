<template>
<div id="big" v-if="!isload"></div>
</template>

<script>
export default
{
    data() {return {
        isload: false,
    }},
    mounted()
    {
        document.onreadystatechange = () =>
        {
            if(document.readyState == "complete")
            {
                this.isload = true;
            }
        }
    }
}
</script>

<style>
#big
{
    width: 100%;
    height: 100%;
    background-color: rgb(245, 3, 3);
    position: fixed;
    z-index: 999;
}
</style>