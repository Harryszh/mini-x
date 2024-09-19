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
    <div class="box">   
            <div v-if="alertMessage">{{ alertMessage }}</div>
                <form method="POST" @submit.prevent="handleUpdate(post_id)">
            
            <div class="title">
                <h1>Tweet bearbeiten</h1>
            </div>
        <div class="container">
            <div class="form-group">
                <label class="tweet-text" for="title">Titel:</label>
                <input class="placeholder-one" type="text" id="title" name="title" v-model="title" />
            </div>
        
            <div class="form-group">
                <label class="tweet-text" for="content">Text:</label>
                <textarea class="placeholder-2" id="content" name="content" v-model="content"></textarea>
            </div>
            <div class="button-container">
                <button class="button">Tweet updaten</button>
        
                <PostDeleteButton class="button" type="button" :post_id="post_id"/>
            </div>
        </div>
        </form>
    </div> 
</div>
</template>

<style scoped>
    .main{
        background-color: #F9F9F9;
        
    } 
    .box{
        padding-bottom: 391px;


    } 
    .title{
        display: flex;
        justify-content: center;
        padding-top: 108px;
        
    }  
    .container{
        background-color: #FFFF;
        margin-left: 372px;
        margin-right: 372px;

        display: flex;
        justify-content: center;
        flex-direction: column;
        
        
    }
    .placeholder-one{
        height: 56px;
       
    }
    .placeholder-2{
        height: 152px;
    }
    .tweet-text{
        padding-left: 15px;
    }
    .form-group{
        display: flex;
        flex-direction: column;
        margin-left: 40px;
        margin-right: 40px;
        font-size: 24px;
        padding-top: 44px;
        

    }
    .button-container{
        display: flex;
        justify-content: space-between;
        padding-top: 31px;
        padding-bottom: 26px;

    }
    .button{
        background: #1D9BF0;
        margin-left: 40px;
        margin-right: 40px;
        border: none;
        font-size: 18px;
        border-radius: 8px;
        color: white;


    }
</style>