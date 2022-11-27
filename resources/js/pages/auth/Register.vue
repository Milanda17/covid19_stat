<template>
    <div class="container">
        <div class="row justify-content-md-center">
           <div class="col-10">
                <div class="card card-default" >
                    <div class="card-header"><h3>Register</h3></div>
                    <div class="card-body">
                        <form autocomplete="off" method="post">
                            <div class="form-row ">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" v-model="form.name">
                                    <span class="validation-text" v-if="form.errors">{{form.errors.validations.name ? form.errors.validations.name[0] : ''}}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control"  v-model="form.email">
                                    <span class="validation-text" v-if="form.errors">{{form.errors.validations.email ? form.errors.validations.email[0] : ''}}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label >Password</label>
                                    <input type="password" id="password" class="form-control" v-model="form.password">
                                    <span class="validation-text" v-if="form.errors">{{form.errors.validations.password ? form.errors.validations.password[0] : ''}}</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation">Confirm password</label>
                                    <input type="password" id="password_confirmation" class="form-control" v-model="form.confirmPassword">
                                    <span class="validation-text" v-if="form.errors">{{form.errors.validations.confirm_password ? form.errors.validations.confirm_password[0] : ''}}</span>
                                </div>
                            </div>
                            <button class="btn btn-outline-info my-2" type="button" @click="register()">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue'
import router from '../../router'
import axios from "axios";

export default {
name: "Register",

    setup(){
        const form = reactive({
            name: null,
            email: null,
            password: null,
            confirmPassword: null,
            errors: '',
        })

        // user register
        async function register() {
            form.errors =''
            let submitData = {}   // set request body
            submitData.name = form.name
            submitData.email = form.email
            submitData.password = form.password
            submitData.confirm_password = form.confirmPassword
            await axios.post('api/auth/register', submitData).then((response) => {
                if (response.data.success && response.data != null && !response.data.data.errors){
                    alert('Registration successfully completed')
                    router.push({ name: 'login' })  //redirect to login
                    restForm();
                }else {
                    form.errors = response.data.data.errors  //handle errors
                }
            }).catch(()=>{
                console.log('error')
            })
        }

        function restForm(){
            form.name = null
            form.email = null
            form.password = null
            form.confirmPassword = null
            form.errors = ''
        }

        return {
            form,
            register,
        }
    },
}
</script>

<style scoped>
.row{
    padding-bottom: 5px;
}
.validation-text{
    color: darkred;
    font-size: smaller;
}
</style>
