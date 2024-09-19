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
    <div class="main">
        <div v-if="alertMessage">{{ alertMessage }}</div>
    <div class="container">
        <form method="POST" @submit.prevent="handleCreate">
            <div >
                <div>
                    <h1>Tweet erstellen</h1>
                </div>
                <p>
                    Was möchtest Du mitteilen?
                </p>
                <div class="tweet-container">
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input class="placeholderOne" type="text" id="title" name="title" v-model="title">
                    </div>
        
                    <div class="form-group">
                        <label for="content">Text</label>
                        <textarea class="placeholder2" id="content" name="content" v-model="content"></textarea>
                    </div>
        
                    <button class="button">Tweet speichern</button>
                </div>
            </div>
        </form>
    </div> 
    </div>   
</template>

<style scoped>
    .form-group{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .main{
        background-color: #F1F1F1;
        

    }
    .container{
        display: flex;
        justify-content: center;
        
        margin-left: 372px;
        margin-right: 372px;
        padding-bottom: 439px;
    }
    .tweet-container{
        background-color: #FFFF;
        display: flex;
        flex-direction: column;
        
        
    }
    .form-group{
        padding-top: 64px;
        font-size: 24px;
    }
    .placeholderOne{
        height: 56px;
        width: 681px;
        
       
    }
    .placeholder2{
        height: 152px;
        width: 681px;
        
    }
    
    .button{
        background: #1D9BF0;
        border-radius: 8px;
        width: 140px;
        height: 38px;
        color: #FFFF;
        


    }

    
</style>