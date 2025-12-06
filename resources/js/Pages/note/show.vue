<script setup>
import { router } from '@inertiajs/vue3';

defineProps({
    note: Object,
});

const updateNote = (id) => {
    router.get(route('note.edit', id))
};

const deleteNote = (id) => {
    router.delete(route('note.delete', id))
};
</script>

<template>
    <Head :title="note.title" />
    <section class="mx-auto max-w-7xl">
        <div class="flex items-center justify-between">
            <div class="flex flex-col space-y-2">
                <div class="flex flex-col space-y-2">
                    <div class="flex">
                        <span
                            class="inline-block px-1 py-0.5 rounded-sm bg-blue-100 text-blue-800 text-xs font-normal"
                            >{{ note.category.name }}</span
                        >
                    </div>
                    <p class="text-xl font-bold">{{ note.title }}</p>
                </div>
                <p class="text-sm font-normal">{{ note.created_human }}</p>
            </div>
            <div class="flex items-center">
                <div class="flex items-center gap-4">
                    <button
                        @click="updateNote(note.id)"
                        class="text-orange-500 text-sm font-bold cursor-pointer"
                    >
                        Edit
                    </button>
                    <button
                        @click="deleteNote(note.id)"
                        class="text-red-500 text-sm font-bold cursor-pointer"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
        <div class="my-4">
            <hr />
        </div>
        <div class="max-w-7xl rounded-md shadow prose bg-white p-4" v-html="note.content"></div>
    </section>
</template>
