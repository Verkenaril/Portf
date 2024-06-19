<template>
        <div id="other__post">
            <div class="other__title">Записи</div>
            <div id="" class="void-content" v-if="allposts.length == 0">Пусто</div>
            <div class="other__post-item" v-else v-for="(p, idx) in allposts">
                <div class="other__post-title">{{  p.name }}</div>
                <div ref="el" class="other__post-body">{{  p.post }}</div>
                <div ref="el_btn" class="other__post-more" v-on:click="showMore(idx)">Показать ещё</div>
            </div>
        </div>
</template>
<script>
export default {
    props: ["allposts"],
    data() { return {

    }},
    methods:
    {
        showMore(i)
        {


            this.$refs.el[i].classList.add("other__post-body-open");
            this.$refs.el_btn[i].style = "display: none";
        }
    },
}
</script>
<style>
@media (max-width: 512px)
{
.other__post-item
{
    width: 80vw;
}
}

@media (max-width: 397px)
{
.other__post-item
{
    width: 74vw;
}
}
</style>