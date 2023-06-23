import { createRouter, createWebHistory } from 'vue-router'
import CarrinhoTradicional from '../views/CarrinhoTradicional.vue'
import CarrinhoNovo from '../views/CarrinhoNovo.vue'
import Login from '../views/Login.vue'
import Guard from '../services/middleware'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/',
    name: 'carrinho',
    component: CarrinhoTradicional,
    beforeEnter: Guard.auth,
  },
  {
    path: '/carrinho-novo',
    name: 'Carrinho-novo',
    component: CarrinhoNovo,
    beforeEnter: Guard.auth,
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
