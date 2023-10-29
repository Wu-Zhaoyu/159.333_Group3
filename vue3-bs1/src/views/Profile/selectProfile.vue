<template>
    <div class="selectProfile">
        <h3 class="title">Profile</h3>

        <div class="form_content">
            <input type="radio" v-model="action" value="Upload A Profile" @change="handleRadioChange2">
            <label for="Upload A Profile">Upload A Profile</label>
        </div>
        <!-- 条件渲染：上传按钮 -->
        <div v-if="action === 'Upload A Profile'" class="upload">
            <input type="file" ref="fileInput" @change="handleFileUpload" required>
            <p>Accepted file types: .pdf (2MB limit). Profile will be stored in your JobSeeker Profile.</p>
            </div>

        <div class="form_content">
            <input type="radio" v-model="action" value="Select A Profile" @change="handleRadioChange2">
            <label for="Select A Profile">Select A Profile</label>
        </div>

        <!-- 条件渲染：下拉框 -->
        <div v-if="action === 'Select A Profile'" class="select">
          <el-select v-model="selectedProfile" placeholder="Select Profile">
            <el-option v-for="profile in searchResults" :key="profile.pdfname" :value="profile.id" :label="profile.pdfname"></el-option>
          </el-select>
        </div>

        <div class="btn">
            <button class="mybtn" @click="apply" size="large">Apply</button>
        </div>
    </div>
</template>
  
  <script>
  import axios from 'axios'
  
  
  export default {
    data(){
        return{
            action:"",
            selectedProfile: '',
        }
    },
    created(){
      this.fetchResumes();
    },

    methods:{
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
      handleRadioChange2() {
          // 在这里你可以处理选中单选框的逻辑，确保它们互斥
          // 我们使用一个简单的条件语句来确保只有一个选项被选中
          if (
              this.action !== 'Upload A Profile' &&
              this.action !== 'Select A Profile'
          ) {
              this.action = ''; // 如果选中的选项不是有效选项，则将其重置为空
          }
      },
      handleFileUpload(event) {
      // 处理文件上传逻辑
      const file = event.target.files[0];
      // 在这里可以发送文件到服务器或进行其他操作
      //console.log('Uploaded file:', file);
      },
      uploadResume(){
        const fileInput = this.$refs.fileInput;
        const token = sessionStorage.getItem('token') || 'NO_TOKEN';
        const fData = new FormData();
        if (fileInput.files[0]) {
          fData.append('File', fileInput.files[0]);
        }else{
          return null;
        }
        return axios.post('http://localhost:81/ThinkPHP6/public/index.php/UploadResume', fData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': `${token}`
        }
        }).then((response) => {
            console.log(response.data);
            return response.data;
        }).catch(error => {
            console.error(error);
            throw error; // 如果发生错误，将错误抛出以便上层代码处理
        });
      },
      async apply() {
          const token = sessionStorage.getItem('token') || 'NO_TOKEN';
          let profileid = null;
           if(this.action === 'Upload A Profile'){
            try {
              const response = await this.uploadResume();
              profileid = response;
              if (profileid === null) {
                  alert("Please upload the file");
                  return;
              }
            } catch (error) {
                console.error(error);
                return; // 处理错误
            }
           }else{
              profileid = this.selectedProfile;
           }
           console.log(profileid);
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
              profileid:profileid,
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
 
  
  }
  </script>
  
  <style>
 .selectProfile {

    width: 50%;
    margin-left: 25%;
    margin-right: 25%;
    margin-top: 70px;
    text-align: center;
    display: flex;
    flex-direction: column;
    height: 520px;
 }
 .selectProfile h3{
    text-align: center;
    width: 100%;
    height: 80px;
    margin-top: 40px;
    margin-bottom: 10px;
    font-size: 38px;
    color: #198191;
 }
 .form_content, .upload, .select{
    /* margin-left: 270px; */
    margin-bottom: 30px;
 }
 .form_content label {
    font-size: 20px;
 }
 .mybtn{
  color: #fff;
  font-size: 18px;
  text-align: center;
  position: relative;
  border-radius: 20px;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  width: 200px;
  height: 56px;
  background: #198191;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  margin-left: 290px;
}
.footer {
  margin-top: auto; 
  background-color: #333; /* 设置页脚的背景颜色，可以根据需要修改 */
  color: #fff; /* 设置页脚文字颜色，可以根据需要修改 */
  text-align: center; /* 设置页脚文本居中，可以根据需要修改 */
}
  </style>