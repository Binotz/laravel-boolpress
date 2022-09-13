import VueRouter from "vue-router";
import AboutPage from './pages/AboutPage.vue';
import BlogPage from './pages/BlogPage.vue';
import HomePage from './pages/HomePage.vue';
import NotFoundPage from './pages/NotFoundPage.vue';

const router = new VueRouter({
    mode: "history",
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
            path: '/*',
            name: "NotFoundRoute",
            component: NotFoundPage
        },
    ]
});

export default router;
