// ImageuploadComponent.vue

<template>
    <div class="container" id="app">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">File Upload Component</div>
                    <div class="card-body">
                        <form @submit.prevent="uploadFile">
      <label>
        Title:
        <input type="text" v-model="title">
      </label>
      <label>
        Video file:
        <input type="file" @change="selectFile">
      </label>
      <button type="submit">Upload video</button>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data(){
            return {
                title: '',
                selectedFile: null,
            }
        },
        methods: {
            selectFile(event) {
                this.selectedFile = event.target.files[0];
            },
            uploadFile(){
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('video', this.selectedFile);
                console.log(formData)
                axios.post('/api/auth/upload-file', formData)
                .then(response => {
                    alert('Thanh cong!!!')
                })
                .catch(error => {
                    console.error('Upload failed:', error)
                });
            }
        }
    }
</script>
