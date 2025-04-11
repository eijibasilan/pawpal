<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="flex min-h-[50px] justify-end border-b-2">
        <div class="m-3">
            <Link :href="$page.props.auth.admin ? '/admin/dashboard' : '/admin/login'">
                <Button variant="link">Login</Button>
            </Link>
        </div>
    </nav>

    <!-- Write your code below -->
</template>

<style scoped>
/* Write CSS below */
</style>
