<script setup>
    import { RouterLink } from 'vue-router';


</script>

<template>
    <div class="box">
        <div>
            <h3 class="text">Mini - X</h3>
        </div>
        <div class="link">
        <RouterLink :to="{name: 'post-create'}" v-if="!authUser">
            <button class="button">+ Create Post</button>
        </RouterLink>
</div>
    </div>
    
</template>

<style scoped>
    .box{
        background-color: FFFF;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        
        
        
    }
    h3{
        font-size: 32px;
    }
    .link{
        display: flex;
        align-items: center;
    }
    .text{
        margin-left: 174px;
        margin-top: 29px;
        margin-bottom: 29px;

    }

    .button{
        background-color: #1D9BF0;
        color: azure;
        margin-right: 152px;
        border-radius: 50px;
        font-size: 24px;
    }

</style>