<template>
<div class="container">
  <div class="video-wrapper">
        <video
          ref="video"
          class="video"
          preload="auto"
          muted
          loop
          playsinline
          autoplay
          poster="//sf3-ttcdn-tos.pstatp.com/obj/ttfe/ATSX/mainland/video-poster_1576231362701.png"
          src="//sf1-ttcdn-tos.pstatp.com/obj/ttfe/ATSX/mainland/gongquhunjian_1080.min.mp4"
          tabindex="-1"
        ></video>
  </div>


    <!-- Find Your Next Employer -->
    <div class="block-item-one">
      <div class="title1">
        <h1>Find Your Next Employer</h1>
        <p>Work in a relaxed environment, choose a company culture that suits you, regardless of title and hierarchy, and focus on accomplishing business goals.</p>
      </div>
      <div class="image1">
        <img src="src\assets\images\home_1.png" alt />
      </div>
    </div>

    <!-- Free Resume Template -->
    <div class="block-item-two">
      <div class="image2">
        <img src="src\assets\images\home_2.png" alt />
      </div>
      <div class="title2">
        <h1>Free Resume Template</h1>
        <p>We will help you create a beautiful and complete resume free of charge to help you find the job you like and are right for you.</p>
      </div>
    </div>

    <div class="image3">
        <img src="src\assets\images\home_seek.png" alt />
    </div>

</div>
</template>

<script setup>

</script>

<style>
.container {
  .video-wrapper {
    font-size: 0; 
    /* position: absolute; */
    top: 0;
    right: 0; 
    bottom: 0; 
    left: 0;
    z-index: -1;
    overflow: hidden;
    .video {
      object-fit: cover;
      width: 100%;
      height: 100%;
    } 
  }
}
.block-item-one{
  height: 500px;
  margin-bottom: 30px;
}
.title1{
  margin-top: 7%;
  padding-left: 2%;
  background-color: #f2f2f2;
  width: 35%;
  float: left;
}
.title1 h1{
  font-size: 48px;
  font-family: 'Times New Roman', Times, serif;
}
.title1 p{
  font-size: 30px;
  font-family: 'Times New Roman', Times, serif;
}
.image1{
  padding-right: 2%;
  margin-top: 5%;
  margin-left: 2%;
  width: 63%;
  float: left;
}

.block-item-two{
  height: 500px;
  margin-bottom: 30px;
}
.title2{
  margin-top: 5%;
  padding-right: 2%;
  background-color: #f2f2f2;
  width: 35%;
  float: left;
  margin-right: 2%;
}
.title2 h1{
  font-size: 48px;
  font-family: 'Times New Roman', Times, serif;
}
.title2 p{
  font-size: 30px;
  font-family: 'Times New Roman', Times, serif;
}
.image2{
  padding-right: 2%;
  margin-top: 2%;
  width: 63%;
  float: left;
}
</style>