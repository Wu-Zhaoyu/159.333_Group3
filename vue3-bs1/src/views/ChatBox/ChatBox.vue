<template>
    <div class="chat-box">
      <!-- 聊天框的内容 -->
      <div class="messages">
        <!-- 消息列表 -->
        <div v-for="(message, index) in messages" :key="index" :class="{ 'sender-message': message.sender_id === sender_id, 'receiver-message': message.sender_id !== sender_id }" class="message">
          {{ message.message_content}}
        </div>
      </div>
      <!-- 输入框和发送按钮 -->
      <div class="input-box">
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type your message...">
        <button @click="sendMessage">Send</button>
      </div>
      
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    props: {
      sender_id: {
        type: Number,
        required: true
      },
      receiver_id: {
        type: Number,
        required: true
      }
    },
    data() {
      return {
        sender_id: this.sender_id,
        receiver_id: this.receiver_id,
        messages: [], // 存储聊天消息的数组
        newMessage: '' // 输入框中的新消息
      };
    },
    created(){
      this.refreshData();
    },
    mounted() {
    // Set interval to refresh every second (1000 milliseconds)
    setInterval(() => {
      // Call your refresh method or perform any action here
      this.refreshData();
    }, 1000);
  },
    methods: {
      refreshData() {
        axios({
        method:'get',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/ShowMessage',
        headers:{
          "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
          'X-Requested-With': 'XMLHttpRequest',
        },
        params:{
          sender_id: this.sender_id,
          receiver_id: this.receiver_id,
        },
        }).then(response => {
          this.messages = response.data;
        }).catch(error => {
          console.error(error);
        });
      },
      sendMessage() {
        // // 发送消息的逻辑，可以将新消息添加到messages数组中
        if (this.newMessage.trim() === '') return;
        // this.messages.push({ text: this.newMessage, sender: 'user' });
        // this.newMessage = ''; // 清空输入框
        axios({
          method:'post',
          url: 'http://localhost:81/ThinkPHP6/public/index.php/AddMessage',
          headers:{
              "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
              'X-Requested-With': 'XMLHttpRequest',
          },
          data:{
            sender_id: this.sender_id,
            receiver_id: this.receiver_id,
            message_content: this.newMessage,
          },
          }).then(response => {
            this.newMessage = '';
          }).catch(error => {
          console.error(error);
        });
      }
    }
  };
  </script>
  
  <style scoped>
  /* 样式可以根据需要自行定义 */
  .chat-box {
    width: 300px;
    height: 400px;
    border: 1px solid #ccc;
    overflow-y: scroll;
    padding: 10px;
  }
  
  .messages {
    margin-bottom: 10px;
  }
  
  .message {
    margin-bottom: 5px;
  }
  
  .input-box {
    display: flex;
    position: absolute; /* 使输入框吸底 */
    bottom: 20px; /* 吸底 */
    margin-left: 15px;
  }
  
  input {
    flex: 1;
    margin-right: 10px;
  }

.sender-message {
  width: 70%;
  height: auto;
  font-size: 15px;
  text-align: left;
  padding: 7px;
  background-color: #e1ffc7; /* 设置发送者消息的背景颜色 */
  margin-left: 30%;
  border-radius: 5px;
  word-wrap: break-word;
  margin-bottom: 5px;
}

.receiver-message {
  width: 70%;
  height: auto;
  padding: 7px;
  font-size: 15px;
  text-align: left;
  margin-right: 30%;
  border-radius: 5px;
  background-color: #d3d3d3; /* 设置接收者消息的背景颜色 */
  word-wrap: break-word;
  margin-bottom: 5px;
}
  </style>
  