import Vue from 'vue'
import VueRouter from 'vue-router'

import Auth from '@vue/page/Auth'
import Account from '@vue/page/Account'
import Cars from '@vue/page/Cars'
import AddCar from '@vue/page/AddCar'
import SingleCar from '@vue/page/SingleCar'
import authGuard from './auth-guard.js'

Vue.use(VueRouter);

const routes = [
  {
    path: '/auth',
    name: 'auth',
    component: Auth,
    meta: {
      title: 'Автолидер и партнеры - Вход в личный кабинет',
      //layout: 'home'
    }
  },
  {
    path: '/account',
    name: 'account',
    component: Account,
    beforeEnter: authGuard,
    meta: {
      title: 'Автолидер и партнеры - Личный кабинет',
      layout: 'home'
    },
    children: [
      {
        path: 'cars',
        component: Cars,
        name: 'account-cars',
        meta: {
          title: 'Автолидер и партнеры - Мои авто',
          layout: 'home'
        },
      },
      {
        path: 'cars/add',
        component: AddCar,
        name: 'add-car',
        meta: {
          title: 'Автолидер и партнеры - Добавить авто',
          layout: 'home'
        },
      },
      {
        path: 'cars/:id',
        component: SingleCar,
        name: 'single-car',
        meta: {
          title: 'Автолидер и партнеры - Мой авто',
          layout: 'home'
        },
      },
      {
        path: 'repair/:id',
        component: SingleCar,
        name: 'single-repair',
        meta: {
          title: 'Автолидер и партнеры - Добавить ремонт',
          layout: 'home'
        },
      },
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  routes,
  linkActiveClass: "active",
  linkExactActiveClass: "exact-active",
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
})

export default router