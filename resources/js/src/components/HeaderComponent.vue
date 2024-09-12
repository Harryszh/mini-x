<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
<header>
    <div>
        <nav>
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/dashboard" v-if="authUser">Dashboard</RouterLink>
            <RouterLink to="/login" v-if="!authUser">Login</RouterLink>
            <RouterLink to="/register" >Register</RouterLink>
        </nav>
    </div>
</header>
</template>