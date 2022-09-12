<template>
    <div>
        <a href="/admin">Login Page</a>
        <h1 class="text-center">Elenco dei post</h1>
        <CardsComponent />
    </div>
</template>
<script>
import CardsComponent from "../components/CardsComponent.vue";

export default {
    name: "App",
    components: {
        CardsComponent,
    },
};
</script>
