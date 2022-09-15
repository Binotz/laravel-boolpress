<template>
    <div class="container">
        <!-- Cards -->
        <div class="row row-cols-3 g-4">
            <div class="col" v-for="post in posts" :key="post.id">
                <CardComponent :post="post" />
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a
                        class="page-link"
                        :class="{ disabled: currentPage === 1 }"
                        v-on:click.prevent="getPosts(currentPage - 1)"
                        href="#"
                        tabindex="-1"
                        aria-disabled="true"
                        >Previous</a
                    >
                </li>

                <li
                    class="page-item"
                    v-for="page in pages"
                    :key="page"
                    :class="{ active: currentPage === page }"
                >
                    <a
                        class="page-link"
                        v-on:click.prevent="getPosts(page)"
                        href="#"
                        >{{ page }}</a
                    >
                </li>

                <li class="page-item">
                    <a
                        class="page-link"
                        :class="{ disabled: currentPage == pages }"
                        v-on:click.prevent="getPosts(currentPage + 1)"
                        href="#"
                        >Next</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import CardComponent from "./CardComponent.vue";
export default {
    name: "CardsComponents",
    data() {
        return {
            posts: [],
            currentPage: 0,
            pages: 0,
        };
    },
    methods: {
        getPosts: function (page) {
            if (page <= 0) {
                page = 1;
            }
            if (page >= this.pages) {
                page = this.pages;
            }
            axios
                .get("/api/posts", {
                    params: {
                        page: page,
                    },
                })
                .then((res) => {
                    const posts = res.data.results;
                    this.posts = posts.data;
                    this.currentPage = posts.current_page;
                    this.pages = posts.last_page;
                });
        },
    },
    mounted() {
        this.getPosts(1);
    },
    components: { CardComponent },
};
</script>
<style scoped>
nav {
    margin-top: 2rem;
}
</style>
