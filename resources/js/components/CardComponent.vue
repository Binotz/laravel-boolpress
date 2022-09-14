<template>
    <div class="card h-100">
        <div class="card-body d-flex flex-column justify-content-between">
            <div class="mb-3">
                <h3 class="card-title">{{ post.title }}</h3>
                <p class="card-text">{{ post.content }}</p>
            </div>
            <router-link
                :to="{ name: 'SinglePageRoute', params: { slug: post.slug } }"
                class="btn btn-primary align-self-start"
                >Dettaglio</router-link
            >
        </div>
    </div>
</template>
<script>
export default {
    props: {
        post: Object,
    },
};
</script>
