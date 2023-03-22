import { createApp } from 'vue'
import App from './App.vue'
import router from '../config/routes'
import '../js/utils/setUpInterceptor'
import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate';

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

const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')
