<template>

    <div>
        <div class="row center">
                <h3 class="title-color">UPDATE  DATE TIME : {{form.update_date_time}}</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header mb-3"><h3>LOCAL </h3></div>
                    <div class="col-12">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>New cases</td>
                                <td>{{form.local_new_cases}}</td>
                            </tr>
                            <tr>
                                <td>Active cases</td>
                                <td>{{form.local_active_cases}}</td>
                            </tr>
                            <tr>
                                <td>Total cases</td>
                                <td>{{form.local_total_cases}}</td>
                            </tr>
                            <tr>
                                <td>Number of individuals in hospitals</td>
                                <td>{{form.local_total_number_of_individuals_in_hospitals}}</td>
                            </tr>
                            <tr>
                                <td>Recovered</td>
                                <td>{{form.local_recovered}}</td>
                            </tr>
                            <tr>
                                <td>New death</td>
                                <td>{{form.local_new_deaths}}</td>
                            </tr>
                            <tr>
                                <td>Total death</td>
                                <td>{{form.local_deaths}}</td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header mb-3"><h3>GLOBAL</h3></div>
                    <div class="col-12">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>New cases</td>
                                <td>{{form.global_new_cases}}</td>
                            </tr>
                            <tr>
                                <td>Total cases</td>
                                <td>{{form.global_total_cases}}</td>
                            </tr>

                            <tr>
                                <td>Recovered</td>
                                <td>{{form.global_recovered}}</td>
                            </tr>
                            <tr>
                                <td>New death</td>
                                <td>{{form.global_new_deaths}}</td>
                            </tr>
                            <tr>
                                <td>Total death</td>
                                <td>{{form.global_deaths}}</td>
                            </tr>
                            </tbody>
                        </table>

                </div>
                </div>
            </div>

        </div>


</template>

<script>
import {reactive, onMounted } from 'vue'

export default {
name: "CovidDashboard",
    setup(){
        const form = reactive({
            update_date_time: null,
            local_new_cases: null,
            local_total_cases: null,
            local_total_number_of_individuals_in_hospitals: null,
            local_new_deaths: null,
            local_deaths: null,
            local_recovered: null,
            local_active_cases: null,
            global_new_cases: null,
            global_total_cases: null,
            global_deaths: null,
            global_new_deaths: null,
            global_recovered: null,
        });

        onMounted(()=>{
            getCovidData()
        })

        function getCovidData() {
            axios.get('api/covid-data/get').then((response) => {
                if (response.data.success &&  response.data != null) {
                    form.update_date_time = response.data.data.update_date_time
                    form.local_new_cases = response.data.data.local_new_cases
                    form.local_total_cases = response.data.data.local_total_cases
                    form.local_total_number_of_individuals_in_hospitals = response.data.data.local_total_number_of_individuals_in_hospitals
                    form.local_new_deaths = response.data.data.local_new_deaths
                    form.local_deaths = response.data.data.local_deaths
                    form.local_recovered = response.data.data.local_recovered
                    form.local_active_cases = response.data.data.local_active_cases
                    form.global_new_cases = response.data.data.global_new_cases
                    form.global_total_cases = response.data.data.global_total_cases
                    form.global_deaths = response.data.data.global_deaths
                    form.global_new_deaths = response.data.data.global_new_deaths
                    form.global_recovered = response.data.data.global_recovered
                }
            })
        }
        return {
            form,
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

</style>
