import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import Register from "./components/auth/Register.vue";
import ImageGallery from "./components/ImageGallery.vue";

export const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/gallery',
        component: ImageGallery,
        meta: {
            requiresAuth: true
        }
    }
];