import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '@vue/page/Home'
import About from '@vue/page/About'
import Contact from '@vue/page/Contact'
import Repair from '@vue/page/Repair'
import NotFound from '@vue/page/NotFound'
import Privacy from '@vue/page/Privacy'

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      title: 'Автолидер и партнеры - Главная',
      layout: 'home'
    }
  },
  {
    path: '/about',
    name: 'about',
    component: About,
    meta: {
      title: 'Автолидер и партнеры - О нас',
    }
  },
  {
    path: '/car-service',
    name: 'car-service',
    component: Repair,
    meta: {
      title: 'Автолидер и партнеры - Услуги',
    }
  },
  {
    path: '/contact',
    name: 'contact',
    component: Contact,
    meta: {
      title: 'Автолидер и партнеры - Контакты',
    }
  },
  {
    path: '/privacy',
    name: 'privacy',
    component: Privacy,
    meta: {
      title: 'Автолидер и партнеры - Политика в отношении обработки персональных данных',
    }
  },
  // {
  //   path: '/vehicles',
  //   name: 'vehicles',
  //   component: Contact,
  //   meta: {
  //     title: 'Contact page',
  //   }
  // },
  {
    path: '/404',
    name: '404',
    component: NotFound,
    meta: {
      title: 'Автолидер и партнеры - Страница не найдена',
    }
  },
  {
    path: '*',
    redirect: '/404',
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