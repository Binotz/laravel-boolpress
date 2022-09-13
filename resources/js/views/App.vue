<template>
    <div class="container">
        <!-- <a href="/admin">Login Page</a>
        <h1 class="text-center">Elenco dei post</h1> -->
        <HeaderComponent />
        <router-view></router-view>
        <!-- <CardsComponent /> -->
    </div>
</template>
<script>
import CardsComponent from "../components/CardsComponent.vue";
import HeaderComponent from "../components/HeaderComponent.vue";

export default {
    name: "App",
    components: {
        CardsComponent,
        HeaderComponent,
    },
};
</script>
