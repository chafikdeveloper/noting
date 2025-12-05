<script setup>
import TipTap from '../components/TipTap.vue';
import { Form } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Create Note" />

    <Form class="flex flex-col space-y-4 px-28">
        <div class="flex flex-col space-y-2">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="bg-white border border-gray-400 rounded-md py-2 px-4 outline-none" />
        </div>
        <div class="flex flex-col space-y-2">
            <label for="message">Message</label>
            <TipTap id="message"/>
        </div>

        <button type="submit" class="mt-4 bg-blue-800 py-2 rounded-2xl text-white font-bold">Create Note</button>
    </Form>
</template>