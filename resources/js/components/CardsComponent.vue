<template>
    <div class="container">
        <div class="row row-cols-3 g-4">
            <div class="col" v-for="post in posts" :key="post.id">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">
                            {{ post.content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "CardsComponents",
    data() {
        return {
            posts: [],
        };
    },
    methods: {
        getPosts: function () {
            axios.get("/api/posts").then((res) => {
                //console.log(res.data.results);
                const posts = res.data.results;
                this.posts = posts;
            });
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>
