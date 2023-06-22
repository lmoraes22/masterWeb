<template>
  <div class="carrinho-novo">
    <NewCart/>
  </div>
</template>
<script>
// @ is an alias to /src
import NewCart from '@/components/NewCart.vue'

export default {
  name: 'CarrinhoNovo',
  components: {
    NewCart
  }
}
</script>