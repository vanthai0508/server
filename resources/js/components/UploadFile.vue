// ImageuploadComponent.vue

<template>
    <div>
        <div class="upload">
            <form autocomplete="off" @submit.prevent="addEditVideo"  method="post" >
                <div class="containerss">
                    <h1>Form upload file</h1>
                    <hr>
                    <label>
                        Title:
                        <input type="text" v-model="title" >
                    </label>
                    <label>
                        Link test:
                        <input type="text" v-model="linkTest" >
                    </label>
                    <label>
                        Video file:
                        <input type="file" @change="selectFile">
                    </label><br><br>
                    <video width="320" height="240" :src="path" controls>
                    </video>
               <!-- <h1>{{ this.path }}</h1> -->

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
    import eventBus from 'vue3-eventbus'
    import useEventsBus from '../event/eventBus';
    const { bus } = useEventsBus()
    // import Multiselect from 'vue-multiselect'
    export default {
        data(){
            return {
                categories: {},
                title: '',
                linkTest: '',
                selectedFile: null,
                path: '',
                categorySelected: '',
                idEdit: ''
            } 
        },
        methods: {
            load(){
                this.getListCategory()
            },
            selectFile(event) {
                this.selectedFile = event.target.files[0];
            },
            findVideo(id){
                axios.get('/api/auth/video/findVideo/'+id)
                    .then(response => {
                        this.title = response.data.data.title
                        this.path = 'storage/' + response.data.data.path
                        this.linkTest = response.data.data.link_test
                        this.categorySelected = response.data.data.category
                        this.getListCategory()
                    })
                    .catch(error => {
                        console.error('Find video failed:', error)
                    })
            },
            editVideo(id)
            {
                if(this.categorySelected.length != 0){
                    const formData = new FormData()
                    formData.append('title', this.title)
                    formData.append('link_test', this.linkTest)
                    if(this.selectedFile != null){
                        formData.append('video', this.selectedFile)
                    }
                    this.categorySelected.forEach((item, index) => {
                        formData.append('category['+index+']', item.id)
                    });
                    axios.post('/api/auth/video/updateVideo/' + id, formData)
                    .then(response => {
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$router.push('/videoOfCategory')
                    })
                    .catch(error => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        })
                    })
                    
                }
                else {
                    Toast.fire({
                            icon: 'error',
                            title: 'Please try again with input category !!'
                        });
                }
            },
            addEditVideo()
            {
                if(this.idEdit == 0) {
                    this.uploadFile()
                } else {
                    this.editVideo(this.idEdit)
                }
            },
            uploadFile(){
                if(this.categorySelected.length != 0){
                    
                    const listId = this.categorySelected.map(category => category.id)
                    
                    const formData = new FormData()
                    formData.append('title', this.title)
                    formData.append('link_test', this.linkTest)
                    formData.append('video', this.selectedFile)
                    this.categorySelected.forEach((item, index) => {
                        formData.append('category['+index+']', item.id)
                    });
                    axios.post('/api/auth/video/upload-file', formData)
                    .then(response => {
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$router.push('/videoOfCategory')
                    })
                    .catch(error => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again with input category !!'
                    });
                }
            },
            getListCategory(){
                axios.get("/api/auth/category/listCategory").then(({ data }) => {
                    this.categories = data.data
                })
            }
        },
        created() {
            if(this.$store.state.id == 0 ){
                this.idEdit = 0
                this.load()
            } else  {
                this.idEdit = this.$store.state.id
                this.findVideo(this.idEdit)
            }
            
        },
        
        mounted() {
        },
        beforeUnmount() {
            
        },
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
.containerss {
   padding: 16px;
   width: 800px;
   text-align: left; 
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
    /* text-align: left;
   display: inline-block; */
}
</style>