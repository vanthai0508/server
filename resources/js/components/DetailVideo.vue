<template>
    <div class="detail">
        <div class="main-video" style="width: 48%; float:left">
            <video :src="path" controls >

            </video><br>
            <h3>Tieu de : {{ title }}</h3>
            
        </div>
        <div class="content" style="width: 48%; float:right">
            <label class="label">Link test :</label>
                <a :href="this.link"> Click here to make test</a><br><br>
            <label class="label">Category name : </label>
            <select name="category" id="category">
                <option v-for="item in categories" :value="item">{{ item.name }}</option>
            </select><br><br>
            <label class="label">Title : </label> <label class="notCss"> {{ title }}</label><br><br>
            <label class="label">Code: </label> <label class="notCss"> {{ code }}</label><br><br>
            <label class="label">Score :</label>
            <select name="history" id="history">
                <option v-for="item in historyScore" :value="item">{{ item.score }}!!!   Date : {{ item.created_at }}</option>
            </select><br><br>
            <label class="label">Comment :</label>



        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { RouterLink, RouterView } from 'vue-router';

export default {
    data() {
      return {
         videos: '',
         historyScore: {},
         title: '',
         link: '',
         categories: {},
         code: '',
         path: ''
        //  detailVideo: {}
        //  id: ''
      }
    },
    methods: {
        load(id) {
            axios.get("/api/auth/video/detailVideo/" +id).then(({ data }) => {
            this.historyScore = data.data.history_score
            console.log()
            this.title = data.data.title
            this.link = data.data.link_test
            this.categories = data.data.category
            this.code = data.data.code
            this.path = 'storage/' + data.data.path
          })
        }
    },
    created() {
        this.load(this.$store.state.idVideo)
    }
}
</script>
<style >

@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);
.detail {
    padding: 50px;
}
.content {
    height: 474px;
    padding-left: 60px;
    padding-top: 30px;
    text-align: left;
    border-width:8px;
    border-style:outset;
    border-color:rgb(173, 168, 168);
    background-color: darkgrey
}
.main-video {
    text-align: left;
}
select{
  border:none;
  padding: 10px 20px;
  border-radius:5px;
}

select:focus{
  outline:none;
}

.label {
  display: inline-block;
  background-color: #5d615d;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
}

.notCss {
    color: black;
}

</style>