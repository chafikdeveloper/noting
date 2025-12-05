<script setup>
import { useForm } from '@inertiajs/vue3';

defineOptions({
    layout: null
})

const form = useForm({
    remember: false,
    email: null,
    password: null
})

const handleSubmit = () => {
    form.post(route('login'), {
        onError: () => form.reset('password'),
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="Login" />
    
    <div class="flex flex-col min-h-screen items-center justify-center px-4">
        <div class="bg-white px-8 py-4 shadow rounded-md flex flex-col min-w-sm mx-auto">
            <div class="flex flex-col text-center">
                <h1 class="text-2xl font-bold ">Login into your account</h1>
                <p class="text-sm font-semibold">Provide your information to continue</p>
            </div>

            <form @submit.prevent="handleSubmit"
                class="flex flex-col space-y-4 mt-8"
            >
                <div class="flex flex-col space-y-2">
                    <label for="email" class="font-medium">Email</label>
                    <input type="email" v-model="form.email" name="email" id="email" class="px-1.5 py-1 rounded-sm border border-gray-300">
                    <p v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</p>
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="password">Password</label>
                    <input type="password" v-model="form.password" name="password" id="password" class="px-1.5 py-1 rounded-sm border border-gray-300">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" v-model="form.remember" name="remember" id="remember" />
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-1 rounded-md mt-4">Login</button>
                <p class="text-sm text-center">
                    Don't have an account ? 
                    <Link :href="route('register')" class="underline hover:text-blue-800">register</Link>
                </p>
            </form>
        </div>
    </div>
</template>