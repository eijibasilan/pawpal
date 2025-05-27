<script setup lang="ts">
import { ref } from 'vue';
import { MessageCircle, X } from 'lucide-vue-next';

const showChat = ref(false);
const messages = ref([]);

const toggleChat = () => {
    showChat.value = !showChat.value;
};
</script>

<template>
    <div class="fixed bottom-6 right-6 z-[9999]">
        <!-- Chat Button -->
        <button 
            @click="toggleChat"
            class="rounded-full w-16 h-16 bg-primary hover:bg-primary/90 shadow-lg flex items-center justify-center text-white transition-all duration-300"
        >
            <MessageCircle v-if="!showChat" class="w-8 h-8" />
            <X v-else class="w-8 h-8" />
        </button>

        <!-- Chat Window -->
        <div 
            v-show="showChat" 
            class="absolute bottom-20 right-0 w-96 bg-white rounded-lg shadow-2xl border"
        >
            <div class="p-4 bg-primary text-white rounded-t-lg">
                <h3 class="text-lg font-semibold">Chat Support</h3>
                <p class="text-sm opacity-90">We're here to help!</p>
            </div>

            <div class="h-[400px] overflow-y-auto p-4">
                <div class="flex flex-col space-y-4">
                    <div class="bg-gray-100 p-3 rounded-lg self-start max-w-[80%]">
                        <p class="text-sm">Hello! How can we help you today?</p>
                    </div>
                </div>
            </div>

            <div class="p-4 border-t bg-white rounded-b-lg">
                <form class="flex gap-2">
                    <input 
                        type="text"
                        placeholder="Type your message..."
                        class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50"
                    >
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors"
                    >
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>