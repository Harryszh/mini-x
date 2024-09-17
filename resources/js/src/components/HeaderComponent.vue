<script setup>
import { RouterLink } from 'vue-router';


</script>

<template>
<header class="header-box">
    <div>
        <nav class="header">
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/dashboard" v-if="!authUser">Dashboard</RouterLink>
            <RouterLink to="/login" v-if="!authUser">Login</RouterLink>
            <RouterLink to="/register" v-if="!authUser">Register</RouterLink>
            <RouterLink :to="{name: 'post-create'}">Create Post</RouterLink>
        </nav>
    </div>
</header>
</template>

<style scoped>

    .header-box{
        background-color: #0f7ae4;
        margin: 0;
        padding: 0;

    }

    .header{
        display: flex;
        justify-content: space-between;
        margin-left: 20px;
        margin-right: 20px;
        
    }
    

</style>