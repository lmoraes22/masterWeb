<template>
  <div class="d-flex justify-content-center p-4">
    <div class="card d-flex justify-content-center py-4 rounded-3" style="width: 42rem;">
      <h1 class="display-6">Lista de Produtos</h1>
      <p>Escolha uma das opções abaixo:</p>
      <p v-for="produto in produtos" :key="produto.id">
        <a class="btn rounded-3 text-light px-0 py-0" style="background-color: #A855F7;" @click="addCart(produto)"><i
            class="bi bi-plus h3"></i></a>&nbsp;
        <span class="h4"> {{ produto.nome }}</span>
      </p>
      <h1 class="display-6 pt-4">Checkout</h1>
      <p>Resumo da compra:</p>
      <div v-if="!(carrinho.length > 0)">
        <p class="h4">Nenhum produto no carrinho.</p>
      </div>
      <div v-else>
        <p v-for="cart in carrinho" :key="cart.id">
          <span class="h4">{{ cart.quantidade }}x {{ cart.nome }}</span>&nbsp;
          <a class="btn rounded-3 text-light px-0 py-0 btn-danger" @click="removeCart(cart)"><i
              class="bi bi-trash-fill h3"></i></a>
        </p>
      </div>
      <button type="button"
              @click="fecharPedido"
              :class="carrinho.length > 0 ? 'btn btn-outline-secondary m-4 p-4 btn-lg' : 'btn btn-outline-secondary m-4 p-4 btn-lg disabled'">
        <b><i class="bi bi-cart-fill"></i>&nbsp;&nbsp;FECHAR PEDIDO</b>
      </button>
    </div>
  </div>
  <p class="text-light">Copyright 2023 - Master da Web</p>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Cart',
  data() {
    return {
      produtos: [],
      carrinho: [],
      total: 0,
    };
  },
  created() {
    this.findProdutos()
  },
  methods: {
    addCart(produto) {
      let index = this.carrinho.findIndex(x => x.id === produto.id);
      if (index >= 0) {
        this.carrinho[index].quantidade++;
      } else {
        this.carrinho.push({
          id: produto.id,
          nome: produto.nome,
          quantidade: 1,
          preco: produto.preco,
        });
      }
    },
    removeCart(produto) {
      let index = this.carrinho.findIndex(x => x.id === produto.id);
      if (index >= 0) {
        this.carrinho.splice(index, 1);
      }
    },
    findProdutos() {
      axios.get(process.env.VUE_APP_ROOT_API + 'produtos')
          .then(response => {
            this.produtos = response.data.data;
          });
    },
    fecharPedido() {
      axios.post(process.env.VUE_APP_ROOT_API + 'vendas', {
        'carrinho': this.carrinho,
        'total': this.total
      })
      .then(response => {
        this.$swal.fire({
          icon: 'success',
          title: response.data.message,
          showConfirmButton: false,
          timer: 3000
        });
        this.carrinho = [];
        this.total = 0;
      })
      .catch(error => {
        this.$swal.fire({
          icon: 'error',
          html: '<h3>Ops, tivemos problemas!</h3><small><a href="#">Clique aqui e entre em contato com nosso suporte para mais informações!</a></small>',
          showConfirmButton: false,
          timer: 3000
        });
        console.log(error)
      });
    }
  }
}
</script>