<script setup>
import { usePage } from '@inertiajs/vue3';
import UserInfo from '../components/UserInfo.vue';
import UserPassword from '../components/UserPassword.vue';
import DeleteAccount from '../components/DeleteAccount.vue';

const page = usePage()
const user = page.props.auth.user;


</script>

<template>
    <Head title="Profile" />

    <div class="flex flex-col min-h-screen items-center justify-center px-4 mx-auto max-w-7xl">
        <section>
            <UserInfo :user="user" />
        </section>

        <section class="mt-8">
            <UserPassword />
        </section>

        <section class="mt-8">
            <DeleteAccount />
        </section>

    </div>
</template>