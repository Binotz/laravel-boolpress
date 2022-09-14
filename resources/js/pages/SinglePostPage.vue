<template>
    <div class="post-details">
        <h1>{{ post.title }}</h1>

        <!-- Categorie -->
        <div class="mb-4">
            <h6>Categorie:</h6>
            <span v-if="post.category"> {{ post.category.name }} </span>
            <span v-else> Nessuna</span>
        </div>

        <!-- Tags -->
        <div class="mb-4">
            <h6>Tags:</h6>
            <span v-if="post.tags.length > 0">
                <span v-for="(tag, index) in post.tags" :key="index">
                    {{ tag.name }}
                    <br />
                </span>
            </span>
            <span v-else> Nessuna</span>
        </div>
        <span>Contenuto:</span>
        <br />
        <p>
            {{ post.content }}
        </p>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "SinglePostPage",
    data() {
        return {
            BASE_URL: "http://localhost:8000/api/posts/",
            post: {},
            slug: "",
        };
    },
    methods: {
        getData: async function () {
            await axios
                .get(this.BASE_URL + this.slug)
                .then((res) => {
                    this.post = res.data.response;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.slug = this.$route.params.slug;
        this.getData();
    },
};
</script>
