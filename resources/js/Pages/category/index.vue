<script setup>
import { router } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
defineProps({
    categories: Array
})

const createCategory = () => {
    router.get(route('category.create'));
}

const deleteCategory = (id) => {
    router.delete(route('category-delete', id));
}
</script>

<template>
    <Head title="Categories" />

    <div class="flex items-center justify-between">
        <h1 class="text-2xl text-center font-bold">Category list</h1>
        <button @click="createCategory"
         class="flex items-center gap-2 bg-blue-800 text-white px-1.5 py-1 rounded-sm">
            Create Category
            <Plus :size="16" />
        </button>
    </div>

    <div
        v-if="categories?.length > 0"
        class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
    >
        <div class="flex flex-col space-y-2 bg-white rounded-md shadow px-4 py-2" v-for="category in categories" :key="category.id">
            <h5 class="text-lg font-semibold">{{ category.name }}</h5>
            <div class="flex justify-end gap-4">
                <Link :href="route('category.update', category?.id)">
                    <button class="text-orange-500 font-semibold text-md cursor-pointer">Edit</button>
                </Link>
                <button @click="deleteCategory(category.id)"
                    class="text-red-500 font-semibold text-md cursor-pointer"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
    <div v-else>
        <p class="text-center text-lg font-semibold mt-16">You don't have any categories created yet. Try to create one first</p>
    </div>

</template>