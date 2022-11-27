import { createRouter, createWebHistory } from 'vue-router'
import CovidDashboard from "./pages/CovidDashboard";
import HelpAndGuide from "./pages/HelpAndGuide";
import Login from "./pages/auth/Login";
import Register from "./pages/auth/Register";
import Unauthorized from "./components/Unauthorized";


const routes = [
    {
        path:'/',
        component:CovidDashboard,
        meta: {
            guest: true,
            requiresAuth: true
        }
    },
    {
        path:'/help-and-guide',
        name:'help-and-guide',
        component:HelpAndGuide,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/covid-dashboard',
        name:'covid-dashboard',
        component:CovidDashboard,
        meta: {
            guest: true,
            requiresAuth: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            guest: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        path: '/unauthorized',
        name: 'unauthorized',
        component: Unauthorized,
        meta: {
            requiresAuth: true,
        }
    },
];


const router = createRouter({ history: createWebHistory(), routes });

router.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.requiresAuth) && to.matched.some(record => record.meta.guest)){   //access both guest & requiresAuth allow routers
            next()
        }else if (to.matched.some(record => record.meta.requiresAuth)) { //access only requiresAuth allow routers
            if (localStorage.getItem('token') == null) {  //check token is in local storage
                next({
                    path: '/login',
                    params: {nextUrl: to.fullPath}
                })
            } else {
                next()
            }
        } else if (to.matched.some(record => record.meta.guest)) { //access only guest allow routers
            if (localStorage.getItem('token') == null) { //check token is in local storage
                next()
            } else {
                next({path: '/unauthorized',})
            }
        } else {
            next({path: '/unauthorized',})
        }

})

export default router;
