<template>

    <div class="resume-page">

        <!-- 主要内容区域 -->
        <main>
            <!-- 右侧在线填写信息区域 -->
            <section class="form-section">
                <h2 class="form_title">Classify your role</h2>
                <form @submit.prevent="generateResume">
                    <h2 class="title3">-------------------------------------Company information------------------------------------
                    </h2>
                    <div class="form_content">
                        <label for="Cname">Company Name: </label>
                        <input id="Cname" v-model="Cname" required>
                    </div>
                    <div class="form_content">
                        <label for="hr">HR: </label>
                        <input id="hr" v-model="hr" required>
                    </div>
                    <div class="form_content">
                        <label for="Cemail">Email: </label>
                        <input type="email"  id="Cemail" v-model="Cemail" required>
                    </div>
                    <div class="form_content">
                        <label for="Cphone">Phone: </label>
                        <input type="tel"  id="Cphone" v-model="Cphone" required>
                    </div>
                    <div class="form_content">
                        <label for="Clocation">Location: </label>
                        <input id="Clocation" v-model="Clocation" required>
                    </div>
                    <div class="form_btn">
                        <button class="postBtn" @click="addCompany">Submit</button>
                    </div>
                 

                    <h2 class="title3">----------------------------------------Role information---------------------------------------
                    </h2>
                    <div class="form_content">
                        <label for="jobtitle">Job title: </label>
                        <input id="jobtitle" v-model="jobTitle" required>
                    </div>
                
                    <div class="form_content">
                        <label for="location">Location: </label>
                        <select v-model="loc" placeholder="Select" @change="changeSize">
                            <option value="Auckland">Auckland</option>
                            <option value="Hamilton">Hamilton</option>
                            <option value="Wellington">Wellington</option>
                        </select>
                        <!-- <select v-model="selectedCategory" id="category">
                            <option value="">Please select</option>
                            <option value="Sales">Sales</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Science & Technology">Science & Technology</option>
                        </select> -->
                    </div>

                    <h2 class="title3">---------------------------------------------Category---------------------------------------------</h2>
                    

                    <div class="form_content">
                        <label>Choose a different category</label>
                    
                        <select v-model="selectedCategory" id="category">
                            <option value="">Please select</option>
                            <option value="Sales">Sales</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Science & Technology">Science & Technology</option>
                        </select>
                    </div>

                    <h2 class="title3">--------------------------------------------Work type--------------------------------------------</h2>

                    <div class="form_content10">
                        <input type="radio" v-model="worktype" value="Full-time" @change="handleRadioChange">
                        <label for="Full-time">Full-time</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="worktype" value="Part-time" @change="handleRadioChange">
                        <label for="Part-time">Part-time</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="worktype" value="Contract" @change="handleRadioChange">
                        <label for="Contract">Contract</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="worktype" value="Casual" @change="handleRadioChange">
                        <label for="Casual">Casual</label>
                    </div>


                    <h2 class="title3">-------------------------------------------Pay details-------------------------------------------</h2>
                    <h3 class="title4">Pay type</h3>

                    <div class="form_content10">
                        <input type="radio" v-model="paytype" value="Hourly rate" @change="handleRadioChange2">
                        <label for="Hourly rate">Hourly rate</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="paytype" value="Monthly salary" @change="handleRadioChange2">
                        <label for="Monthly salary">Monthly salary</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="paytype" value="Annual salary" @change="handleRadioChange2">
                        <label for="Annual salary">Annual salary</label>
                    </div>

                    <div class="form_content10">
                        <input type="radio" v-model="paytype" value="Annual plus commission" @change="handleRadioChange2">
                        <label for="Annual plus commission">Annual plus commission</label>
                    </div>

                    <h2 class="title4">Pay range</h2>

                    <div class="form_content">
                        <label for="from">From: </label>
                        <input id="from" v-model="from" placeholder="Enter minimum pay" required>
                    </div>
                    <div class="form_content">
                        <label for="to">To: </label>
                        <input id="to" v-model="to" placeholder="Enter maximum pay" required>
                    </div>


                    <h2 class="title3">------------------------------------Write about your job------------------------------------</h2>
                    <div class="form_content">
                        <label>Enter your job details.</label>
                    </div>
                    <div class="form_content">
                        <label>Description: </label>
                    </div>
                    <div class="form_content">
                        <textarea cols="30" rows="5" v-model="description">... ...</textarea>
                    </div>

                    <h2 class="title3">---------------------------------Candidate search results---------------------------------</h2>
                    <div class="form_content">
                        <label>Job summary</label>
                    </div>
                    <div class="form_content">
                        <label>Write a compelling statement about your role to entice more candidates.</label>
                    </div>
                    <div class="form_content">
                        <textarea cols="70" rows="10">... ...</textarea>
                    </div>

                    <!-- 其他字段 -->

                    <div class="form_btn">
                        <button class="postBtn" @click="doPost">Post my ad</button>
                    </div>

                    <h2 class="title3">--------------------------------------------FAQs--------------------------------------------</h2>
                    <div class="form_content9">
                        <label>Got a question? Have a look through our frequently asked questions
                            below</label>
                    </div>
                    <h2 class="title3">-----------------------------------------------------------------------------------------------</h2>

                    <div v-for="(faq, index) in faqs" :key="index" class="faq">
                        <h3 class="title8" @click="toggleAnswer(index)">
                            {{ faq.question }}
                            <span class="arrow" :class="{ active: faq.showAnswer }"></span>
                        </h3>
                        <p class="answer" v-if="faq.showAnswer">{{ faq.answer }}</p>
                    </div>


                    <div class="form_content8">
                        <label>Can't find what you're looking for? Reach out on 0508 733 569, Monday to
                            Friday, 9am - 9pm NZDT. Or visit our Help Centre.</label>
                    </div>
                </form>


            </section>
        </main>
    </div>
</template>
  
<script>
import axios from 'axios'

export default {
    data() {
        return {
            Cname:"",
            Clocation:"",
            hr:"",
            Cphone:"",
            Cemail:"",
            selectedCategory:"",
            jobTitle: "",
            loc: "",
            from: "",
            to: "",
            worktype: '', // 用来存储选中的单选框的值
            paytype: '', // 用来存储选中的单选框的值
            description:"",

            faqs: [
                {
                    question: "When will my ad go on site?",
                    answer: "All new accounts are required to undergo a compulsory compliance check, due to this it can take up to 3 business hours for your first ad to go live on site. Keep an eye on your inbox as our team will be in touch via email if they need more details from you.",
                    showAnswer: false,
                },
                {
                    question: "What if I made a mistake in my ad?",
                    answer: "Don't worry, you can edit your ad once we've approved it. To edit your ad, you'll need to sign in to the Advertiser Centre, select Jobs, then select the job you’d like to edit, and then hit the ‘edit’ button.",
                    showAnswer: false,
                },
                {
                    question: "How long will my ad be live for?",
                    answer: "All ads are published on site for 30 consecutive days unless you choose to expire it earlier, however any remaining days cannot be credited or used on future ads.",
                    showAnswer: false,
                },
                {
                    question: "where will my application be sent to?",
                    answer: "Your applications will be sent to your email address, however you can view and manage all applications via the Jobs section in the Advertiser Centre.",
                    showAnswer: false,
                },
                {
                    question: "How long will I have access to the applications I've received?",
                    answer: "Applications are stored within your account on the Advertiser Centre for you to access at any time. To see them, sign in. hit Jobs then Expired then the job title to which you received applicants.",
                    showAnswer: false,
                },
            ],


        };
    },
    created(){
        const token = sessionStorage.getItem('token') || 'NO_TOKEN';

        axios({
            method:'get',
            url: 'http://localhost:81/ThinkPHP6/public/index.php/ShowCompany',
            headers:{
                "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
            },
            params:{
                token:token,
            }
        }).then((response) =>  {
            this.Cname = response.data['company_name'];
            this.Clocation = response.data['address'];
            this.hr = response.data['contact_person'];
            this.Cphone = response.data['phone'];
            this.Cemail = response.data['email'];
        }).catch(error => {
            console.error(error);
        });
    },
    methods: {
        handleRadioChange() {
            // 在这里你可以处理选中单选框的逻辑，确保它们互斥
            // 我们使用一个简单的条件语句来确保只有一个选项被选中
            if (
                this.worktype !== 'Full-time' &&
                this.worktype !== 'Part-time' &&
                this.worktype !== 'Contract' &&
                this.worktype !== 'Casual'
            ) {
                this.worktype = ''; // 如果选中的选项不是有效选项，则将其重置为空
            }
        },

        handleRadioChange2() {
            // 在这里你可以处理选中单选框的逻辑，确保它们互斥
            // 我们使用一个简单的条件语句来确保只有一个选项被选中
            if (
                this.paytype !== 'Hourly rate' &&
                this.paytype !== 'Monthly salary' &&
                this.paytype !== 'Annual salary' &&
                this.paytype !== 'Annual plus commission'
            ) {
                this.paytype = ''; // 如果选中的选项不是有效选项，则将其重置为空
            }
        },

        toggleAnswer(index) {
            // Toggle the display of the answer for the clicked question
            this.faqs[index].showAnswer = !this.faqs[index].showAnswer;
        },

        addCompany(){
            const token = sessionStorage.getItem('token') || 'NO_TOKEN';

            axios({
                method:'post',
                url: 'http://localhost:81/ThinkPHP6/public/index.php/AddCompany',
                headers:{
                "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `${token}`
                },
                data:{
                    company_name:this.Cname,
                    address:this.Clocation,
                    contact_person:this.hr,
                    phone:this.Cphone,
                    email:this.Cemail,
                }
            }).then(function (response) {
               alert(response.data.message);
            }).catch(error => {
                console.error(error);
            });
        },

        doPost(){
            const token = sessionStorage.getItem('token') || 'NO_TOKEN';

            axios({
                method:'post',
                url: 'http://localhost:81/ThinkPHP6/public/index.php/JobAdd',
                headers:{
                "Content-Type":'application/x-www-form-urlencoded;charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `${token}`
                },
                data:{
                    jobName:this.jobTitle,
                    address:this.loc,
                    category:this.selectedCategory,
                    jobtype:this.worktype,
                    paytype:this.paytype,
                    maxmoney:this.from,
                    minmoney:this.to,
                    description:this.description,
                    summary:this.jobTitle,
                }
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
/* 常见问题解答样式 */
.faq {
    margin-bottom: 20px;
    cursor: pointer;
}

.faq h3 {
    font-size: 18px;
    font-weight: bold;
}

.faq p {
    margin-top: 5px;
}

/* 通过伪元素::after创建箭头 */
.arrow {
    position: relative;
    display: inline-block;
}

.arrow::after {
    content: "";
    display: inline-block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    /* 可以调整箭头的大小 */
    border-color: #000 transparent transparent transparent;
    /* 可以调整箭头的颜色 */
    margin-left: 5px;
    /* 可以调整箭头与文字之间的间距 */
    transition: transform 0.3s ease;
}

/* 当展开时旋转箭头 */
.arrow.active::after {
    transform: rotate(180deg);
}



/* 添加样式来定义页面布局 */
.resume-page {
    display: flex;
    /* flex-direction: column; */
    align-items: center;
    padding: 20px;
    margin-left: 200px;
    width: 1100px;
    max-width: 1100px;
}


main {
    justify-content: space-between;
    width: 1500px;
    margin-top: 20px;
    /* background-color: rebeccapurple; */
}

.upload-section {
    flex: 1;
    padding: 20px;
}

.upload-section {
    height: 200px;
    padding-left: 180px;
    padding-top: 20px;
}

.upload-section {
    background-color: #198191;
    border-radius: 30px;
    color: #fff;
    font-size: 24px;
    font-family: 'Times New Roman', Times, serif;
    margin-bottom: 50px;
    width: 650px;
}

.form-section form {
    padding-bottom: 50px;
    background-color: #fff;
    height: flex;
    border-radius: 30px;
    color: black;
    font-size: 22px;
    font-family: 'Times New Roman', Times, serif;
    width: 1100px;
}

.form_title {
    font-size: 38px;
    font-family: 'Times New Roman', Times, serif;
}

.generated-resume {
    margin-top: 20px;
    background-color: #f0f0f0;
    padding: 20px;
}

.form_content {
    /* padding-left: 204px; */
    margin-bottom: 0px;
    /* text-align: center; */
    padding-left: 240px;
    display: flex; /* 使用 Flex 布局 */
  justify-content: flex-end; /* 将内容右对齐 */
}
.form_content10 {
     margin-bottom: 0px;
    /* text-align: center; */
    
}
.form_content4{
    margin-bottom: 0px;
    text-align: center;
    margin-top: 50px;
}

.title3 {
    padding-top: 40px;
    /* padding-left: 240px; */
    font-size: 24px;
    font-family: 'Times New Roman', Times, serif;
    color: #198191;
    text-align: center;
}
.title4 {
    padding-left: 240px;
    font-size: 26px;
    color: rgb(139, 139, 139);
}

.title8 {
    margin-left: 240px;
}
.answer{
    margin-left: 10%;
    margin-right: 10%;
    font-size: 18px;
}
.form_content8{
    margin-left: 5%;
    margin-right: 5%;
}
.form_content9{
   margin-left: 160px; 
}
.form_btn {
    text-align: center;
}

label {
  margin-right: auto; /* 推动label到左侧，将input框右对齐 */
  font-size: 22px;
  margin-left: 50px;
}

textarea{
  margin-right: 280px;
  width: 500px;
}
input, select{
  font-size: 16px; /* 字体大小 */
  color: #333; /* 字体颜色 */
  border: 2px solid #ccc; /* 边框样式，可以根据需要修改颜色和宽度 */
  padding: 5px 10px; /* 内边距，控制文本与边框的间距 */
  border-radius: 5px; /* 圆角边框 */
  margin-right: 200px;
  width: 300px;
  
}


.form_content10 input{
    margin-left: 300px;
    margin-right: 0;
}

.form_content10 label{
    margin-right: 280px;
    margin-left: 0;
}

.postBtn{
  color: #fff;
  font-size: 18px;
  text-align: center;
  position: relative;
  left: 0;
  border-radius: 20px;
  border: none; /* 去掉边框 */
  padding: 0; /* 去掉内边距 */
  top: 0;
  width: 200px;
  height: 56px;
  background: #198191;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.form_btn {
    margin-top: 30px;
    margin-left: 460px;
}
</style>
  