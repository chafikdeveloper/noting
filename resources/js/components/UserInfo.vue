<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const message = ref(null)

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
});

const handleSubmit = () => {
    form.post(route('update.information'), {
        onSuccess: () => message.value = "Information updated successfully"
    });
};
</script>

<template>
    <div class="bg-white shadow rounded-md px-8 py-4 min-w-sm">
        <h4 class="text-md font-bold">Update information</h4>

        <p v-if="message" class="bg-green-100 text-green-500 text-sm px-2 py-0.5 rounded-md mt-2">{{ message }}</p>

        <form
            @submit.prevent="handleSubmit"
            class="flex flex-col space-y-4 mt-4"
        >
            <div class="flex flex-col space-y-2">
                <label for="name" class="font-medium">Name</label>
                <input
                    type="text"
                    v-model="form.name"
                    name="name"
                    id="name"
                    class="px-2 py-1 rounded-md border border-gray-300"
                />
                <p class="text-sm text-red-500">{{ form.errors.name }}</p>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="email">Email</label>
                <input
                    type="email"
                    v-model="form.email"
                    name="email"
                    id="email"
                    class="px-2 py-1 rounded-md border border-gray-300"
                />
                <p class="text-sm text-red-500">{{ form.errors.email }}</p>
            </div>
            <div class="mt-4">
                <button
                    type="submit"
                    class="py-1 bg-blue-700 hover:bg-blue-800 rounded-md text-white font-bold w-full outline-none"
                >
                    update information
                </button>
            </div>
        </form>
    </div>
</template>
