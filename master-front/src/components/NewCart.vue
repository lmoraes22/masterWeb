<template>
  <div class="d-flex justify-content-center p-4">
    <div class="card d-flex justify-content-center p-4 rounded-3" style="width: 75rem; background-color: #F8F8FF;">
      <div class="container bootstrap snipets">
        <h1 class="text-center text-muted">Produtos</h1>
        <div class="row flow-offset-1">

          <div class="col-xs-6 col-md-4" role="button" v-for="produto in produtos" :key="produto.id" @click="addCart(produto)">
            <div class="product tumbnail thumbnail-3"><img :src="produto.imagem">
              <div class="caption">
                <h6><a href="#">{{produto.nome}}</a></h6><span class="price">
                <del>R$ {{(produto.preco * 0.20).toFixed(2)}}</del></span><span class="price sale">R$ {{produto.preco.toFixed(2)}}</span>
              </div>
            </div>
          </div>

        </div>
      </div>
      <hr>
      <div class="container pb-5 mb-2">
        <div class="cart-item d-md-flex justify-content-between" v-for="cart in carrinho" :key="cart.id">
          <span class="remove-item" @click="removeCart(cart)"><i class="bi bi-x"></i></span>
          <div class="px-3 my-3">
            <a class="cart-item-product" href="#">
              <div class="cart-item-product-thumb"><img :src="cart.imagem" alt="Product"></div>
              <div class="cart-item-product-info">
                <h4 class="cart-item-product-title">{{cart.nome}}</h4>
                <span><strong>Descrição:</strong> {{cart.descricao}}</span>
              </div>
            </a>
          </div>
          <div class="px-3 my-3 text-center">
            <label for="exampleFormControlInput1" class="form-label">Quantidade</label>
            <input type="number" v-model="cart.quantidade" class="form-control" min='0' onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57">
          </div>
          <div class="px-3 my-3 text-center">
            <div class="cart-item-label">Subtotal</div><span class="text-xl font-weight-medium">R$ {{(cart.preco * cart.quantidade).toFixed(2)}}</span>
          </div>
        </div>
        <div class="d-sm-flex justify-content-between align-items-center text-center text-sm-left">
          <form class="form-inline py-2">
          </form>
          <div class="py-2">
            <span class="d-inline-block align-middle text-sm text-muted font-weight-medium text-uppercase mr-2">Total:</span>&nbsp;&nbsp;
            <span class="d-inline-block align-middle text-xl font-weight-medium"><b>R$ {{total.toFixed(2)}}</b></span>
          </div>
        </div>

        <hr class="my-2">
        <div class="d-grid">
          <button type="button"
                  @click="fecharPedido"
                  :class="carrinho.length > 0 ? 'btn btn-outline-secondary m-4 p-4 btn-lg' : 'btn btn-outline-secondary m-4 p-4 btn-lg disabled'">
            <b><i class="bi bi-cart-fill"></i>&nbsp;&nbsp;FECHAR PEDIDO</b>
          </button>
        </div>
      </div>
    </div>
  </div>
  <p class="text-light">Copyright 2023 - Master da Web</p>
</template>

<script>
import axios from 'axios';

export default {
  name: 'NewCart',
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
  watch: {
    carrinho: {
      handler(val){
        this.total = 0;
        for (let i = 0; i < val.length; i++) {
          this.total += val[i].quantidade * val[i].preco
        }
      },
      deep: true
    }
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
          imagem: produto.imagem,
          preco: produto.preco,
          descricao: produto.descricao
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

<style>
body{
  margin-top:20px;
  background:#eee;
}
.product-card {
  position: relative;
  max-width: 380px;
  padding-top: 12px;
  padding-bottom: 43px;
  transition: all 0.35s;
  border: 1px solid #e7e7e7;
}
.product-card .product-head {
  padding: 0 15px 8px;
}
.product-card .product-head .badge {
  margin: 0;
}
.product-card .product-thumb {
  display: block;
}
.product-card .product-thumb > img {
  display: block;
  width: 100%;
}
.product-card .product-card-body {
  padding: 0 20px;
  text-align: center;
}
.product-card .product-meta {
  display: block;
  padding: 12px 0 2px;
  transition: color 0.25s;
  color: rgba(140, 140, 140, .75);
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
}
.product-card .product-meta:hover {
  color: #8c8c8c;
}
.product-card .product-title {
  margin-bottom: 8px;
  font-size: 16px;
  font-weight: bold;
}
.product-card .product-title > a {
  transition: color 0.3s;
  color: #343b43;
  text-decoration: none;
}
.product-card .product-title > a:hover {
  color: #ac32e4;
}
.product-card .product-price {
  display: block;
  color: #404040;
  font-family: 'Montserrat', sans-serif;
  font-weight: normal;
}
.product-card .product-price > del {
  margin-right: 6px;
  color: rgba(140, 140, 140, .75);
}
.product-card .product-buttons-wrap {
  position: absolute;
  bottom: -20px;
  left: 0;
  width: 100%;
}
.product-card .product-buttons {
  display: table;
  margin: auto;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .11);
}
.product-card .product-button {
  display: table-cell;
  position: relative;
  width: 50px;
  height: 40px;
  border-right: 1px solid rgba(231, 231, 231, .6);
}
.product-card .product-button:last-child {
  border-right: 0;
}
.product-card .product-button > a {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: all 0.3s;
  color: #404040;
  font-size: 16px;
  line-height: 40px;
  text-align: center;
  text-decoration: none;
}
.product-card .product-button > a:hover {
  background-color: #ac32e4;
  color: #fff;
}
.product-card:hover {
  border-color: transparent;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.product-category-card {
  display: block;
  max-width: 400px;
  text-align: center;
  text-decoration: none !important;
}
.product-category-card .product-category-card-thumb {
  display: table;
  width: 100%;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.product-category-card .product-category-card-body {
  padding: 20px;
  padding-bottom: 28px;
}
.product-category-card .main-img, .product-category-card .thumblist {
  display: table-cell;
  padding: 15px;
  vertical-align: middle;
}
.product-category-card .main-img > img, .product-category-card .thumblist > img {
  display: block;
  width: 100%;
}
.product-category-card .main-img {
  width: 65%;
  padding-right: 10px;
}
.product-category-card .thumblist {
  width: 35%;
  padding-left: 10px;
}
.product-category-card .thumblist > img:first-child {
  margin-bottom: 6px;
}
.product-category-card .product-category-card-meta {
  display: block;
  padding-bottom: 9px;
  color: rgba(140, 140, 140, .75);
  font-size: 11px;
  font-weight: 600;
}
.product-category-card .product-category-card-title {
  margin-bottom: 0;
  transition: color 0.3s;
  color: #343b43;
  font-size: 18px;
}
.product-category-card:hover .product-category-card-title {
  color: #ac32e4;
}
.product-gallery {
  position: relative;
  padding: 45px 15px 0;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.product-gallery .gallery-item::before {
  display: none !important;
}
.product-gallery .gallery-item::after {
  box-shadow: 0 8px 24px 0 rgba(0, 0, 0, .26);
}
.product-gallery .video-player-button, .product-gallery .badge {
  position: absolute;
  z-index: 5;
}
.product-gallery .badge {
  top: 15px;
  left: 15px;
  margin-left: 0;
}
.product-gallery .video-player-button {
  top: 0;
  right: 15px;
  width: 60px;
  height: 60px;
  line-height: 60px;
}
.product-gallery .product-thumbnails {
  display: block;
  margin: 0 -15px;
  padding: 12px;
  border-top: 1px solid #e7e7e7;
  list-style: none;
  text-align: center;
}
.product-gallery .product-thumbnails > li {
  display: inline-block;
  margin: 10px 3px;
}
.product-gallery .product-thumbnails > li > a {
  display: block;
  width: 94px;
  transition: all 0.25s;
  border: 1px solid transparent;
  background-color: #fff;
  opacity: 0.75;
}
.product-gallery .product-thumbnails > li:hover > a {
  opacity: 1;
}
.product-gallery .product-thumbnails > li.active > a {
  border-color: #ac32e4;
  cursor: default;
  opacity: 1;
}
.product-meta {
  padding-bottom: 10px;
}
.product-meta > a, .product-meta > i {
  display: inline-block;
  margin-right: 5px;
  color: rgba(140, 140, 140, .75);
  vertical-align: middle;
}
.product-meta > i {
  margin-top: 2px;
}
.product-meta > a {
  transition: color 0.25s;
  font-size: 13px;
  font-weight: 600;
  text-decoration: none;
}
.product-meta > a:hover {
  color: #8c8c8c;
}
.cart-item {
  position: relative;
  margin-bottom: 30px;
  padding: 0 50px 0 10px;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.cart-item .cart-item-label {
  display: block;
  margin-bottom: 15px;
  color: #8c8c8c;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
}
.cart-item .cart-item-product {
  display: table;
  width: 420px;
  text-decoration: none;
}
.cart-item .cart-item-product-thumb, .cart-item .cart-item-product-info {
  display: table-cell;
  vertical-align: top;
}
.cart-item .cart-item-product-thumb {
  width: 110px;
}
.cart-item .cart-item-product-thumb > img {
  display: block;
  width: 100%;
}
.cart-item .cart-item-product-info {
  padding-top: 5px;
  padding-left: 15px;
}
.cart-item .cart-item-product-info > span {
  display: block;
  margin-bottom: 2px;
  color: #404040;
  font-size: 12px;
}
.cart-item .cart-item-product-title {
  margin-bottom: 8px;
  transition: color, 0.3s;
  color: #343b43;
  font-size: 16px;
  font-weight: bold;
}
.cart-item .cart-item-product:hover .cart-item-product-title {
  color: #ac32e4;
}
.cart-item .count-input {
  display: inline-block;
  width: 85px;
}
.cart-item .remove-item {
  right: -10px !important;
}
@media (max-width: 991px) {
  .cart-item {
    padding-right: 30px;
  }
  .cart-item .cart-item-product {
    width: auto;
  }
}
@media (max-width: 768px) {
  .cart-item {
    padding-right: 10px;
    padding-bottom: 15px;
  }
  .cart-item .cart-item-product {
    display: block;
    width: 100%;
    text-align: center;
  }
  .cart-item .cart-item-product-thumb, .cart-item .cart-item-product-info {
    display: block;
  }
  .cart-item .cart-item-product-thumb {
    margin: 0 auto 10px;
  }
  .cart-item .cart-item-product-info {
    padding-left: 0;
  }
  .cart-item .cart-item-label {
    margin-bottom: 8px;
  }
}
.comparison-table {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}
.comparison-table table {
  min-width: 750px;
  table-layout: fixed;
}
.comparison-table .comparison-item {
  position: relative;
  margin-bottom: 10px;
  padding: 13px 12px 18px;
  background-color: #fff;
  text-align: center;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.comparison-table .comparison-item .comparison-item-thumb {
  display: block;
  width: 80px;
  margin-right: auto;
  margin-bottom: 12px;
  margin-left: auto;
}
.comparison-table .comparison-item .comparison-item-thumb > img {
  display: block;
  width: 100%;
}
.comparison-table .comparison-item .comparison-item-title {
  display: block;
  margin-bottom: 14px;
  transition: color 0.25s;
  color: #404040;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
}
.comparison-table .comparison-item .comparison-item-title:hover {
  color: #ac32e4;
}
.remove-item {
  display: block;
  position: absolute;
  top: -5px;
  right: -5px;
  width: 22px;
  height: 22px;
  padding-left: 1px;
  border-radius: 50%;
  background-color: #ff5252;
  color: #fff;
  line-height: 23px;
  text-align: center;
  box-shadow: 0 3px 12px 0 rgba(255, 82, 82, .5);
  cursor: pointer;
}
.card-wrapper {
  margin: 30px -15px;
}
@media (max-width: 576px) {
  .card-wrapper .jp-card-container {
    width: 260px !important;
  }
  .card-wrapper .jp-card {
    min-width: 250px !important;
  }
}
</style>

<style>
.product {
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: auto;
  margin-right: auto;
}

.product .caption {
  margin-top: 15px;
}

.product .caption h6 {
  color: #455a64;
}

.product .caption .price + .price {
  margin-left: 15px;
}

.product.tumbnail {
  box-shadow: 0 5px 25px 0 transparent;
  transition: 0.3s linear;
  padding-top: 0;
}

.product.tumbnail img:hover {
  box-shadow: 0 5px 25px 0 rgba(0, 0, 0, 0.2);
}

.single-product span {
  display: inline-block;
}

.single-product .rating .fa-star, .single-product .rating .fa-star-o {
  font-size: 16px;
  color: #f7d4a0;
  margin-left: 2px;
}

.single-product .rating + * {
  margin-left: 15px;
}

.single-product h1.h1-variant-2 {
  margin-bottom: 20px;
}

.single-product .caption:before {
  content: '';
  height: 100%;
  display: inline-block;
  vertical-align: middle;
}

.single-product .caption span {
  display: inline-block;
  vertical-align: middle;
}

.single-product .caption .price {
  font-weight: 400;
}

.single-product .caption .price.sale {
  color: #e75854;
  font-size: 33px;
}

.single-product .caption * + .price {
  margin-left: 10.8%;
}

@media (max-width: 1199px) {
  .single-product .caption * + .price {
    margin-left: 7.8%;
  }
}

.single-product .caption * + .quantity {
  margin-left: 26px;
}

.single-product .caption .info-list {
  border-bottom: 1px solid #f3f3ed;
  border-top: 1px solid #f3f3ed;
  font-family: Montserrat, sans-serif;
  padding-top: 26px;
  padding-bottom: 26px;
  text-align: left;
}

.single-product .caption .info-list dt, .single-product .caption .info-list dd {
  display: inline-block;
  line-height: 25px;
  padding-top: 10px;
  padding-bottom: 10px;
}

.single-product .caption .info-list dt {
  letter-spacing: 0.08em;
  font-size: 12px;
  color: #a7b0b4;
  width: 35%;
  text-transform: uppercase;
}

.single-product .caption .info-list dd {
  font-size: 15px;
  color: #565452;
  width: 62.5%;
}

.single-product .caption .share span.small {
  margin-top: 9px;
}

@media (max-width: 991px) {
  .single-product .caption .share span.small {
    display: block;
    margin-bottom: 15px;
  }
}

@media (max-width: 767px) {
  .single-product .table-mobile tr {
    padding-top: 0;
  }
  .single-product .table-mobile tr:before {
    display: none;
  }
}

.price {
  display: inline-block;
  font-size: 15px;
  font-family: Montserrat, sans-serif;
  font-weight: 700;
  letter-spacing: 0.02em;
  color: #2b2f3e;
}

.price.sale {
  color: #e75854;
}

.price del {
  color: #b0bec5;
}

.quantity {
  text-align: center;
  font-family: Montserrat, sans-serif;
  font-size: 12px;
  background: #eceff1;
  padding-top: 5px;
  padding-bottom: 5px;
  width: 82px;
  height: auto;
  display: inline-block;
}

.quantity span {
  display: inline-block;
}

.quantity .num {
  width: 26px;
}

.quantity [class*='fa-'] {
  padding-top: 4px;
  width: 22px;
  padding-bottom: 4px;
  color: #b0bec5;
  cursor: pointer;
}
</style>