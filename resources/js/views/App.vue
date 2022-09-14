<template>
    <div class="container">
        <HeaderComponent />
        <router-view></router-view>
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
