import { createRouter, createWebHistory } from 'vue-router'
import CarrinhoTradicional from '../views/CarrinhoTradicional.vue'
import CarrinhoNovo from '../views/CarrinhoNovo.vue'
import Login from '../views/Login.vue'

const routes = [
  {
    path: '/',
    name: 'carrinho',
    component: CarrinhoTradicional
  },
  {
    path: '/carrinho-novo',
    name: 'Carrinho-novo',
    component: CarrinhoNovo
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
