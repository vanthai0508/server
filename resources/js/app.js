import { createApp } from 'vue'
import App from './App.vue'
import router from '../config/routes'
import '../js/utils/setUpInterceptor'
import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import Swal from "sweetalert2"

const store = createStore({
    state() {
        return {
            id: 0
        }
    },
    plugins: [createPersistedState()],
    mutations: {
        changeId (state, id) {
          // mutate state
          state.id = id
        }
    }
})

window.Vue = require("vue");

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
})

window.Swal = Swal;
window.Toast = Toast;
const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')
