<script setup>
import { RouterLink, RouterView } from "vue-router";

import HeaderComponent from "./src/components/HeaderComponent.vue";
import { useAuthStore } from "./store/AuthStore";
import { storeToRefs } from "pinia";
const {authUser} = storeToRefs(useAuthStore())
</script>

<template>
    
    <HeaderComponent/>
   

    <div>Mini X <br>
        Hallo {{ $name }}
    </div>
    <!-- RouterView zeigt den jeweiligen View basierend auf der aktuellen Route an -->
    <RouterView />
</template>