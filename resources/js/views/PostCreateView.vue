<script setup>
import { ref } from 'vue'
import { authClient } from '../store/AuthStore';
import router from '../router';

const title = ref("")
const content = ref("")

const alertMessage = ref ("")

const handleCreate = async () => {
    try{
        const res = await authClient.post("/api/posts",{
            title: title.value,
            content: content.value
        })
        if(res.status == 201) router.push({name:"dashboard"})
    
    }catch(e){
        alert("Etwas ist schief gelaufen!")
        console.log(e)
    }
}

</script>

<template>
    
        <div v-if="alertMessage">{{ alertMessage }}</div>
    
    <form method="POST" @submit.prevent="handleCreate">
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" v-model="title">
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" v-model="content"></textarea>
        </div>
        <button>Create Post</button>
    </form>    
</template>

<style>
    .form-group{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    
</style>