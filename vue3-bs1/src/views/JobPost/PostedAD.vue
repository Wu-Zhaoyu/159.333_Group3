<template>
  <LayoutNav></LayoutNav>
  <div  class="back">
      <RouterLink class="entry" to="/">
          <i class="iconfont icon-angle-left"></i>
          <i class="iconfont icon-angle-left"></i>
          Back to home page
        </RouterLink>
      </div>
    <div class="jobs"><h1>My Recent Job Ads</h1></div>
  
    <div class="content">
    <ul class="content-list">
        <li class="content-item" v-for="result in searchResults" :key="result.id">
            <router-link :to="`/Apply/${result.id}`">
        <h3 class="title">{{ result.jobName }}</h3>
        <div class="subTitle">
            <span class="location">{{ result.address }}</span>&nbsp;|
            <span class="category">{{ result.category }}</span>&nbsp;|
            <span class="jobtype">{{ result.jobtype }}</span>
        </div>
        <p class="desc">{{ result.description }}</p>
    </router-link>
        </li>
    </ul>
    </div>
  
    <LayoutFooter></LayoutFooter>
    
  </template>
  <script>
  import axios from 'axios'
  import LayoutNav from '@/views/Layout/components/LayoutNav.vue';
  import LayoutFooter from '@/views/Layout/components/LayoutFooter.vue';
  
  export default {
    name: "job",
    data() {
        return {
            searchResults: []
        };
    },
    created() {
      const token = sessionStorage.getItem('token') || 'NO_TOKEN';

      axios({
        method:'get',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/showJobs',
        headers:{
          "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
        },
        params:{
          token:token,
        }
      }).then((response) =>  {
        console.log(response.data);
          this.searchResults = response.data;
      }).catch(error => {
        console.error(error);
      });
    
    },
components: { LayoutNav,LayoutFooter }
}

  
  </script>
  <style lang="scss" scoped>
  .back{
    margin-top: 15px;
}
.entry {
    width: 120px;
    margin-bottom: 38px;
    font-size: 16px;
    
    margin-left: 40px;
    margin-top: 40px;

    i {
      font-size: 14px;
      color: $xtxColor;
      letter-spacing: -5px;
    }
  }

 
  
  .content {
    width: 80%;
    // height: 1300px;
    margin: 0 auto;
    margin-top: 50px;
    padding: 0 100px 0 200px;
  // background-color: red;
}

.content-item{
  margin-left: 30px;
  margin-right: 30px;
  margin-top: 30px;
}
.content-item h3{
  padding-right: 30px;
}

.jobs h1{
  text-align: center;
  width: 100%;
  height: 80px;
  padding-top: 10px;
  margin-top: 50px;
  font-size: 38px;
  color: #198191;
}

.content {
min-height: 500px;
padding-left: 20px;
border-left: 1px solid #ebeef5;
margin-left: 13%;
margin-right: 7%;
&-title {
  margin-bottom: 30px;
  margin-left: 20px;
  padding: 0px;
  margin: 0px;
}



&-item {
  margin-bottom: 10px;
  padding: 10px 20px;
  cursor: pointer;
  .title {
    margin: 12px 0;
  }
  .subTitle {
    color: #606266;
  }
  .desc {
    white-space: pre-line;
    font-size: 14px;
    color: #909399;
    // .text-overflow-visible-line(2);
    text-overflow: clip;
  }
  &:hover {
    border-radius: 3px;
    background: #fff;
    box-shadow: 0 10px 30px 0 rgba(136, 150, 171, 0.15);
  }
}
}


  </style>
  