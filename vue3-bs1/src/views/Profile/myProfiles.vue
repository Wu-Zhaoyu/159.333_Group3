<template>
    <div class="wrapper1">
      <div class="content">
          <h1 class="table-header">My Profiles</h1>
          <ul class="content-list">
            <li class="content-item">
                <div class="table-cell">Date</div>
                <div class="table-cell">File Name</div>
                <div class="table-cell">Actions</div>
            </li>
              <!-- List Items -->
              <li class="content-item" v-for="result in searchResults" :key="result.id">
                <div class="table-cell">
                    <div>{{ result.create_time }}</div>
                  </div>
                  <div class="table-cell">
                    <div>{{ result.pdfname }}</div>
                  </div>
                
                  <div class="table-cell">
                      <!-- Add actions buttons or links here -->
                      <button @click="deleteResume(result)">Delete</button>
                      <button @click="downloadResume(result)">Download</button>
                  </div>
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
        searchResults: [],
        searchQuery2: '',
      };
    },
    created(){    
    this.fetchResumes();
    },
  
    methods: {

      fetchResumes() {
      // 根据需要从服务器获取简历列表，将结果存储在searchResults中
        const token = sessionStorage.getItem('token') || 'NO_TOKEN';
        axios({
          method: 'get',
          url: 'http://localhost:81/ThinkPHP6/public/index.php/ShowProfile',
          headers: {
            "Content-Type": 'application/x-www-form-urlencoded;charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest',
          },
          params: {
            token:token,
          },
        })
        .then(response => {
          this.searchResults = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },

    deleteResume(result) {
      // 在此处执行删除简历的操作，可以向服务器发送请求删除指定简历
      // 你需要实现服务器端的删除逻辑
      axios({
        method: 'get',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/DelProfile',
        headers: {
          "Content-Type": 'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
        },
        params: {
          id:result.id,
        },
      })
        .then(response => {
          alert(response.data.message);
          this.fetchResumes();
        })
        .catch(error => {
          console.error(error);
        });
    },

    downloadResume(result) {
      window.open(result.pdfLink, '_blank');
    },

    },
  
  }
  </script>
  
  <style>
  /* Style the table header */
  .table-header {
    text-align: center;
    width: 100%;
    height: 80px;
    padding-top: 10px;
    margin-top: 50px;
    font-size: 34px;
    color: #198191;
    margin-bottom: 30px;
  }
  
  /* Style the table cells */
  .table-cell {
      display: inline-block;
      width: 33%;
      /* Equal width for each cell */
      text-align: center;
      font-weight: bold;
  }
  .content-item{
    font-size: 20px;
  }
  
  /* Add any additional styling you need */
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    position: relative;
  }
  
  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    background: none;
    border: none;
    font-size: 18px;
    color: red;
  }
  .wrapper1 {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  .content {
    flex: 1; /* 填充剩余空间，使 footer 吸底 */
    /* ... (原始 .content 样式保持不变) ... */
  }
  </style>