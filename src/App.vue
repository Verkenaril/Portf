<template>
  <CardGame2></CardGame2>
  <!-- <CardGame></CardGame> -->
</template>

<script>
import HelloWorld from './components/HelloWorld.vue';
import CardGame from './components/CardGame.vue';
import CardGame2 from './components/CardGame2.vue';

export default {
    name: 'App',
    components: {
        HelloWorld,
        CardGame,
        CardGame2,
    },
    data(){ return {
    cards: "test"
    }

}
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
