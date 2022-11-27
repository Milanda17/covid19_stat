<template>

    <div>
        <div class="row center mb-2">
            <div class="col-6">
                <h3 class="title-color">HELP AND GUIDE</h3>
            </div>
            <div class="col-6">
                <button class="btn btn-outline-info my-2 my-sm-0 mx-2 " type="button" data-toggle="modal" data-target=".bd-example-modal-lg" @click="form.errors = ''">Add New Help & Guide</button>
            </div>
        </div>
        <div class="row" style="overflow-y: scroll; height:700px;">
            <div class="col-12">
                <div class="card mb-3" v-for="item in helpList">
                    <div class="card-header mb-3">
                        <div class="row">
                        <div class="col-6"> <p class="header-text">Name : {{ item.user.name }}</p></div>
                        <div class="col-6"> <p class="header-text">Date Time: {{ dataTimeFormatting(item.created_at) }}</p></div>
                        </div>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a v-bind:href="item.link">{{item.link}}</a></h5>
                        <p class="card-text">{{item.description}}</p>
                    </div>
                </div>
                <div class="card mb-3" v-if="helpList.length <= 0">
                    <div class="card-body">
                        <h5 class=" center">No help and guides were added.</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Help & Guide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Link</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" v-model="form.link">
                            <span class="validation-text" v-if="form.errors">{{form.errors.validations.link ? form.errors.validations.link[0] : ''}}</span>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"  v-model="form.description"></textarea>
                            <span class="validation-text" v-if="form.errors">{{form.errors.validations.description ? form.errors.validations.description[0] : ''}}</span>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary my-2 my-sm-0 mx-2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-info my-2 my-sm-0 mx-2" @click="submitHelpAndGuide()">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {reactive, onMounted, ref} from 'vue'
import router from "../router";


export default {
    name: "CovidDashboard",
    setup(){
        const form = reactive({
            link: null,
            description: null,
            errors: '',

        });
        const helpList = ref([]);

        onMounted(()=>{
            getAllHelpAndGuide()
        })

        // get all help and guide data
        function getAllHelpAndGuide() {
            let token =  localStorage.getItem('token')
            // check token is empty
            if (token != null && token !=''){
                //set bearer token
                const headers = {
                    "Authorization": "Bearer" + token,
                };
                axios.get('api/help-guide/get-all',{headers}).then((response) => {
                    if (response.data.success && !response.data.data.error) {
                        helpList.value = response.data.data
                    }else if(response.data.error == "Unauthenticated."){    //Unauthenticated validation handle
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

        // create help and guide record
        function submitHelpAndGuide(){
            form.errors =''
            let submitData ={}
            submitData.link =  form.link
            submitData.description =  form.description
            let token =  localStorage.getItem('token')

            // check token is empty
            if (token != null && token !=''){
                //set bearer token
                const headers = {
                    "Authorization": "Bearer" + token,
                };
                axios.post('api/help-guide/create',submitData,{headers}).then((response) => {
                    if (response.data.success != null && !response.data.data.errors) {
                        closeModal()
                        getAllHelpAndGuide()   // get all help & guide records
                        restForm()   //reset form data
                    } else {
                        console.log(response.data)
                        if(response.data.error == "Unauthenticated."){  //Unauthenticated validation handle
                            router.push({ name: 'login' }).then(()=>{
                                window.location.reload();
                            })
                        }
                        form.errors = response.data.data.errors
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

        //format date & time
        function dataTimeFormatting(rowDateTime){
            return new Date(rowDateTime).toLocaleString('en-GB', { timeZone: 'IST' })
        }

        //close popup modal
        function closeModal(){
            const modal = document.getElementById('modal');
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            modal.setAttribute('style', 'display: none');
            const modalBackdrops = document.getElementsByClassName('modal-backdrop');
            document.body.removeChild(modalBackdrops[0]);
        }

        //reset form data
        function restForm(){
            form.link = null
            form.description = null
            form.errors = ''
        }
        return {
            form,
            helpList,
            submitHelpAndGuide,
            dataTimeFormatting,
        }

    },

}
</script>

<style scoped>

.center{
    padding-left: 40%;
}
.title-color{
    color: #e2e8f0;
}
.validation-text{
    color: darkred;
    font-size: smaller;
}
.header-text{
    color: darkcyan;
    font-size: medium;
}

</style>
