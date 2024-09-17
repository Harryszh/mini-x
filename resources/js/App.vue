<script setup>
import { RouterLink, RouterView } from "vue-router";


import HeaderComponent from "./src/components/MiniHeader.vue";
/* import LoginView from "./js/views/LoginView.vue"; */
import MiniFooter from "./src/components/MiniFooter.vue";

import { useAuthStore } from "./store/AuthStore";
import { storeToRefs } from "pinia";

const {authUser} = storeToRefs(useAuthStore())
</script>

<template>
    
    <HeaderComponent/>
   

   
    <!-- RouterView zeigt den jeweiligen View basierend auf der aktuellen Route an -->
    <RouterView />

    <div class="footer-box">
        <MiniFooter/>
    </div>
</template>

<style scoped>
     html, body, #app {
        height: 100%; /* Stelle sicher, dass die Höhe des Viewports genutzt wird */
        margin: 0;
        padding: 0;
    }
    h1{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /* .box-main{
        height: 1094px;
        background-color:  #F9F9F9;
        ;
    } */
    /* .footer-box{
        
    }  */  
      
</style>