<template>
  <nav>
    <router-link class="text-light" to="/login">Login</router-link> |
    <router-link class="text-light" to="/">Carrinho Tradicional</router-link> |
    <router-link class="text-light" to="/carrinho-novo">Novo Carrinho</router-link>
  </nav>
  <img alt="Master Web" style="width: 550px;" src="https://www.masterdaweb.com/images/logo-white-blue.png">
  <router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
<script setup>
</script>