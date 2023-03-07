<template>
    <img alt="Vue logo" src="https://www.vectorlogo.zone/logos/vuejs/vuejs-ar21.png">
    <MainHeader />
    <router-view />
  </template>
  
<script>
  import MainHeader from './components/MainHeader.vue'
  
  export default {
    name: 'App',
    components: {
      MainHeader
    }
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
  </style>
  