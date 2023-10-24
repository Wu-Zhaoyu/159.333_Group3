<template>
    <div class="job-detail">
      <h1 class="job-detail-title">{{ jobDetail.jobName }}</h1>
      <div class="job-detail-subTitle" v-if="jobDetail.id">
        <span class="city_info">{{ jobDetail.address }}</span
        >&nbsp;|
        <span class="job_category">{{ jobDetail.category}}</span
        >&nbsp;|
        <span class="recruit_type">{{ jobDetail.jobtype}}</span>
      </div>
      <div class="job-detail-description job-detail-block">
        <h2>Job Description</h2>
        <pre class="textContent">{{ jobDetail.description }}</pre>
      </div>
      <div class="job-detail-summary job-detail-block">
        <h2>Summary</h2>
        <pre class="textContent">{{ jobDetail.summary }}</pre>
      </div>
      <div class="job-detail-button job-detail-block">
        <button class="mybtn" @click="apply" size="large">Apply</button>
      </div>
    </div>
  </template>
  <script>
 import axios from 'axios'
  export default {
    name: "job-detail",
    data() {
      return { jobDetail: {} };
    },
    created() {
        axios({
                method:'get',
                url: 'http://localhost:81/ThinkPHP6/public/index.php/GetJobDe',
                headers:{
                "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
                },
                params:{
                    id: this.$route.params,
                }
            }).then(response => {
                console.log(response.data);
                this.jobDetail = response.data;
            }).catch(error => {
                console.error(error);
            });
    
    },
    methods: {
    apply() {
      const token = localStorage.getItem('token');
      axios({
        method:'post',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/Apply',
        headers:{
          "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
          'Authorization': `${token}`
        },
        data:{
          jobid:this.$route.params.id,
        }
      }).then((response) =>  {
        if(response.data.code === 10){
          alert(response.data.message);
        }else{
          alert(response.data.message);
        }
      }).catch(error => {
        console.error(error);
      });
    },
  }
  };
  </script>

<style lang="scss" scoped>
.job-detail {
  width: 800px;
  
  margin: auto;
  margin-top: 100px;
  line-height: 2em;
  &-title{
    font-size: 38px;
  }
  &-subTitle {
    font-size: 16px;
    color: #1f2329;
    margin: 20px 0;
  }
  &-description {
    h2{
      font-size: 26px;
    }
    .textContent {
      white-space: pre-line;
    }
  }
  &-summary{
    h2{
      font-size: 26px;
    }
    .textContent {
      white-space: pre-line;
    }
  }
  &-block {
    h2 {
      margin-bottom: 20px;
    }
    margin: 40px 0;
    .textContent {
      font-size: 18px;
      font-family: 'Times New Roman', Times, serif;
      color: black;
    }
  }
  &-button {
    width: 200px;
    
  

  }
}

.mybtn{
  color: #fff;
  font-size: 18px;
  text-align: center;
  position: relative;
  left: 0;
  border-radius: 20px;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  top: 0;
  width: 200px;
  height: 56px;
  background: #198191;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

</style>