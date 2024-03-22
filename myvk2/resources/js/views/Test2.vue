<template>
<h1>
    Test2 {{ $route.params.koko }}

</h1>
</template>

<script>
export default
{
    data() {return {
        wowo: "lok:"
    }},
    props: {
        lolo: {
            type: String,
        }
    }
}
</script>

<style>

</style>