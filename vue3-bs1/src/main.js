import '@/styles/common.scss'
import { componentPlugin } from '@/components'
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import {lazyPlugin} from "@/directives";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

import { ref, provide } from 'vue'
// 引入loading组件

// import Loading from "@/components/Loading/main";
// import PopupProgress from "@/components/popup-progress";
// import Message from "@/components/message";

const app = createApp(App)

// 检查本地存储是否有保存的状态
// const storedState = JSON.parse(localStorage.getItem('globalState'))

// 创建全局状态管理对象
const globalState = ref({
    user: null,
    role: null,
    // 其他状态属性
  })

  app.provide('globalState', globalState)

  window.addEventListener('unload', () => {
      console.log('unload event triggered')
      localStorage.setItem('globalState', JSON.stringify(globalState.value))
    })

    // 在页面卸载之前保存全局状态
window.addEventListener('beforeunload', () => {
  localStorage.setItem('globalState', JSON.stringify(globalState.value))
})

// 在页面加载时还原全局状态
const storedState = JSON.parse(localStorage.getItem('globalState'))
// if (storedState) {
//   globalState.value = storedState
// }
// 如果没有存储的用户状态，即初始加载
if (!storedState || !storedState.user) {
  globalState.value.user = null;
  globalState.value.role = null;
} else {
  globalState.value = storedState;
}

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia)
app.use(router)
app.use(lazyPlugin)
app.use(componentPlugin)
app.mount('#app')

// 使用loading 组件

// Vue.use(Loading);
// Vue.use(PopupProgress);
// Vue.use(Message);
