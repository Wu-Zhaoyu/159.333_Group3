<template>
  <div class="resume-page">
    <!-- 顶部导航栏 -->
    <!-- <header>
      <h1>Edit Profile</h1>
    </header> -->

    <!-- 主要内容区域 -->
    <main>
      
      <!-- 左侧上传PDF简历区域 -->
      <section class="upload-section">
        <h2>Upload PDF Resume</h2>
        <input type="file" ref="fileInput" @change="uploadResume" accept=".pdf">
        <p v-if="uploadedResume">已上传PDF简历：{{ uploadedResume }}</p>
      </section>

      <!-- 右侧在线填写信息区域 -->
      <section class="form-section">
        <h2 class="form_title">Fill In Information Online</h2>
        <form @submit.prevent="generateResume">
          <h2 class="title3">-------------------------Basic Information------------------------
          </h2>
          <div class="form_content">
            <label for="name">Name: </label>
            <input id="name" v-model="formData.name" required>
          </div>
          <div class="form_content">
            <label for="email">E-mail: </label>
            <input id="email" v-model="formData.email" required>
          </div>
          <div class="form_content">
            <label for="tel">Phone: </label>
            <input id="tel" v-model="formData.tel" required>
          </div>


          <h2 class="title3">----------------------Education Experience----------------------</h2>
          <div class="form_content">
            <label for="institution">Graduate Institution: </label>
            <input id="institution" v-model="formData.institution" required>
          </div>
          <div class="form_content">
            <label for="academic">Academic Career: </label>
            <input id="academic" v-model="formData.academic" required>
          </div>
          <div class="form_content">
            <label for="major">Major: </label>
            <input id="major" v-model="formData.major" required>
          </div>
          <div class="form_content">
            <label for="date">Start Times: </label>
            <input type="date" id="date" v-model="formData.dateEduSta" required>
          </div>
          <div class="form_content">
            <label for="date">End Times: </label>
            <input type="date" id="date" v-model="formData.dateEduEnd" required>
          </div>
          

          <h2 class="title3">-----------------------Occupational History-----------------------</h2>
          <div class="form_content">
            <label for="company">Company: </label>
            <input id="company" v-model="formData.company" required>
          </div>
          <div class="form_content">
            <label for="position">Position: </label>
            <input id="position" v-model="formData.position" required>
          </div>
          <div class="form_content">
            <label for="date">Start Times: </label>
            <input type="date" id="date" v-model="formData.dateWorSta" required> 
          </div>
          <div class="form_content">
            <label for="date">End Times: </label>
            <input type="date" id="date" v-model="formData.dateWorEnd" required>
          </div>
          <div class="form_content">
            <label for="description">Description: </label>
            <textarea v-model="formData.description" cols="30" rows="5">... ...</textarea>
          </div>

          <h2 class="title3">------------------------Personal Statement------------------------</h2>
          <div class="form_content">
            <label for="description">Perference: </label>
            <select v-model="searchQuery2" placeholder="Select" @change="changeSize">
              <option value="Sales">Sales</option>
              <option value="Science & Technology">Science & Technology</option>
              <option value="Accounting">Accounting</option>
            </select>
          </div>

          <div class="form_content">
            <textarea v-model="formData.experience" cols="70" rows="10">... ...</textarea>
          </div>

          <!-- 其他字段 -->

          <div class="form_btn">
            <button class="btn_submit" @click="generateResume">Submit</button>
          </div>

          <!-- <div class="form_btn1">
            <button class="btn_submit" @click="Genresume"><a ref="downloadLink" style="display: none;">Genresume</a></button>
          </div> -->
        </form>

        <!-- 显示生成的简历内容 -->
        <div v-if="generatedResume" class="generated-resume">
          <h3>生成的简历</h3>
          <pre>{{ generatedResume }}</pre>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      formData: {
        name: "",
        email: "",
        tel:"",
        institution:"",
        academic:"",
        major:"",
        dateEduSta:"",
        dateEduEnd:"",
        company:"",
        position:"",
        dateWorSta:"",
        dateWorEnd:"",
        description:"",
        experience:"",
      },
      uploadedResume: null,
      generatedResume: null,
    };
  },
  created(){
    const token = localStorage.getItem('token') || 'NO_TOKEN';
    axios({
      method:'get',
      url: 'http://localhost:81/ThinkPHP6/public/index.php/ResCon',
      headers:{
        "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest',
      },
      params:{
        token:token,
      },
    }).then(response => {
      this.formData.name = response.data['name'];
      this.formData.email = response.data['email'];
      this.formData.tel = response.data['phone'];
      this.formData.institution = response.data['school'];
      this.formData.academic = response.data['academic'];
      this.formData.major = response.data['major'];
      this.formData.dateEduSta = response.data['dateEduSta'];
      this.formData.dateEduEnd = response.data['dateEduEnd'];
      this.formData.company = response.data['company'];
      this.formData.position = response.data['position'];
      this.formData.dateWorSta = response.data['dateWorSta'];
      this.formData.dateWorEnd = response.data['dateWorEnd'];
      this.formData.description = response.data['evaluation'];
      this.formData.experience = response.data['experience'];
    }).catch(error => {
      console.error(error);
    });
  },
  methods: {
    uploadResume() {
      // 处理上传PDF文件的逻辑
      const file = this.$refs.fileInput.files[0];
      if (file) {
        this.uploadedResume = file.name;
        // 发送文件到服务器进行处理或显示上传成功信息
      }
    },
    generateResume() {
      const token = localStorage.getItem('token');
      
      const fData = new FormData();
      fData.append('name', this.formData.name);
      fData.append('email', this.formData.email);
      fData.append('phone', this.formData.tel);
      fData.append('school', this.formData.institution);
      fData.append('academic', this.formData.academic);
      fData.append('major', this.formData.major);
      fData.append('dateEduSta', this.formData.dateEduSta);
      fData.append('dateEduEnd', this.formData.dateEduEnd);
      fData.append('company', this.formData.company);
      fData.append('position', this.formData.position);
      fData.append('dateWorSta', this.formData.dateWorSta);
      fData.append('dateWorEnd', this.formData.dateWorEnd);
      fData.append('evaluation', this.formData.description);
      fData.append('experience', this.formData.experience);
      // ...添加其他字段

      // 添加文件字段
      const fileInput = this.$refs.fileInput;
      if (fileInput.files[0]) {
        fData.append('resFile', fileInput.files[0]);
      }else{
        fData.append('resFile', 'null');
      }

      axios.post('http://localhost:81/ThinkPHP6/public/index.php/Resume', fData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'X-Requested-With': 'XMLHttpRequest',
          'Authorization': `${token}`
        }
      }).then(function (response) {
        alert(response.data.message);
        const generatedPDFURL = response.data.pdfURL; // 获取生成的 PDF 文件的 URL
        window.open(generatedPDFURL, '_blank');
      }).catch(error => {
        console.error(error);
      });
    },
  },
};
</script>

<style scoped>
/* 添加样式来定义页面布局 */
.resume-page {
  display: flex;
  /* flex-direction: column; */
  align-items: center;
  padding: 20px;
  margin-left: 400px;
  width:700px;
}


main {
  justify-content: space-between;
  width: 100%;
  max-width: 800px;
  margin-top: 20px;
}

.upload-section{
  flex: 1;
  padding: 20px;
}
.upload-section{
  height: 200px;
  padding-left: 180px;
  padding-top: 20px;
}

.upload-section {
  background-color: #198191;
  border-radius: 30px;
  color: #fff;
  font-size: 24px;
  font-family:'Times New Roman', Times, serif;
  margin-bottom: 50px;
  width: 650px;
}

.form-section form{
  background-color: #fff;
  height: 1200px;
  border-radius: 30px;
  color: black;
  font-size: 18px;
  font-family:'Times New Roman', Times, serif;
  width: 650px;
}
.form_title{
  font-size: 30px;
  font-family:'Times New Roman', Times, serif;
}

.generated-resume {
  margin-top: 20px;
  background-color: #f0f0f0;
  padding: 20px;
}

.form_content{
  /* padding-left: 204px; */
  margin-bottom: 5px;
  text-align: center;
}
.title3{
  padding-top: 40px;
  /* padding-left: 240px; */
  font-size: 24px;
  font-family: 'Times New Roman', Times, serif;
  color: #198191;
  text-align: center;
}
.form_btn1{
  padding-left: 30px;
}
</style>
