<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default ">
                    <div class="card-header"><h3>Login</h3></div>
                    <div class="card-body">
                        <form autocomplete="off" method="post">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" id="name" class="form-control"  v-model="form.email" >
                                <span class="validation-text" v-if="form.errors">{{form.errors.validations.email ? form.errors.validations.email[0] : ''}}</span>

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" v-model="form.password" >
                                <span class="validation-text" v-if="form.errors">{{form.errors.validations.password ? form.errors.validations.password[0] : ''}}</span>
                            </div>
                            <button type="button" class="btn btn-outline-info my-2" @click="login()">Signin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import router from '../../router'

export default {
name: "Login",
    setup(){
        const form = reactive({
            email: null,
            password: null,
            errors: '',
        })

        // user login
        async function login() {
            form.errors =''
            let submitData = {}
            submitData.email = form.email
            submitData.password = form.password
            await axios.post('api/auth/login', form).then(response => {
                if (response.data != null && !response.data.data.errors){
                    localStorage.setItem('token', response.data.data.access_token)  //save access token in local storage
                    router.push({ name: 'help-and-guide' }).then(()=>{   //redirect to help-and-guide UI
                        window.location.reload();
                    })
                    restForm();

                }else {
                    form.errors = response.data.data.errors  //set errors
                }
            }).catch(()=>{
                console.log('error')
            })
        }

        function restForm(){
            form.email = null
            form.password = null
            form.errors = ''
        }

        return {
            form,
            login,
        }
    },
}
</script>

<style>
.validation-text{
    color: darkred;
    font-size: smaller;
}
</style>
