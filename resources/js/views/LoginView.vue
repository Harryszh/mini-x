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
    <div class="main">
        <div class="box">
            <div>
                <h1>Live and Trending</h1>  
                <p>Welcome back</p>    
            </div>
        
            <div class="login-container">
                <h1>Login</h1>
                <form @submit.prevent="handleLogin" class="login-box">
                    <label for="email">Email:</label>
                    <input class="placeholder" type="text" v-model="email" id="email" />

                    <label for="password">Password:</label>
                    <input class="placeholder" type="password" v-model="password" id="password" />

                    <div class="button-box">
                        <p>Don't have an account? <RouterLink to="/register" v-if="!authUser">Sign up</RouterLink> </p>
                        <button class="button" type="submit">Login</button>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
</template>

<style scoped>
    .main{
        background-color: #F1F1F1;
    }
    
    .box{
        display: flex;
        flex-direction: column;

        /* background-color: #FFFFFF; */
        ;
        padding-top: 108px;
        padding-bottom: 445px;
        padding-left: 372px;
        padding-right: 372px;

        
    }
    .login-container{
        background-color: #FFFF;
        padding: 42px;
        
    }
    .login-box{
        display: flex;
        flex-direction: column;
        
    }
    .button-box{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding-top: 38px;
    }
    .button{
        height: 38px;
       
        
        background: #1D9BF0;
        color: white;
        
        cursor: pointer;
        border-radius: 8px;
        
        display: flex;
        align-items: center;
        border: none;
        

    }
    .placeholder{
        height: 56px;
    }
</style>