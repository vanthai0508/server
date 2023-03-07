import { createRouter, createWebHistory } from 'vue-router'

import Home from '../js/components/Home.vue'
import Login from '../js/components/Login.vue'
import Register from '../js/components/Register.vue'
import Welcome from '../js/components/Welcome.vue'
// import Contact from '@/components/Contact.vue'

const routes = [
    {
        path: '/',
        name: "home",
        component: Home,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/:catchAll(.*)',
        component: Error
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
