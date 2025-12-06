<script setup>
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const {search} = route().params

const searchTerm = ref(search);

defineProps({
    notes: Array,
});

const updateNote = (id) => {
    router.get(route("note.edit", id));
};

const deleteNote = (id) => {
    router.delete(route("note.delete", id));
};

let debounceTimer = null;

watch(searchTerm, (value) => {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        router.get(route("home"), { search: value }, {
            preserveState: true,
            preserveScroll: true,
            replace: true,   // keeps history clean
        });
    }, 400); // 400ms debounce
});
</script>

<template>
    <Head title="Home" />

    <div class="flex justify-center my-4 ">
            <input
                type="search"
                name="search"
                id="search"
                v-model="searchTerm"
                placeholder="search"
                class="px-2 py-2 rounded-md border border-gray-400 bg-white outline-none"
            />
    </div>

    <div v-if="notes?.length > 0" class="mt-16">
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto"
        >
            <Link
                v-for="note in notes"
                :key="note.id"
                :href="route('note.show', note.id)"
            >
                <div class="px-8 py-4 rounded-md shadow bg-white">
                    <span
                        class="inline-block px-1 py-0.5 rounded-sm bg-blue-100 text-blue-800 text-xs font-normal"
                        >{{ note.category.name }}</span
                    >
                    <p class="font-bold text-lg line-clamp-2 mt-2">
                        {{ note.title }}
                    </p>
                    <div class="flex items-center justify-between gap-4 mt-4">
                        <p class="text-sm font-medium">
                            {{ note.created_human }}
                        </p>
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
            </Link>
        </div>
    </div>

    <div v-else class="flex flex-col max-h-screen items-center mt-16">
        <p>
            There are no notes for the moments.
            <Link>Try create one first</Link>
        </p>
    </div>
</template>
