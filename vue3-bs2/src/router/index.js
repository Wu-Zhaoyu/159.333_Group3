import { createRouter, createWebHistory } from 'vue-router'
import Layout from '@/views/Layout/Layout.vue'
import Login from '@/views/Login/Login.vue'
import Home from '@/views/Home/Home.vue'
import JobSearch from '@/views/JobSearch/index.vue'
import Profile from '@/views/Profile/index.vue'
import JobPost from '@/views/JobPost/index.vue'
import Register from '@/views/Register/Register.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component:Layout,
      children:[
        {
          path: '',
          component:Home
        },
        {
          path: '/JobSearch',
          component:JobSearch
        },
        {
          path: '/Profile',
          component:Profile
        },
      ]
      
    },
    {
      path: '/login',
      component:Login
    
    },
    {
      path: '/JobPost',
      component:JobPost
    },
    {
      path: '/Register',
      component:Register
    }
  ],

  scrollBehavior(){
    return{
      top:0
    }
  }
})

export default router
