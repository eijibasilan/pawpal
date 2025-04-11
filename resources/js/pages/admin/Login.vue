<template>
    <div class="flex h-[100vh] w-full items-center justify-center">
        <Card class="w-[350px]">
            <CardHeader>
                <CardTitle>Hello Admin!</CardTitle>
                <CardDescription>Please login you credentials below.</CardDescription>
            </CardHeader>
            <form @submit.prevent="submit">
                <CardContent>
                    <div class="grid w-full items-center gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="email"
                                v-model="form.email"
                                placeholder="Enter your email"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                required
                                :tabindex="2"
                                autocomplete="current-password"
                                v-model="form.password"
                                placeholder="Enter your password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                        <div class="flex items-center justify-between" :tabindex="3">
                            <Label for="remember" class="flex items-center space-x-3">
                                <Checkbox id="remember" v-model="form.remember" :tabindex="4" />
                                <span>Remember me</span>
                            </Label>
                        </div>
                    </div>
                </CardContent>
                <CardFooter class="flex justify-between px-6 pb-6">
                    <Button type="submit" :tabindex="4" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Log in
                    </Button>
                </CardFooter>
            </form>
        </Card>
    </div>
</template>

<script lang="ts" setup>
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/admin/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>
