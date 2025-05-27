<script setup lang="ts">
import ChatSupport from '@/components/ChatSupport.vue';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Navbar />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
        <ChatSupport />
    </div>
</template>