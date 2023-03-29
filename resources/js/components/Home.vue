<template>
  <div id="app">
  <!-- Columns: <input v-model.number="numberOfColumns"> -->
  <h1>List category</h1>
  <div class = "search">
    <input v-model="textSearch" @change="search(textSearch)" class="inputSearch" placeholder="Search...">

  </div>
  <ul :style="gridStyle" class="card-list">
    <li @click="clickCategory()" v-for="item in categories" :key="item.id" class="card-item">
      <!-- <form  class="selectItem">
      <select >
        <option>Detail</option>
        <option>Register</option>
      </select>
    </form> -->
    <p class="xem" @click="showForm = !showForm">Xem</p>
      <img :src="item.path" alt="">
        <p>{{ item.name }}</p>
    </li>
  </ul>
</div>
<dix>
  <form v-if="showForm" class="small-form" @submit.prevent="submitForm">
    <div class="butExit">

      <button class="form-exit" @click="showForm = !showForm">X</button>
    </div>
    <h1>Name</h1>
    <div class="content-form-small">
      <label>Teacher:csdfdsfksdfsd</label><br>
      <label class="labelSmall">Number video:</label><br>
      <label>Rate:</label><br>
      <label>Number registered:</label><br>
      <label>Price:</label><br>
      <label>Status:</label><br>
      <label>Description:</label><br>
    </div>
    
  </form>
</dix>

<!-- <div>
    <button class="butItem" @click="showForm = !showForm">Show Form</button>
    <form v-if="showForm" class="small-form" @submit.prevent="submitForm">
      <select >
        <option>Detail</option>
        <option>Register</option>
      </select>
    </form>
</div> -->
</template>
<script>
  import axios from 'axios'



  export default {
    data() {
      return {
        showForm: false,
        name: '',
        email: '',
        categories: {},
        textSearch: '',
        numberOfColumns: 5,
      }
    },
    computed: {
      gridStyle() {
        return {
          gridTemplateColumns: `repeat(${this.numberOfColumns}, minmax(50px, 1fr))`
        } 
      },
    },
    methods: {
      load() {
        axios.get('/api/auth/category/listCategory').then(response => {
          this.categories = response.data.data
          console.log('thai', response.status)
        })
      },
      search(text)
      {
        axios.get('/api/auth/category/search?textSearch=' + text).then(response => {
          this.categories = response.data.data
        })
      },
      addCard() {
        this.cards.push('new-card')
      },
      clickCategory(){
        // console.log("thai");
      }
    },
    created(){
      this.load()
    }
  }
</script>

<style>
.search {
  text-align: right;
  padding-right: 100px;
  box-sizing: border-box;
  
}
.inputSearch:hover{
  background-color: rgb(117, 243, 138);
}
.inputSearch {
  margin-bottom: 1rem;
  border: 2px solid #976464;
  border-radius: 5px;
  font-size: 1rem;
}
.card-list {
  display: grid;
  grid-gap: 1em;
}
.butItem {
  width: 30px;
  height: 30px;
}
.card-item {
  /* background-color: rgb(122, 151, 180); */
  padding: 1em;
}
.card-item img {
  text-align: center;
  width: 300px;
  height: 300px;
  border-radius: 8%;
}

.selectItem {
  text-align: right;
}
body {
  background: #20262E;
  padding: 20px;
  font-family: Helvetica;
}
.xem {
  text-align: right;
  margin-bottom: 0px;
  color: blue;
}
.small-form {
    left: 40%;
    top: 70%;
    position: absolute;
    margin-top: -25%;
    width: 300px;
    height: 300px;
    background-color: rgb(239, 245, 243);
    display: flex;
    flex-direction: column;
    align-items: center;
    /* padding: 20px; */
    /* background-color: #f2f2f2; */
    border-radius: 10px;
}

ul {
  list-style-type: none;
}

.form-exit {
  position: absolute;
  text-align: right;
  top: 10px;
  right: 10px;
  font-size: 16px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  color: #999;
  transition: color 0.3s ease;
}

.form-exit:hover {
  color: #333;
}
.content-form-small {
  text-align: left;
  margin-left: 0px;
  margin: 0px;
  padding-left: 0%;
}
</style>