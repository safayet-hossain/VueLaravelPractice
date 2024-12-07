import { createWebHistory, createRouter } from "vue-router";

const routes = [
    { path: "/", component: () => import("./../pages/HomeView.vue") },
    { path: "/about", component: () => import("./../pages/AboutView.vue") },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;