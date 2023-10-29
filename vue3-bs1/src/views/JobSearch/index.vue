<template>
  <div class="jobs">
    <div class="banner"></div>
    <!-- 搜索 -->

    <div class="input-search1">
      <input v-model="searchQuery1" ref="input" type="text" placeholder="Enter Keywords" />
    </div>
    <div class="input-search2">
    <select v-model="searchQuery2" placeholder="Select" @change="changeSize">
      <option value="Sales">Sales</option>
      <option value="Science & Technology">Science & Technology</option>
      <option value="Accounting">Accounting</option>
    </select>
  </div>
    <div class="input-search3">
    <select v-model="searchQuery3" placeholder="Select" @change="changeSize">
      <option value="Auckland">Auckland</option>
      <option value="Hamilton">Hamilton</option>
      <option value="Wellington">Wellington</option>
    </select>
  </div>
    <div class="input-search4">
      <el-button class="btn" @click="search">Search</el-button>
    </div>

  
   

    <div class="content">
      <ul class="content-list">
        <li class="content-item" v-for="result in searchResults" :key="result.id">
            <router-link :to="`/JobSearch/${result.id}`">
              <!-- <h3 class="title">{{ item.title }}</h3> -->
              <h3 class="title">{{ result.jobName }}</h3>
              <div class="subTitle">
                <span class="location">{{ result.address }}</span>&nbsp;|
                <span class="category">{{ result.category }}</span>&nbsp;|
                <span class="jobtype">{{ result.jobtype }}</span>
              </div>
              <p class="desc">{{  result.description }}</p>
            </router-link>
          </li>
      </ul>
    </div>

  </div>
</template>
<script>
import axios from 'axios'


export default {
  name: "job",
  data() {
    return {
      searchQuery1: "",
      searchQuery2: "",
      searchQuery3: "",
      searchResults: [],
 
    };
  },
  created(){
    const token = sessionStorage.getItem('token') || 'NO_TOKEN';
    axios({
      method:'get',
      url: 'http://localhost:81/ThinkPHP6/public/index.php/RecomJob',
      headers:{
        "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest',
      },
      params:{
        token:token,
      },
    }).then(response => {
      console.log(response.data);
      this.searchResults = response.data;
    }).catch(error => {
      console.error(error);
    });
  },

  methods: {
    search() {
      const token = sessionStorage.getItem('token') || 'NO_TOKEN';
      axios({
        method:'get',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/Search',
        headers:{
          "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
        },
        params:{
          token:token,
          address:this.searchQuery3,
          category:this.searchQuery2,
          jobName:this.searchQuery1
        }
      }).then((response) =>  {
        if(response.data.code === 101){
          this.searchResults = response.data.joblist;
          alert(response.data.message);
        }else{
          this.searchResults = response.data.joblist;
        }
      }).catch(error => {
        console.error(error);
      });
    },
  }






}

</script>
<style lang="scss" scoped>


.form_content {
    width: 100%;
    height: 100%;
    background: #198191;
    text-align: center;

}
.banner {
  height: 400px;
  line-height: 400px;
  color: #fff;
  width: 100%;
  min-width: 1300px;
  background-image: url("//sf1-ttcdn-tos.pstatp.com/obj/ttfe/ATSX/mainland/joblistbanner2x.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  font-size: 32px;
}


.content-item{
  margin-left: 30px;
  margin-right: 30px;
  margin-top: 30px;
}
.content-item h3{
  padding-right: 30px;
}


.main {
  width: 1300px;
  margin: 0 auto;
  margin-top: 100px;
  padding: 0 100px 0 200px;

  .aside-filter {
    float: left;
    width: 300px;
    padding-right: 20px;

    .header {
      font-size: 14px;
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      border-bottom: 1px solid #ebeef5;
      ;
      padding-bottom: 10px;
      width: 100%;

      .clear {
        &.clearable {
          color: #3370ff;
          cursor: pointer;
        }
      }
    }

    .job-filter-block {
      margin-bottom: 40px;
    }
  }
}

.pager {
  margin-bottom: 10px;
  float: right;
}

.input-search1,
.input-search2,
.input-search3,
.input-search4 {
  transform: translateY(-400%);
  z-index: 100;

  float: left;
  margin-left: 20px;
  margin-right: auto;
  height: 56px;
  width: 280px;
  min-width: 280px;
  max-width: 1300px;
  position: relative;
  // border-radius: 30px;
  //overflow: hidden;
  border: 1px solid #3370ff;
  font-size: 16px;

  select {
    font-size: inherit;
    height: 100%;
    width: 100%;
    line-height: 100%;
    color: #1f2329;
    border-color: transparent;
    padding: 15px 0 19px 20px;
  }

  ::-webkit-input-placeholder {
    color: #909399;
  }

  &.small {
    height: 40px;
    font-size: 14px;
  }


  &.large {
    height: 60px;
    font-size: 20px;
  }

 

  input {
    font-size: inherit;
    height: 100%;
    width: 100%;
    line-height: 100%;
    color: #1f2329;
    border-color: transparent;
    padding: 19px 0 19px 25px;
  }


}

.input-search1 {
  margin-left: 250px;
}

.input-search4 {
  width: 100px;
  min-width: 100px;
  background: #198191;
  border: none;
  // margin-right: 250px;
  margin-right: 200px;

}

.input-search2,.input-search3 {
    display: inline-block;
    // margin-right: 70px;

    // width: 1500px; /* 设置下拉框的初始宽度 */
  }

.i {
  width: 100px;
  min-width: 100px;
  background: #198191;
}

.el-icon {
  fill: white;
  position: absolute;
  top: 14px;
  left: 15px;
}

.btn {
  color: #fff;
  text-align: center;
  position: absolute;
  left: 0;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  top: 0;
  width: 100px;
  height: 56px;
  background: #198191;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;

  &:hover {

    // background: rgba(255, 255, 255, 0.5);
    &::before {
      transition: all 0.3s;
      content: "";
      position: absolute;
      width: 100%;
      top: -1px;
      bottom: -1px;
      background: rgba(255, 255, 255, 0.4);
    }
  }
}


.content {
min-height: 500px;
padding-left: 20px;
border-left: 1px solid #ebeef5;
margin-left: 80px;
margin-right: 80px;
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
