import { createApp } from 'vue'
import App from './App.vue'
import router from '../config/routes'
import '../js/utils/setUpInterceptor'

const app = createApp(App)
app.use(router)
app.mount('#app')
