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
            <div class="box">
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
        
                    <div class="button-container">
                        <button class="button">Tweet speichern</button>
                    </div>
                </div>
            </div>
        </form>
    </div> 
    </div>   
</template>

<style scoped>
    .form-group{
        display: flex;
        /* justify-content: center; */
        align-items: center;
    }
    .main{
        background-color: #F1F1F1;
        
    }
    .box{
        display: flex;
        flex-direction: column;
    }
    .container{
        display: flex;
        
        flex-direction: column;
        
        margin-left: 372px;
        margin-right: 372px;
        padding-bottom: 439px;
    }
    .tweet-container{
        background-color: #FFFF;
        
        
    }
    .form-group{
        padding-top: 64px;
        font-size: 24px;
        

        display: flex;
        flex-direction: column;
    }
    .placeholderOne{
    height: 56px;
        width: 881px;
        
       
    }
    .placeholder2{
        height: 152px;
        width: 881px;
        
    }
    .button-container{
        padding-top: 31px;
        padding-left: 48px;
        padding-bottom: 26px;
    }
    
    .button{
        background: #1D9BF0;
        border-radius: 8px;
        width: 140px;
        height: 38px;
        color: #FFFF;
        border: none;

        
        


    }

    
</style>