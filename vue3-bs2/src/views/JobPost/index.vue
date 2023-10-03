<template>
    <LayoutNav></LayoutNav>

    <div class="resume-page">

        <!-- 主要内容区域 -->
        <main>
            <!-- 右侧在线填写信息区域 -->
            <section class="form-section">
                <h2 class="form_title">Classify your role</h2>
                <form @submit.prevent="generateResume">
                    <h2 class="title3">-------------------------Role information------------------------
                    </h2>
                    <div class="form_content">
                        <label for="email">Job title: </label>
                        <input type="email" id="email" v-model="jobTitle" required>
                    </div>
                    <div class="form_content">
                        <label for="tel">Location: </label>
                        <input type="tel" id="tel" v-model="loc" required>
                    </div>


                    <h2 class="title3">----------------------Category----------------------</h2>
                    <h2 class="title3">Suggested category based on your job title</h2>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption" value="option1" @change="toggleDropdown">
                        <label for="option1">CEO & General Management > CEO</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption" value="option2" @change="toggleDropdown">
                        <label for="option2">Choose a different category</label>
                    </div>
                    <div v-if="showDropdown" class="form_content">
                        <select>
                            <option>Select a category</option>
                            <option>下拉选项1</option>
                            <option>下拉选项2</option>
                            <option>下拉选项3</option>
                        </select>
                    </div>

                    <h2 class="title3">Work type</h2>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption1" value="option1" @change="handleRadioChange">
                        <label for="option1">Full-time</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption1" value="option2" @change="handleRadioChange">
                        <label for="option2">Part-time</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption1" value="option3" @change="handleRadioChange">
                        <label for="option3">Contract</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption1" value="option4" @change="handleRadioChange">
                        <label for="option4">Casual</label>
                    </div>


                    <h2 class="title3">Pay details</h2>
                    <h3 class="title3">Pay type</h3>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption2" value="option5" @change="handleRadioChange2">
                        <label for="option5">Hourly rate</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption2" value="option6" @change="handleRadioChange2">
                        <label for="option6">Monthly salary</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption2" value="option7" @change="handleRadioChange2">
                        <label for="option7">Annual salary</label>
                    </div>

                    <div class="form_content">
                        <input type="radio" v-model="selectedOption2" value="option8" @change="handleRadioChange2">
                        <label for="option8">Annual plus commission</label>
                    </div>

                    <h2 class="title3">Pay range</h2>
                    <h2 class="title3">Enter a range to offer candidates. If pay is an exact amount, enter the same in both
                        fields.</h2>
                    <div class="form_content">
                        <label for="email">Currency: </label>
                        <select>
                            <option>Select currency</option>
                            <option>AUD</option>
                            <option>HKD</option>
                            <option>IDR</option>
                            <option>MYR</option>
                            <option>NZD</option>
                            <option>PHP</option>
                            <option>SGD</option>
                            <option>THB</option>
                            <option>USD</option>
                        </select>
                    </div>

                    <div class="form_content">
                        <label for="email">From: </label>
                        <input type="email" id="email" v-model="from" placeholder="Enter minimum pay" required>
                    </div>
                    <div class="form_content">
                        <label for="tel">To: </label>
                        <input type="tel" id="tel" v-model="to" placeholder="Enter maximum pay" required>
                    </div>

                    <div class="form_content">
                        <label for="tel">Pay shown on your ad (optional)</label>
                        <input type="tel" id="tel" v-model="maxPay" placeholder="Enter maximum pay">
                    </div>

                    <h2 class="title3">-----------------------Write about your job-----------------------</h2>
                    <div class="form_content">
                        <label for="company">Job description</label>
                    </div>
                    <div class="form_content">
                        <label for="company">Enter your job details or let us guide you through what to write.</label>
                    </div>


                    <div class="form_content">
                        <label for="description">Description: </label>
                        <textarea cols="30" rows="5">... ...</textarea>
                    </div>

                    <h2 class="title3">------------------------Candidate search results------------------------</h2>
                    <div class="form_content">
                        <label for="company">Job summary</label>
                    </div>
                    <div class="form_content">
                        <label for="company">Write a compelling statement about your role to entice more candidates.</label>
                    </div>
                    <div class="form_content">
                        <textarea cols="70" rows="10">... ...</textarea>
                    </div>

                    <!-- 其他字段 -->

                    <div class="form_btn">
                        <button class="btn_submit" type="submit">Post my ad</button>
                    </div>

                    <h2 class="title3">------------------------FAQs------------------------</h2>
                    <div class="form_content">
                        <label for="company">Got a question? Have a look through our frequently asked questions
                            below</label>
                    </div>
                    <h2 class="title3">----------------------------------------------------</h2>

                    <div v-for="(faq, index) in faqs" :key="index" class="faq">
                        <h3 class="title3" @click="toggleAnswer(index)">
                            {{ faq.question }}
                            <span class="arrow" :class="{ active: faq.showAnswer }"></span>
                        </h3>
                        <p v-if="faq.showAnswer">{{ faq.answer }}</p>
                    </div>


                    <div class="form_content4">
                        <label for="company">Can’t find what you’re looking for? Reach out on 0508 733 569, Monday to
                            Friday, 9am - 9pm NZDT.</label>
                        <label for="company">Or visit our Help Centre.</label>
                    </div>
                </form>


            </section>
        </main>
    </div>
</template>
  
<script>
import LayoutNav from '@/views/Layout/components/LayoutNav.vue';

export default {
    data() {
        return {
            jobTitle: "",
            loc: "",
            from: "",
            to: "",
            maxPay: "", 
            formData: {
                name: "",
                email: "",
                // 其他字段
            },
            uploadedResume: null,
            generatedResume: null,
            selectedOption: '', // 用来存储选中的单选框的值
            showDropdown: false, // 用来控制下拉框的显示和隐藏
            selectedOption1: '', // 用来存储选中的单选框的值
            selectedOption2: '', // 用来存储选中的单选框的值

            faqs: [
                {
                    question: "When will my ad go on site?",
                    answer: "All new accounts are required to undergo a compulsory compliance check, due to this it can take up to 3 business hours for your first ad to go live on site. Keep an eye on your inbox as our team will be in touch via email if they need more details from you.",
                    showAnswer: false,
                },
                {
                    question: "What if I made a mistake in my ad?",
                    answer: "Don’t worry, you can edit your ad once we’ve approved it. To edit your ad, you’ll need to sign in to the Advertiser Centre, select Jobs, then select the job you’d like to edit, and then hit the ‘edit’ button.",
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
        },

        toggleDropdown() {
            if (this.selectedOption === 'option2') {
                this.showDropdown = true;
            } else {
                this.showDropdown = false;
            }
        },

        handleRadioChange() {
            // 在这里你可以处理选中单选框的逻辑，确保它们互斥
            // 我们使用一个简单的条件语句来确保只有一个选项被选中
            if (
                this.selectedOption1 !== 'option1' &&
                this.selectedOption1 !== 'option2' &&
                this.selectedOption1 !== 'option3' &&
                this.selectedOption1 !== 'option4'
            ) {
                this.selectedOption1 = ''; // 如果选中的选项不是有效选项，则将其重置为空
            }
        },

        handleRadioChange2() {
            // 在这里你可以处理选中单选框的逻辑，确保它们互斥
            // 我们使用一个简单的条件语句来确保只有一个选项被选中
            if (
                this.selectedOption2 !== 'option5' &&
                this.selectedOption2 !== 'option6' &&
                this.selectedOption2 !== 'option7' &&
                this.selectedOption2 !== 'option8'
            ) {
                this.selectedOption2 = ''; // 如果选中的选项不是有效选项，则将其重置为空
            }
        },

        toggleAnswer(index) {
            // Toggle the display of the answer for the clicked question
            this.faqs[index].showAnswer = !this.faqs[index].showAnswer;
        },

    },


    components: {
        LayoutNav
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
    margin-left: 400px;
    width: 700px;
}


main {
    justify-content: space-between;
    width: 100%;
    max-width: 800px;
    margin-top: 20px;
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
    background-color: #fff;
    height: 2650px;
    border-radius: 30px;
    color: black;
    font-size: 18px;
    font-family: 'Times New Roman', Times, serif;
    width: 650px;
}

.form_title {
    font-size: 30px;
    font-family: 'Times New Roman', Times, serif;
}

.generated-resume {
    margin-top: 20px;
    background-color: #f0f0f0;
    padding: 20px;
}

.form_content {
    /* padding-left: 204px; */
    margin-bottom: 5px;
    text-align: center;
}
.form_content4{
    margin-bottom: 5px;
    text-align: center;
    margin-top: 80px;
}

.title3 {
    padding-top: 40px;
    /* padding-left: 240px; */
    font-size: 24px;
    font-family: 'Times New Roman', Times, serif;
    color: #198191;
    text-align: center;
}</style>
  