<template>
  <div class="carrinho">
    <Cart/>
  </div>
</template>

<script>
// @ is an alias to /src
import Cart from '@/components/Cart.vue'

export default {
  name: 'CarrinhoTradicional',
  components: {
    Cart
  }
}
</script>
