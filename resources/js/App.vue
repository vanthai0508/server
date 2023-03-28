<template>
  <div class="topnav">
    <RouterLink to="/login" class="nav-link">Login</RouterLink>
    <RouterLink to="/register" class="nav-link">Register</RouterLink>
    <RouterLink to="/logout" class="nav-link">Logout</RouterLink>
    <div class = "icon-home">
      <RouterLink to="/house">
        <img src="Image/25694.png">
      </RouterLink>
    </div>
    <!-- <a href="#contact">Liên hệ</a>
    <a href="#about">Về chúng tôi</a> -->
  </div>
 
  <!-- <div style="padding-left:16px">
    <h2>Ví dụ về Top Navigation</h2>
    <p>Nội dung..</p>
  </div> -->
    <!-- <img alt="Vue logo" src="https://www.vectorlogo.zone/logos/vuejs/vuejs-ar21.png"> -->
    <!-- <MainHeader /> -->
    <!-- <Login/> -->
    <!-- <nav>
      <RouterLink to="/login">Login</RouterLink>
    </nav> -->
    <router-view />
</template>
  
<script>
  import MainHeader from './components/MainHeader.vue'
  import Login from './components/Login.vue'
  
  export default {
    name: 'App',
    // components: {
    //   // MainHeader,
    //   // Login
    // }
  }
  </script>
  
  <style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  img {
    width: 550px;
    border-radius: 2px;
    box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.5);
    transition: width 1s;
  }
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    
}
 
.topnav {
    overflow: hidden;
    background-color: #2abe63;
   
}
 
.nav-link {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}
 
.nav-link:hover {
    background-color: #ddd;
    color: black;
}
 
.icon-home img {
  padding: 5px;
  width: 50px;
  height: 50px;
}
.icon-home {
 text-align: right;
 padding-right: 40px;
}
.nav-link:active {
    background-color: #4CAF50;
    color: white;
}
  </style>
  