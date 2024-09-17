import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
/* import { useAuthStore } from '../stores/auth'; */ // Importiere den Auth-Store
import { storeToRefs } from 'pinia';

import { useAuthStore } from "@/store/AuthStore";

const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        {
            path: "/",
            name: "home",
            component: LoginView,
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: () => import("../views/DashboardView.vue"),
            meta: { requiresAuth: true },
        },
        {
            path: "/login",
            name: "login",
            component: () => import("../views/LoginView.vue"),
        },
        {
            path: "/register",
            name: "register",
            component: () => import("../views/RegisterView.vue"),
        },
        {
            path: "/post/create",
            name: "post-create",
            component: () => import("../views/PostCreateView.vue"),
        },
        {
        path: "/post/edit/:id",
        name: "post-edit",
        component: () => import("../views/EditView.vue"),
        },
    ],
});

// Navigation Guard
router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();
    const { authUser } = storeToRefs(authStore); // Verwendet den Pinia Store
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);

    if (requiresAuth && !authUser.value) {
        try {
            await authStore.getAuthUser(); // Versuche, den authentifizierten Benutzer zu holen
            if (!authUser.value) {
                return next("/login"); // Wenn der Benutzer immer noch nicht authentifiziert ist, leite zur Login-Seite weiter
            }
        } catch (error) {
            return next("/login"); // Leite zur Login-Seite weiter, wenn ein Fehler auftritt
        }
    }
    next(); // Stelle sicher, dass next() immer aufgerufen wird
});

export default router;