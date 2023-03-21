<template>
    <h1>List category </h1>
    <div class="but">
        <button class="addbut" style="--clr:#39FF14"><span>
            <router-link class="link" to="/addCategory">
                Add category
            </router-link>
        </span><i></i></button>
    </div>    
    <div>
        <table class="container">
            <thead>
                <tr>
                    <th scope="col" class="category-order">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in categories">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ item.name }}</td>
                    <td>{{ item.description }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
 </template>
 
<script>
import axios from 'axios';
import { RouterLink, RouterView } from 'vue-router';


 export default {
    data() {
      return {
        categories: {}
      }
    },
    methods: {
        load() {
            axios.get("/api/auth/listCategory").then(({ data }) => {
               this.categories = data.data
               console.log(this.categories)
            })
        }
    },
    mounted() {
        this.load();
    },
    created() {
        this.load();
    },
    components: { RouterLink, RouterView }
}
 </script>
 <style>
@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
  line-height: 1.42em;
  color:#fbf9fd;
  
  background-color:#f8f9fa;
}

h1 {
  font-size:3em; 
  font-weight: 300;
  line-height:1em;
  text-align: center;
  color: #4DC3FA;
}

h2 {
  font-size:1em; 
  font-weight: 300;
  text-align: center;
  display: block;
  line-height:1em;
  padding-bottom: 2em;
  color: #FB667A;
}

h2 a {
  font-weight: 700;
  text-transform: uppercase;
  color: #FB667A;
  text-decoration: none;
}

.blue { color: #185875; }
.yellow { color: #FFF842; }

.container th h1 {
    font-weight: bold;
    font-size: 1em;
  text-align: left;
  color: #185875;
}

.but {
    text-align: right;
    padding-right: 10%;
}

.container td {
    font-weight: normal;
    font-size: 1em;
  -webkit-box-shadow: 0 2px 2px -2px #0E1119;
     -moz-box-shadow: 0 2px 2px -2px #0E1119;
          box-shadow: 0 2px 2px -2px #0E1119;
}

.container {
    text-align: left;
    overflow: hidden;
    width: 80%;
    margin: 0 auto;
  display: table;
  padding: 0 0 8em 0;
}

.container td, .container th {
    padding-bottom: 2%;
    padding-top: 2%;
  padding-left:2%;  
}

/* Background-color of the odd rows */
.container tr:nth-child(odd) {
    background-color: #323C50;
}

/* Background-color of the even rows */
.container tr:nth-child(even) {
    background-color: #2C3446;
}

.container th {
    background-color: #1F2739;
    color: #9ab0c5;
}

.container td {
    color: #9ab0c5;
}

.container td:first-child { color: #FB667A; }

.container tr:hover {
   background-color: #464A52;
-webkit-box-shadow: 0 6px 6px -6px #0E1119;
     -moz-box-shadow: 0 6px 6px -6px #0E1119;
          box-shadow: 0 6px 6px -6px #0E1119;
}

.container td:hover {
  background-color: #42ff97;
  color: #403E10;
  font-weight: bold;
  
  box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
  transform: translate3d(6px, -6px, 0);
  
  transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
  transition-timing-function: line;
}

@media (max-width: 800px) {
.container td:nth-child(4),
.container th:nth-child(4) { display: none; }
}

.addbut {
  position: relative;
  background: #444;
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  border: none;
  letter-spacing: 0.1rem;
  font-size: 1rem;
  padding: 1rem 3rem;
  transition: 0.2s;
  width: 250px;
}

.addbut:hover {
  letter-spacing: 0.2rem;
  padding: 1.1rem 3.1rem;
  background: var(--clr);
  color: var(--clr);
  /* box-shadow: 0 0 35px var(--clr); */
  animation: box 3s infinite;
}

.addbut::before {
  content: "";
  position: absolute;
  inset: 2px;
  background: #272822;
}

.addbut span {
  position: relative;
  z-index: 1;
}
.addbut i {
  position: absolute;
  inset: 0;
  display: block;
}

.addbut i::before {
  content: "";
  position: absolute;
  width: 10px;
  height: 2px;
  left: 80%;
  top: -2px;
  border: 2px solid var(--clr);
  background: #272822;
  transition: 0.2s;
}

.addbut:hover i::before {
  width: 15px;
  left: 20%;
  animation: move 3s infinite;
}

.addbut i::after {
  content: "";
  position: absolute;
  width: 10px;
  height: 2px;
  left: 20%;
  bottom: -2px;
  border: 2px solid var(--clr);
  background: #272822;
  transition: 0.2s;
}

.addbut:hover i::after {
  width: 15px;
  left: 80%;
  animation: move 3s infinite;
}
</style>
 

 