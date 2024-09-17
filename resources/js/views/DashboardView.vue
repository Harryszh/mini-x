<script setup>
import { ref, onMounted } from 'vue'
import { storeToRefs } from "pinia";
import { useAuthStore, authClient } from "@/store/AuthStore";
import router from "@/router";
const { authUser } = storeToRefs(useAuthStore());
const { logout } = useAuthStore();

// Get Posts
const posts = ref([])

const getPosts = async () => {
    const res = await authClient.get(`/api/posts`)
    posts.value = res.data
}

onMounted(async ()=>{
    getPosts()
})

// Login
const handleLogout = () => {
    logout();
    router.push("/login");
};
</script>
<template>
    <div>
        <h1>Dashboard View</h1>
        <p>Welcome, {{ authUser.name }}</p>
        <button @click="handleLogout">Logout</button>
    </div>
    <div v-for="post in posts" :key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.content }}</p>
            <RouterLink :to="{name: 'post-edit', params:{ id: post.id }}">Edit</RouterLink>
    </div>
</template>