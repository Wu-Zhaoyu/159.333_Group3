<template>
    <LayoutNav></LayoutNav>
    <div class="wrapper1">
    <div class="content">
        <h1 class="table-header">My Recent Applications</h1>
        <ul class="content-list">
            <!-- Table Header -->
            <li class="content-item">
                <div class="table-cell">Status</div>
                <div class="table-cell">Job Name</div>
                <div class="table-cell">Company Name</div>
                <div class="table-cell">Application Time</div>
                <div class="table-cell">Actions</div>
            </li>

            <!-- List Items -->
            <li class="content-item" v-for="result in searchResults" :key="result.id">
                <div class="table-cell">{{ result.status['status'] }}</div>
                <div class="table-cell">{{ result.job['jobName'] }}</div>
                <div class="table-cell">{{ result.company['company_name'] }}</div>
                <div class="table-cell">{{ result.status['create_time'] }}</div>

                <div class="table-cell">
                    <!-- Add actions buttons or links here -->
                    <button @click="openChatModal(result)">Chat</button>
                    <div v-if="showChatModal" class="modal">
                      <div class="modal-content">
                        <button @click="closeChatModal()" class="close-button">X</button>
                        <ChatBox :sender_id = "sender_id" :receiver_id = "receiver_id"/>
                      </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
  </div>
    <LayoutFooter></LayoutFooter>

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
      showChatModal: false,
    };
  },
  created(){
    const token = localStorage.getItem('token') || 'NO_TOKEN';
    axios({
      method:'get',
      url: 'http://localhost:81/ThinkPHP6/public/index.php/EmpeeApply',
      headers:{
        "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest',
      },
      params:{
        token:token,
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
      this.sender_id = result.status['userid'];
      this.receiver_id = result.status['jobid'];
    },
    closeChatModal() {
    //   axios({
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
    width: 20%;
    /* Equal width for each cell */
    text-align: center;
    font-weight: bold;
}
.content-item{
  font-size: 20px;
}
/* .modal-content {
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
} */
/* Add any additional styling you need */
</style>