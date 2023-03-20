// ImageuploadComponent.vue

<template>
    <div>
        <div class="upload">
            <form autocomplete="off" @submit.prevent="uploadFile" v-if="!success" method="post" >
                <div class="container">
                    <h1>Form upload file</h1>
                    <hr>
                    <label>
                        Title:
                        <input type="text" v-model="title">
                    </label>
                    <label>
                        Video file:
                        <input type="file" @change="selectFile">
                    </label><br><br>
                   

                    <div class="selectcategory">
                            Category selected :
                            <br><br>
                            <div>
                                <label class="labelname" v-for="item in categorySelected">{{ item.name }}</label>
                            </div>
                            <br />
                            <select v-model="categorySelected" multiple @change="">
                                <!-- <option value="test">{{ item.name }}</option> -->
                                <option v-for="item in categories" :value="item" :key="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                
                    </div>

                    <div class="clearfix">
                        <button type="submit" class="signupbtn">Submit</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</template>
<script>
import { ref } from 'vue'
import Multiselect from '@vueform/multiselect'
    import axios from 'axios'
    // import Multiselect from 'vue-multiselect'
    export default {
        data(){
            return {
                categories: {},
                title: '',
                selectedFile: null,
                categories: [],
                categorySelected: ''
            } 
        },
        methods: {
            load(){
                this.getListCategory()
            },
            // change(){
            //     console.log('test', this.language[0].name)
            // },
            selectFile(event) {
                this.selectedFile = event.target.files[0];
            },
            uploadFile(){
                if(this.categorySelected.length != 0){
                    
                    const listId = this.categorySelected.map(category => category.id)
                    
                    const formData = new FormData();
                    formData.append('title', this.title);
                    formData.append('video', this.selectedFile);
                    this.categorySelected.forEach((item, index) => {
                        formData.append('category['+index+']', item.id);
                    });
                    // console.log('test', formData)
                    axios.post('/api/auth/upload-file', formData)
                    .then(response => {
                        alert('Thanh cong!!!'),
                        this.$router.push('/home')
                    })
                    .catch(error => {
                        console.error('Upload failed:', error)
                    })
                } else {
                    const listId = null
                }
            
                
                // console.log(formData)
                
            },
            getListCategory(){
                axios.get("/api/auth/listCategory").then(({ data }) => {
                this.categories = data.data
                // console.log(this.categories)
            })
            }
        },
        mounted() {
            // this.load()
        },
        created(){
            this.load()
        }
    }
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap');
 * {box-sizing: border-box}
body{
   font-family: 'Noto Sans JP', sans-serif;
}
h1, label{
   color: DodgerBlue;
}
   input[type=text], input[type=password] {
   width: 100%;
   padding: 15px;
   margin: 5px 0 22px 0;
   display: inline-block;
   border: none;
   width:100%;
   resize: vertical;
   padding:15px;
   border-radius:15px;
   border:0;
   box-shadow:4px 4px 10px rgba(0,0,0,0.2);
 }
input[type=text]:focus, input[type=password]:focus {
   outline: none;
}
.selectcategory {
    color: DodgerBlue;
}
hr {
   border: 1px solid #f1f1f1;
   margin-bottom: 25px;
}
button {
   background-color: #4CAF50;
   color: white;
   padding: 14px 20px;
   margin: 8px 0;
   border: none;
   cursor: pointer;
   width: 100%;
   opacity: 0.9;
 }
button:hover {
   opacity:1;
}
.labelname {
    color: DodgerBlue;
    padding: 10px;
    background-color: #c5c7c5;
    border-radius:15px;
   border:0;
   box-shadow:4px 4px 10px rgba(0,0,0,0.2);
}
.cancelbtn {
   padding: 14px 20px;
   background-color: #f44336;
 }
.signupbtn {
   float: left;
   width: 100%;
   border-radius:15px;
   border:0;
   box-shadow:4px 4px 10px rgba(0,0,0,0.2);
 }
.container {
   padding: 16px;
   width: 800px;
   text-align: center;
   display: inline-block;
 }
.clearfix::after {
   content: "";
   clear: both;
   display: table;
}
.upload {
    padding: 16px;
    width: 800px;
    text-align: center;
   display: inline-block;
}
</style>