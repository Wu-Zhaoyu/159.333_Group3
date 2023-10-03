<!-- <template>
  
</template>
  
<script lang="ts" setup>
  import { reactive, ref } from 'vue'
  import type { FormInstance, FormRules } from 'element-plus'
  
  
</script>

<style>

</style> -->
  




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
            <input type="text" id="name" v-model="formData.name" required>
          </div>
          <div class="form_content">
            <label for="email">E-mail: </label>
            <input type="email" id="email" v-model="formData.email" required>
          </div>
          <div class="form_content">
            <label for="tel">Phone: </label>
            <input type="tel" id="tel" v-model="formData.tel" required>
          </div>


          <h2 class="title3">----------------------Education Experience----------------------</h2>
          <div class="form_content">
            <label for="institution">Graduate Institution: </label>
            <input type="text" id="institution" v-model="formData.institution" required>
          </div>
          <div class="form_content">
            <label for="academic">Academic Career: </label>
            <input type="text" id="academic" v-model="formData.academic" required>
          </div>
          <div class="form_content">
            <label for="major">Major: </label>
            <input type="text" id="major" v-model="formData.major" required>
          </div>
          <div class="form_content">
            <label for="date">Start and End Times: </label>
            <input type="date" id="date" v-model="formData.dateEdu" required>
          </div>
          

          <h2 class="title3">-----------------------Occupational History-----------------------</h2>
          <div class="form_content">
            <label for="company">Company: </label>
            <input type="text" id="company" v-model="formData.company" required>
          </div>
          <div class="form_content">
            <label for="position">Position: </label>
            <input type="text" id="position" v-model="formData.position" required>
          </div>
          <div class="form_content">
            <label for="date">Start and End Times: </label>
            <input type="date" id="date" v-model="formData.dateWor" required>
          </div>
          <div class="form_content">
            <label for="description">Description: </label>
            <textarea v-model="formData.description" cols="30" rows="5">... ...</textarea>
          </div>

          <h2 class="title3">------------------------Personal Statement------------------------</h2>
          <div class="form_content">
            <textarea v-model="formData.experience" cols="70" rows="10">... ...</textarea>
          </div>

          <!-- 其他字段 -->

          <div class="form_btn">
            <button class="btn_submit" type="submit">Submit</button>
          </div>
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
        name: "11",
        email: "11@11",
        tel:"11",
        institution:"11",
        academic:"11",
        major:"11",
        dateEdu:"",
        company:"11",
        position:"11",
        dateWor:"",
        description:"11",
        experience:"11",
      },
      uploadedResume: null,
      generatedResume: null,
    };
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
      // 发送用户填写的信息到服务器生成简历
      // 使用 this.formData 中的数据
      // 获取上传的PDF简历的内容
      // 生成简历并更新 this.generatedResume
      const token = localStorage.getItem('token');
      
      const fData = new FormData();
      // 添加普通表单字段
      fData.append('name', this.formData.name);
      fData.append('email', this.formData.email);
      fData.append('phone', this.formData.tel);
      fData.append('school', this.formData.institution);
      fData.append('academic', this.formData.academic);
      fData.append('major', this.formData.major);
      fData.append('dataEdu', this.formData.dateEdu);
      fData.append('company', this.formData.company);
      fData.append('position', this.formData.position);
      fData.append('dataWor', this.formData.dateWor);
      fData.append('evaluation', this.formData.description);
      fData.append('experience', this.formData.experience);
      // ...添加其他字段

      // 添加文件字段
      const fileInput = this.$refs.fileInput;
      if (fileInput.files[0]) {
        fData.append('resFile', fileInput.files[0]);
      }

      axios({
        method:'post',
        url: 'http://localhost:81/ThinkPHP6/public/index.php/Resume',
        headers:{
          "Content-Type":'multipart/form-data',
          'X-Requested-With': 'XMLHttpRequest',
          'Authorization': `${token}`
        },
        data:{
          name:this.formData.name,
          email:this.formData.email,
          phone:this.formData.tel,
          school:this.formData.institution,
          academic:this.formData.academic,
          major:this.formData.major,
          dataEdu:this.formData.dateEdu,
          company:this.formData.company,
          position:this.formData.position,
          dataWor:this.formData.dateWor,
          evaluation:this.formData.description,
          experience:this.formData.experience,
          resFile:this.$refs.fileInput.files[0],
        },
      }).then(function (response) {
        alert(response.data.message);
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
</style>
