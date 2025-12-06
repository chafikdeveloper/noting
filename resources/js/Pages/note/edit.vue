<script setup>
import { useForm } from "@inertiajs/vue3";
import TipTap from "../../components/TipTap.vue";

const props = defineProps({
    categories: Array,
    note: Object,
});

const form = useForm({
    title: props.note.title,
    category_id: props.note.category_id,
    content: props.note.content,
});

const handleSubmit = () => {
    form.patch(route("note.edit", props.note.id), {
        onSuccess: () => form.reset(),
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Update Note" />

    <form @submit.prevent="handleSubmit" class="flex flex-col space-y-4 px-28">
        <div class="flex flex-col space-y-2">
            <label for="title" class="font-medium">Title</label>
            <input
                type="text"
                v-model="form.title"
                name="title"
                id="title"
                class="bg-white border border-gray-400 rounded-md py-2 px-4 outline-none"
            />
            <p class="text-sm text-red-500">{{ form.errors.title }}</p>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="categories" class="font-medium">Select an option</label>
            <select
                id="categories"
                v-model="form.category_id"
                class="block bg-white px-3 py-2.5 border border-gray-400 rounded-md text-sm outline-none"
            >
                <option disabled>Choose a category</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
            <p class="text-sm text-red-500">{{ form.errors.category_id }}</p>
        </div>

        <div class="flex flex-col space-y-2">
            <label class="font-medium">Message</label>
            <TipTap v-model="form.content" />
            <p class="text-sm text-red-500">{{ form.errors.content }}</p>
        </div>

        <button
            type="submit"
            class="mt-4 bg-blue-800 py-2 rounded-md text-white font-bold"
        >
            Update Note
        </button>
    </form>
</template>
