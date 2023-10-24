import { createRouter, createWebHistory } from 'vue-router'
import Layout from '@/views/Layout/Layout.vue'
import Login from '@/views/Login/Login.vue'
import Home from '@/views/Home/Home.vue'
import JobSearch from '@/views/JobSearch/index.vue'
import Profile from '@/views/Profile/index.vue'
import JobPost from '@/views/JobPost/index.vue'
import Register from '@/views/Register/Register.vue'
import PostedAD from '@/views/JobPost/PostedAD.vue'
import Apply from '@/views/JobPost/Apply.vue'
import ApplicationStatus from '@/views/ApplicationStatus/index.vue'
import ChatBox from '@/views/ChatBox/ChatBox.vue'; // 聊天框页面组件的路径

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
        {
          path: '/JobPost',
          component:JobPost
        },
       
      {
        path: "/JobSearch/:id",
        name: "jobDetail",
    
        component: () =>
          import(/* webpackChunkName: "jobDetail" */ "../views/JobSearch/JobDetail.vue"),
      },
    ]
    },
   
    {
      path: '/login',
      component:Login
    
    },
    {
      path: '/Register',
      component:Register
    },
    {
      path: '/PostedAD',
      component:PostedAD
    },
    {
      path: '/Apply/:id',
      component:Apply
    },
    {
      path: '/ApplicationStatus',
      component:ApplicationStatus
    
    },
    {
      path: '/chat',
      name: 'ChatBox',
      component: ChatBox,
    },
  ],

  scrollBehavior(){
    return{
      top:0
    }
  }
})

export default router
