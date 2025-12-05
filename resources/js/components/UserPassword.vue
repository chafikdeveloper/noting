<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    current_password: null,
    new_password: null,
    new_password_confirmation: null
})

const message = ref(null)

const handleSubmit = () => {
    form.post(route('update.password'), {
        onError: () => form.reset(),
        onSuccess: () => {
            form.reset(),
            message.value = 'password updated successfully'
        }
    })
}
</script>

<template>
    <div class="bg-white shadow rounded-md px-8 py-4 min-w-sm">
        <h4 class="text-md font-bold">Update password</h4>
        <p v-if="message" class="bg-green-100 text-green-500 text-sm px-2 py-0.5 rounded-md mt-2">{{ message }}</p>

        <form
            @submit.prevent="handleSubmit"
            class="flex flex-col space-y-4 mt-4"
        >
            <div class="flex flex-col space-y-2">
                <label for="current_password" class="font-medium">Current Password</label>
                <input
                    type="password"
                    v-model="form.current_password"
                    name="password"
                    id="password"
                    class="px-2 py-1 rounded-md border border-gray-300"
                />
                <p class="text-sm text-red-500">{{ form.errors.current_password }}</p>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="new_password" class="font-medium">New Password</label>
                <input type="password" v-model="form.new_password" name="new_password" id="new_password" class="px-2 py-1 rounded-md border border-gray-300">
                <p class="text-sm text-red-500">{{ form.errors.new_password }}</p>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input
                    type="password"
                    v-model="form.new_password_confirmation"
                    name="new_password_confirmation"
                    id="new_password_confirmation"
                    class="px-2 py-1 rounded-md border border-gray-300"
                />
            </div>
            <div class="mt-4">
                <button
                    type="submit"
                    class="py-1 bg-blue-700 hover:bg-blue-800 rounded-md text-white font-bold w-full"
                >
                    update password
                </button>
            </div>
        </form>
    </div>
</template>