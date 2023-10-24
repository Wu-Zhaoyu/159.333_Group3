<template>
  <div class="jobs">
    <div class="banner"></div>
    <!-- 搜索 -->

    <div class="input-search1">
      <input v-model="searchQuery1" ref="input" type="text" placeholder="Enter Keywords" />
    </div>
    <div class="input-search2">
      <input v-model="searchQuery2" ref="input" type="text" placeholder="Any Classification" />
    </div>
    <div class="input-search3">
      <input v-model="searchQuery3" ref="input" type="text" placeholder="Enter suburb,city or region" />
      <!-- <span class="input-search-button"><el-icon class="icons"><Search/></el-icon></span> -->
    </div>
    <div class="input-search4">
      <el-button class="btn" @click="search">Search</el-button>
    </div>


    <!-- 主体内容 -->
    <!-- <div class="content" v-loading:#ffffff7d.scrollFixed="loading">
        <h2 class="content-title">开启新的职位 ({{ results.total }})</h2>
        <ul class="content-list">
          <li class="content-item" v-for="item in results.data" :key="item.nid">
            <router-link :to="`/jobs/${item.nid}`" target="_blank">
              <h3 class="title">{{ item.title }}</h3>

              <div class="subTitle">
                <span class="city">{{ item.city_name }}</span>&nbsp;|
                <span class="job_category">{{ item.category_name }}</span>&nbsp;|
                <span class="recruitment_channel">{{ item.recruit_type }}</span>
              </div>
              <p class="desc">{{ item.description }}</p>
            </router-link>
          </li>
        </ul>
      </div> -->

    <!-- <div class="content" v-loading:#ffffff7d.scrollFixed="loading">
        <h2 class="content-title">开启新的职位 ({{ results.total }})</h2>
        <ul class="content-list">
          <li class="content-item" v-for="item in results.data" :key="item.nid">
            <router-link :to="`/jobs/${item.nid}`" target="_blank">
              <h3 class="title">高级B端产品经理</h3>
              <div class="subTitle">
                <span class="city">北京</span>&nbsp;|
                <span class="job_category">产品</span>&nbsp;|
                <span class="recruitment_channel">社招</span>
              </div>
              <p class="desc">{{ item.description }}</p>
            </router-link>
          </li>
        </ul>
      </div> -->

    <div class="content">
      <ul>
        <li v-for="result in searchResults" :key="result.id">{{ result.jobName }}</li>
      </ul>
    </div>

  </div>
</template>
<script>
import axios from 'axios'
import { computed, getCurrentInstance, onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";
import { getOffsetTop } from "../../helper/utilities.js";
import CheckboxTransfer from "../../components/Checkbox-Transfer.vue";


export default {
  name: "job",
  data() {
    return {
      searchQuery1: "",
      searchQuery2: "",
      searchQuery3: "",
      searchResults: [],
      dataList: [
        // 在这里定义你的数据列表
        { id: 1, name: "x1",location:"l1",keyword:"k1" },
        { id: 2, name: "x2",location:"l2",keyword:"k2" },
        { id: 3, name: "x3",location:"l3",keyword:"k3" },
        { id: 4, name: "x4",location:"l4",keyword:"k4" },
      ]
    };
  },

  methods: {
    search() {
      // // 在这里执行全局搜索逻辑，可以从后端API获取数据或者从本地数据筛选结果
      // // 将结果存储在searchResults中
      // // 示例：假设你有一个名为dataList的数据列表，你可以使用filter来筛选结果
      // const searchQuery1 = this.searchQuery1.toLowerCase();
      // const searchQuery2 = this.searchQuery2.toLowerCase();
      // const searchQuery3 = this.searchQuery3.toLowerCase();

      // this.searchResults = this.dataList.filter(item =>
      //   item.name.toLowerCase().includes(searchQuery1) &&
      //   item.location.toLowerCase().includes(searchQuery2) &&
      //   item.keyword.toLowerCase().includes(searchQuery3) 
      // );
      axios({
        method:'get',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/Search',
        headers:{
          "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
        },
        params:{
          address:this.searchQuery3,
          category:this.searchQuery2,
          jobName:this.searchQuery1
        }
      }).then((response) =>  {
        if(response.data.code === 101){
          alert(response.data.message);
        }else{
          this.searchResults = response.data.joblist;
        }
      }).catch(error => {
        console.error(error);
      });
    }
  }






}

</script>
<style lang="scss" scoped>
.content {
  height: 1000px;
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
  overflow: hidden;
  border: 1px solid #3370ff;
  font-size: 16px;

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

  .prefix-icon {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 10px;
    display: flex;
    align-items: center;
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
  margin-left: 200px;
}

.input-search4 {
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
</style>
