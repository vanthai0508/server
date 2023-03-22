// ImageuploadComponent.vue

<template>
    <div>
        <div class="upload">
            <form autocomplete="off" @submit.prevent="addEditCategory()" method="post" >
                <div class="containers">
                    <h1>Form create category</h1>
                    <hr>
                    <label for="Name"><b>Name</b></label>
                    <input type="text" v-model="name" placeholder="Name" name="name" required>
                    <label for="Description"><b>Description</b></label>
                    <input type="text" v-model="description" placeholder="Description" name="description" required>
                   
                    <div class="clearfix">
                        <button type="submit" class="signupbtn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    
    export default {
        data(){
            return {
                name: '',
                description: '',
                idEdit: ''
            } 
        },
        methods: {
            load(){
            },
            findCategory(id){
                axios.get('/api/auth/findCategory/' + id)
                .then(response => {
                    this.name = response.data.data.name,
                    this.description = response.data.data.description
                })
                .catch(error => {
                    console.error('Create failed:', error)
                })
            },
            addEditCategory(){
                if(this.idEdit == 0){
                    this.createCategory()
                } else {
                    this.editCategory(this.idEdit)
                }
            },
            editCategory(id){
                axios.put('/api/auth/updateCategory/' + id, {
                    name: this.name,
                    description: this.description
                })
                .then(response => {
                    this.$router.push('/category')
                })
                .catch(error => {
                    console.error('Edit failed:', error)
                })
            },
            createCategory(){
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                axios.post('/api/auth/createCategory', formData)
                .then(response => {
                    this.$router.push('/category')
                })
                .catch(error => {
                    console.error('Create failed:', error)
                })
            },
        },
        mounted() {
        },
        created(){
            this.idEdit = this.$store.state.id
            if(this.idEdit != 0){
                this.findCategory(this.idEdit)
            }
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
.containers {
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
    text-align: center;
   display: inline-block;
}
</style>