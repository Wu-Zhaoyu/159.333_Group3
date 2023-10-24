<script setup>
import {getCategoryAPI} from "@/apis/layout";
import { inject } from 'vue'
import { ref } from 'vue'
const globalState = inject('globalState')

const categoryList = ref([]);
// const getCategory = async ()=>{
//   const res = await getCategoryAPI();
//   //console.log(res.result);
//   categoryList.value = res.result;
// }

// onMounted(()=>{
//   getCategory();
// })

</script>

<template>
  <header class='app-header'>
    <div class="container">
      <h1 class="logo">
        <RouterLink to="/">招聘网站</RouterLink>
      </h1>
      <ul class="app-header-nav">
        <li class="home">
          <RouterLink to="/">Home</RouterLink>
        </li>
        <li class="job_search">
          <RouterLink to="/JobSearch">Job Search</RouterLink>
        </li>
        <template v-if="globalState.user">
          <template v-if = "globalState.role === 'Employee'">
            <li><a href="javascript:;" @click="$router.push('/Profile')">Profile</a></li>
          </template>
          <template v-else-if = "globalState.role === 'Employer'">
            <li><a href="javascript:;" @click="$router.push('/JobPost')">Create A Job Ad</a></li>
          </template>
        </template>
        <template v-else>
        </template>
        
        <!-- <li v-for="item in categoryList" :key="item.id">
          <RouterLink active-class="active" :to="`/category/${item.id}`">{{item.name}}</RouterLink>
        </li> -->
      </ul>
      <!-- 头部购物车 -->
      
    </div>
  </header>
</template>


<style scoped lang='scss'>
.app-header {
  background: #fff;

  .container {
    display: flex;
    align-items: center;
    font-weight: bold;
  }

  .logo {
    width: 200px;

    a {
      display: block;
      height: 82px;
      width: 100%;
      text-indent: -9999px;
      background: url('@/assets/images/logo.png') no-repeat center 18px / contain;
     
    }
  }

  .app-header-nav {
    width: 820px;
    display: flex;
    padding-left: 40px;
    position: relative;
    z-index: 998;
  
    li {
      margin-right: 40px;
      width: 200px;
      text-align: center;
  
      a {
        font-size: 22px;
        line-height: 32px;
        height: 32px;
        display: inline-block;
  
        &:hover {
          color: $xtxColor;
          border-bottom: 1px solid $xtxColor;
        }
      }
  
      .active {
        color: $xtxColor;
        border-bottom: 1px solid $xtxColor;
      }
    }
  }

  .search {
    width: 170px;
    height: 32px;
    position: relative;
    border-bottom: 1px solid #e7e7e7;
    line-height: 32px;

    .icon-search {
      font-size: 18px;
      margin-left: 5px;
    }

    input {
      width: 140px;
      padding-left: 5px;
      color: #666;
    }
  }

  .cart {
    width: 50px;

    .curr {
      height: 32px;
      line-height: 32px;
      text-align: center;
      position: relative;
      display: block;

      .icon-cart {
        font-size: 22px;
      }

      em {
        font-style: normal;
        position: absolute;
        right: 0;
        top: 0;
        padding: 1px 6px;
        line-height: 1;
        background: $helpColor;
        color: #fff;
        font-size: 12px;
        border-radius: 10px;
        font-family: Arial;
      }
    }
  }
}
</style>