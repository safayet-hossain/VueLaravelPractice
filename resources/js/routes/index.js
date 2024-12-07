import { createWebHistory, createRouter } from "vue-router";

const routes = [
    { path: "/", component: () => import("./../pages/HomeView.vue") },
    { path: "/about", component: () => import("./../pages/AboutView.vue") },
    {
        path:"/information",component:() =>import("./../pages/Information.vue")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;