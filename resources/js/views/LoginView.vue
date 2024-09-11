<script setup>
// refs verwenden wir, um die Daten zu binden und reaktiv zu machen
import { ref } from "vue";
import { useRouter } from "vue-router";

// wir importieren den AuthStore, damit wir die Authentifizierung durchführen können
import { useAuthStore } from "@/store/AuthStore";

// wir holen uns die login und getAuthUser Funktionen aus dem Store
const authStore = useAuthStore();
const { login, getAuthUser } = authStore;

// für das v-model binding, siehe unten im template
const email = ref("");
const password = ref("");

// Router verwenden, um den Benutzer nach erfolgreichem Login weiterzuleiten
const router = useRouter();

const handleLogin = async () => {
    try {
        // wir geben die email und password Werte an die login Funktion in unserem Store weiter
        await login({ email: email.value, password: password.value });

        // nach dem Login holen wir uns den authentifizierten User, um ihn im Store zu speichern
        const res = await getAuthUser();

        // wenn der Status 200 ist, leiten wir den Benutzer auf die Dashboard-Seite weiter
        if (res.status === 200) {
            router.push("/dashboard");
        }
    } catch (error) {
        console.error("Login fehlgeschlagen:", error);
        alert("Login fehlgeschlagen. Bitte überprüfen Sie Ihre Anmeldedaten.");
    }
};
</script>

<template>
    <div>
        <h1>Login View</h1>
        <form @submit.prevent="handleLogin">
            <label for="email">Email:</label>
            <input type="text" v-model="email" id="email" />

            <label for="password">Password:</label>
            <input type="password" v-model="password" id="password" />

            <button type="submit">Login</button>
        </form>
    </div>
</template>