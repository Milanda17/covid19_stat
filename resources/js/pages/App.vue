<template>
    <div>
        <navbar/>
        <div class="container">
            <div class="row justify-content-center center">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import navbar from "../components/Navbar";
export default {
    name: "App",
    components: {
        navbar,
    },
}
</script>

<style scoped>
.center {
    padding: 40px;
}
</style>
