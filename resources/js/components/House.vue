<template>
    <!-- <h1>This is house page </h1> -->
    <img alt="Vue logo" src="https://www.vectorlogo.zone/logos/vuejs/vuejs-ar21.png">
    <MainHeader/>
</template>
<script>
    import MainHeader from './MainHeader.vue'

    export default {
        components: {
            MainHeader
        }
    }

</script>

<style>

img {
    width: 550px;
    border-radius: 2px;
    box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.5);
    transition: width 1s;
    padding-top: 30px;
}
</style>