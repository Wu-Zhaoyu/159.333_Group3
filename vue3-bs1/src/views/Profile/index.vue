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
        <input type="file" ref="fileInput" @change="showName" accept=".pdf">
        <!-- <p v-if="uploadedResume">已上传PDF简历:{{ uploadedResume }}</p> -->
        <button class="mybtn3" @click="uploadResume" size="large">Upload Resume</button>
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
            <textarea class="ps" v-model="formData.experience" cols="70" rows="10">... ...</textarea>
          </div>

          <!-- 其他字段 -->


          <div class="form_btn">
            <button class="myBtn1" @click="generateResume">Submit</button>
          <!-- </div>
          <div class="form_btn"> -->
            <button class="myBtn2" @click="viewProfile">View My Profiles</button>
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
    const token = sessionStorage.getItem('token') || 'NO_TOKEN';
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
    showName() {
      // 处理上传PDF文件的逻辑
      const file = this.$refs.fileInput.files[0];
      if (file) {
        this.uploadedResume = file.name;
        // 发送文件到服务器进行处理或显示上传成功信息
      }
    },
    uploadResume(){
        const fileInput = this.$refs.fileInput;
        const token = sessionStorage.getItem('token') || 'NO_TOKEN';
        const fData = new FormData();
        if (fileInput.files[0]) {
          fData.append('File', fileInput.files[0]);
        }
        axios.post('http://localhost:81/ThinkPHP6/public/index.php/UploadResume', fData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': `${token}`
        }
        }).then((response) => {
            //console.log(response.data);
            alart("Successfully upload.");
        }).catch(error => {
            console.error(error);
        });
      },
    generateResume() {
      const token = sessionStorage.getItem('token') || 'NO_TOKEN';

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
        //console.log(response.data);
        alert(response.data.message);
        // const generatedPDFURL = response.data.pdfURL;
        // window.open(generatedPDFURL, '_blank');
      }).catch(error => {
        console.error(error);
      });
    },

   
  viewProfile() {
    this.$router.push('/myProfiles');
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

.form_content{
  /* padding-left: 204px; */
  margin-bottom: 5px;
  text-align: left;
  margin-left: 50px;
  display: flex; /* 使用 Flex 布局 */
  justify-content: flex-end; /* 将内容右对齐 */
  margin-bottom: 5px;
}

label {
  margin-right: auto; /* 推动label到左侧，将input框右对齐 */
  font-size: 22px;
  margin-left: 5px;
}

textarea{
  margin-right: 80px;
  width: 300px;
}

select{
  margin-right: 80px;
  width: 300px;
}

.myBtn1{
  color: #fff;
  font-size: 15px;
  text-align: center;


  border-radius: 20px;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  top: 0;
  width: 100px;
  height: 56px;
  background: #198191;
  /* display: flex; */
  /* justify-content: center; */
  align-items: center;
  cursor: pointer;
  margin-left: 100px;
  margin-top: 20px;
  margin-bottom: 20px;

}
.myBtn2{
  color: #fff;
  font-size: 15px;
  text-align: center;
  border-radius: 20px;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  top: 0;
  width: 150px;
  height: 56px;
  background: #198191;
  /* display: flex; */
  /* justify-content: center; */
  align-items: center;
  cursor: pointer;
  margin-left: 180px;
  margin-top: 20px;
  margin-bottom: 20px;
}

.mybtn3{
  background: #fff;
  color: #198191;
  border: none; /* 去掉边框 */
  margin-left: 190px;
}



input {
  font-size: 16px; /* 字体大小 */
  color: #333; /* 字体颜色 */
  border: 2px solid #ccc; /* 边框样式，可以根据需要修改颜色和宽度 */
  padding: 5px 10px; /* 内边距，控制文本与边框的间距 */
  border-radius: 5px; /* 圆角边框 */
  margin-right: 80px;
  width: 300px;
  
}

input:focus {
  border-color: #007BFF; /* 当输入框聚焦时的边框颜色 */
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* 添加阴影效果 */
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
  height: 220px;
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
  height: auto;
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

.ps{
  width: 500px;
}
</style>
