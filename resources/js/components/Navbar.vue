<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active mx-5"><h3 class="color-blue"><b>COVID19 STAT</b></h3></li>
                    <li class="nav-item"><router-link to="/covid-dashboard"><h5 class="nav-link color-blue" href="#"><b>COVID19 STAT</b></h5></router-link></li>
                    <li class="nav-item dropdown"><router-link to="/help-and-guide"><h5 class="nav-link color-blue" href="#"  v-if="!isGuest"><b>HELP & GUIDE</b></h5></router-link></li>
                    <li class="nav-item"></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <router-link to="/login"><button class="btn btn-outline-info my-2 my-sm-0 mx-2" type="button"  v-if="isGuest">Login</button></router-link>
                    <router-link to="/register"><button class="btn btn-outline-info my-2 my-sm-0 mx-2" type="button"  v-if="isGuest">Register</button></router-link>
                    <button class="btn btn-outline-info my-2 my-sm-0 mx-2" type="button" v-if="!isGuest" @click="logout()">Logout</button>
                </form>
            </div>
        </nav>
    </div>

</template>

<script>
import { ref } from 'vue'
import axios from "axios";
import router from "../router";
export default {
    name: "Navbar",

    setup(){
        const name =  ref(localStorage.getItem('name'));
        const isGuest = !localStorage.getItem('token')

        // user logout
        async function logout() {
            let token =  localStorage.getItem('token')

            // check token is empty
            if (token != null && token !='') {

                //set bearer token
                const headers = {
                    "Authorization": "Bearer" + token,
                };

                //expire token in backend
                await axios.get('api/auth/logout', {headers}).then(response => {
                    if (response.data.success && !response.data.data.errors){
                        router.push({ name: 'login' }).then(()=>{
                            window.location.reload();
                        })
                    }else if(response.data.error == "Unauthenticated."){  //Unauthenticated validation handle
                        router.push({ name: 'login' }).then(()=>{
                            window.location.reload();
                        })
                    }
                }).catch(()=>{
                    console.log('error')
                })
            }else {
                router.push({ name: 'login' }).then(()=>{
                    window.location.reload();
                })
            }
        }

        return {
            name,
            logout,
            isGuest
        }
    },
}
</script>

<style scoped>
.navbar-right{
    padding-left: 35%;
}
.center{
    padding-left: 20%;
}
.color-blue{
    color: #1980B9;
}

</style>
