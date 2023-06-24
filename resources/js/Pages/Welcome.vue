<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pins: {
        Type: Object,
        default: () => {}
    }
});
</script>

<template>
    <Head title="Welcome" />

    <div class="h-screen bg-black dark:bg-black">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('pins')" class="text-sm text-gray-700 dark:text-gray-500 underline">Pins</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>

    <section class="text-white w-full">
        <h1 class="text-9xl">Pins</h1>

        <div v-for="pin in pins" :key="pin">
            <h1>{{pin.title}}</h1>
        </div>


    </section>
    </div>
</template>
