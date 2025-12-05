<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showInput = ref(false);

const form = useForm({
    password: null
})

const handleSubmit = () => {

}
</script>

<template>
    <div class="bg-white shadow rounded-md px-8 py-4 min-w-sm">
        <h4 class="text-md font-bold">Delete Account</h4>
        <p class="text-md">This action can not be undone</p>

        <button
            v-if="!showInput"
            @click="showInput = true"
            class="bg-red-500 hover:bg-red-600 text-white font-bold rounded-md px-2 py-1 mt-6"
        >
            Delete Account
        </button>

        <div v-if="showInput" class="mt-6">
            <form @submit.prevent="handleSubmit" class="flex flex-col space-y-2">
                <label for="password" class="font-medium">Enter your Password</label>
                <input type="password" v-model="form.password" name="password" id="password" class="px-2 py-1 border border-gray-300 rounded-md" />

                <button
                    type="submit"
                    class="bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-md px-2 py-1 mt-2"
                >
                    Confirm
                </button>
            </form>
        </div>
    </div>
</template>
