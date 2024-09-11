<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <header>
        <div>
            <nav>
                <RouterLink to="/">Home</RouterLink>
                <RouterLink to="/dashboard">Dashboard</RouterLink>
                <RouterLink to="/login">Login</RouterLink>
            </nav>
        </div>
    </header>

    <div>Mini X <br>
        Hallo {{ $name }}
    </div>
    <!-- RouterView zeigt den jeweiligen View basierend auf der aktuellen Route an -->
    <RouterView />
</template>