<template>
  <div class="wrapper1">
    <LayoutNav></LayoutNav>

    <div class="content">
        <h1 class="table-header">Applications</h1>
        <ul class="content-list">
            <!-- Table Header -->
            <li class="content-item">
                <div class="table-cell">Status</div>
                <div class="table-cell">Candidates</div>
                <div class="table-cell">Email</div>
                <div class="table-cell">Phone</div>
                <div class="table-cell">Actions</div>
      
            </li>

            <!-- List Items -->
            <li class="content-item" v-for="result in searchResults" :key="result.id">
                <div class="table-cell">
                  <div class="table-cell">{{ result.status['status'] }}</div>
                </div>
                <div class="table-cell">{{ result.resume['name'] }}</div>
                <div class="table-cell">{{ result.resume['email'] }}</div>
                <div class="table-cell">{{ result.resume['phone'] }}</div>
                <div class="table-cell">
                    <!-- Add actions buttons or links here -->
                    <button @click="test(result)">Action</button>
                    <button @click="openChatModal(result)">Chat</button>
                    <button @click="updateStatus(result, 'Failed')">Failed</button>
                    <button @click="updateStatus(result, 'Approved')">Approved</button>

                    <!-- 模态框 -->
                    <div v-if="showChatModal" class="modal">
                      <div class="modal-content">
                        <button @click="closeChatModal" class="close-button">X</button>
                        <ChatBox :sender_id = "sender_id" :receiver_id = "receiver_id"/>
                      </div>
                    </div>

                </div>
            </li>
        </ul>
    </div>
    <LayoutFooter></LayoutFooter>
  </div>

</template>

<script>
import axios from 'axios'
import ChatBox from '@/views/ChatBox/ChatBox.vue'; 
import LayoutNav from '@/views/Layout/components/LayoutNav.vue';
import LayoutFooter from '@/views/Layout/components/LayoutFooter.vue';


export default {
  name: "job",
  data() {
    return {
      searchResults: [],
      searchQuery2: '',
      showChatModal:false,
    };
  },
  created(){
    axios({
      method:'get',
      url: 'http://localhost:81/ThinkPHP6/public/index.php/EmperApply',
      headers:{
        "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest',
      },
      params:{
        jobid:this.$route.params.id,
      },
    }).then(response => {
      this.searchResults = response.data;
    }).catch(error => {
      console.error(error);
    });
  },

  methods: {
    openChatModal(result) {
      this.showChatModal = true;
      this.sender_id = result.status['jobid'];
      this.receiver_id = result.status['userid'];
    },
    closeChatModal() {
    //     axios({
    //   method:'post',
    //   url: 'http://localhost:81/ThinkPHP6/public/index.php/ChangeIfLook',
    //   headers:{
    //     "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
    //     'X-Requested-With': 'XMLHttpRequest',
    //   },
    //   data:{
    //     sender_id: this.sender_id,
    //     receiver_id: this.receiver_id,
    //     time: Date.now(),
    //   },
    // }).then(response => {
    //   console.log(this.sender_id);
    // }).catch(error => {
    //   console.error(error);
    // });
      this.showChatModal = false;
    },
    updateStatus(result, newStatus) {
      axios({
        method: 'post', // 使用POST请求更新用户的status
        url: 'http://localhost:81/ThinkPHP6/public/index.php/ChangeStatus', // 请替换为实际的API端点
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        data: {
          jobid: result.status['jobid'],
          userid: result.status['userid'],
          status: newStatus,
        },
      })
        .then((response) => {
          if (response.data.code === 10) {
            // 更新本地状态以反映更改
             result.status['status'] = newStatus;
          } else {
            alert('Failed to update status'); // 处理错误情况
          }
        })
        .catch((error) => {
          console.error(error);
        });

    },
    test(result) {
      const generatedPDFURL = result.pdfURL;
      window.open(generatedPDFURL, '_blank');
    },
  },


  
  components: { LayoutNav,LayoutFooter,ChatBox }

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