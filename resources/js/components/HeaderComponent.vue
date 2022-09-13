<template>
    <ul>
        <li v-for="(menuLink, index) in menuLinks" :key="index">
            <router-link :to="{ path: menuLink.link }">
                {{ menuLink.name }}
            </router-link>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            menuLinks: [
                {
                    link: "/",
                    name: "Home",
                },
                {
                    link: "/about",
                    name: "About",
                },
                {
                    link: "/blog",
                    name: "Blog",
                },
            ],
        };
    },
};
</script>

<style lang="scss" scoped>
ul {
    list-style-type: none;
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 3rem;
    font-size: 1.3rem;
    font-weight: bold;
    a {
        text-decoration: none;
    }
}
</style>
