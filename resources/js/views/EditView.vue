<script setup>
import { ref, onMounted } from 'vue'
import { authClient } from '@/store/AuthStore';
import router from "@/router"
import PostDeleteButton from '@/src/components/Button/PostDeleteButton.vue';

import { useRoute } from 'vue-router'



const route = useRoute()
const post_id = route.params.id 

const title = ref("")
const content = ref("")

const post = ref({})

const alertMessage = ref("")

const getPosts = async (id) => {
    const res = await authClient.get(`/api/posts/${id}`)
    post.value = res.data
    title.value = post.value.title
    content.value = post.value.content
}

onMounted(()=>{
    getPosts(post_id)
})

const handleUpdate = async (id) => {
    try{
        const res = await authClient.put(`/api/posts/${id}`, {
            title: title.value,
            content: content.value
        })

        if(res.status == 200) {
            // alertMessage.value = "Dein Beitrag wurde upgedated!"
            // router.push("/dashboard")
            router.push({name: "dashboard"})
        }

    }catch(e){
        alert("Etwas ist schief gelaufen")
        console.log(e)
    }
}
</script>
<template>
<div class="main">
    <div v-if="alertMessage">{{ alertMessage }}</div>
    <form method="POST" @submit.prevent="handleUpdate(post_id)">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" v-model="title" />
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" v-model="content"></textarea>
        </div>
        <button>Update Post</button>
        <PostDeleteButton type="button" :post_id="post_id"/>
    </form>
</div>
</template>

<style scoped>
    .main{
        background-color: #F9F9F9;
        
    }    
</style>