import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
/* import { useAuthStore } from '../stores/auth'; */ // Importiere den Auth-Store
import { storeToRefs } from 'pinia';

import { useAuthStore } from "@/store/AuthStore";

const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
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