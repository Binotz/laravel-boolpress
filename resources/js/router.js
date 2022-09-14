import VueRouter from "vue-router";
import AboutPage from './pages/AboutPage.vue';
import BlogPage from './pages/BlogPage.vue';
import HomePage from './pages/HomePage.vue';
import NotFoundPage from './pages/NotFoundPage.vue';
import SinglePostPage from './pages/SinglePostPage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: "HomeRoute",
            component: HomePage
        },
        {
            path: '/about',
            name: "AboutRoute",
            component: AboutPage
        },
        {
            path: '/blog',
            name: "BlogRoute",
            component: BlogPage
        },
        {
            path: '/blog/:slug',
            name: "SinglePageRoute",
            component: SinglePostPage
        },
        {
            path: '/*',
            name: "NotFoundRoute",
            component: NotFoundPage
        },
    ]
});

export default router;
