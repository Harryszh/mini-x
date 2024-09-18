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

    <div class="main">
        <div class="title-container">
            <p>FEED VON</p>
            <h1>Welcome, {{ authUser.name }}</h1>
            <!-- <button @click="handleLogout">Logout</button> -->
        </div>

        <div class="tweet-box" v-for="post in posts" :key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.content }}</p>
            <RouterLink :to="{name: 'post-edit', params:{ id: post.id }}">Tweet ansehen</RouterLink>
        </div>
    </div>

    
</template>

<style scoped>
    .main{
        background-color: #F1F1F1;;
        padding-bottom: 302px;
    }
    .title-container{
        display: flex;
        flex-direction: column;
        padding-left: 372px;   
        padding-top: 81px;
        
    }
    .tweet-box{
        background-color: #FFFF;
        margin-left: 372px;
        margin-right: 372px;

        
       /*  padding-left: 372px; 
        padding-right: 372px ;
        padding-bottom: 302px; */
    }
        
</style>