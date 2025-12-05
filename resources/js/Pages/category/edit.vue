<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object
})

const form = useForm({
    name: props.category?.name
})

const handleSubmit = () => {
    form.patch(route('category.update', props.category?.id), {
        onFinish: () => form.reset(),
    })
}
</script>

<template>
    <Head title="Edit Category" />
    <div class="flex justify-center mt-8 px-4">
        <div class="bg-white rounded-md shadow px-8 py-4 w-sm">
            <h1 class="text-lg text-center font-bold">Update Category</h1>
            <form @submit.prevent="handleSubmit" class="flex flex-col space-y-4 mt-4">
                <div class="flex flex-col space-y-2">
                    <label for="name" class="font-semibold">Name</label>
                    <input v-model="form.name" type="text" name="name" id="name" class="border rounded-sm px-2 py-1">
                    <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
                </div>
                <div class="flex justify-center mt-2">
                    <button type="submit" class="bg-blue-800 w-full py-1 text-white font-bold rounded-md">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</template>