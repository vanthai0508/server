//Register.vue

<template>
    <div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post" >
            <div class="container">
                <h1>Form Đăng Ký</h1>
                <p>Xin hãy nhập biểu mẫu bên dưới để đăng ký.</p>
                <hr>
                <label for="Name"><b>Name</b></label>
                    <input type="text" v-model="name" placeholder="Name" name=" name" required>
                <label for="Email"><b>Email</b></label>
                    <input type="text" v-model="email" placeholder="Email" name="Email" required>
                <label for="Password"><b>Password</b></label>
                    <input type="password" v-model="password" placeholder="Password" name="Password" required>
                <label for="C_password"><b>C_password</b></label>
                    <input type="password" v-model="c_password" placeholder="C_password" name="C_password" required>
                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Nhớ Đăng Nhập
                </label>
                <div class="clearfix">
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script> 
import { thisTypeAnnotation } from '@babel/types';
import axios from 'axios'
    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                c_password: '',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            register() {
                var result = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    c_password: this.c_password
                }
                axios.post("/api/auth/signup", result)
                .then(({ data }) => ( 
                    alert('Thanh cong!!!')
                    // console.log(this.name)
                    ),
                );
            }
            // notifyEditSuccess() {
            //      this.$notification.open({
            //     message: "Thành công",
            //     className: "notify-success",
            //     style: {
            //         background: "#00d909 !important",
            //     },
            //     closeIcon: " ",
            //     description: "Thay đổi được thực hiện thành công! ",
            // });
    },
        //     register(){
        //         var app = this
        //         this.$auth.register({
        //             params: {
        //                 email: app.email,
        //                 password: app.password
        //             }, 
        //             success: function () {
        //                 app.success = true
        //             },
        //             error: function (resp) {
        //                 app.error = true;
        //                 app.errors = resp.response.data.errors;
        //             },
        //             redirect: null
        //         });                
        //     }
        }
</script>
<style lang="css" scoped>
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
</style>