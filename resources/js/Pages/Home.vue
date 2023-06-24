<template>
    <section class="min-h-screen bg-stone-300 relative">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('pins')" class="text-sm text-gray-700 dark:text-gray-500 underline">Pins</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>

        <div class="flex w-full container mx-auto flex-col py-10 gap-10">
            <h1 class="text-3xl">Pins</h1>

            <div v-for="pin in pins" :key="pin.id" class="bg-white px-5 py-2 rounded-md">
                <h1 class="pb-5">by: <span class="font-semibold text-indigo-600">{{ pin.user_name }}</span></h1>
                <h1 class="text-xl font-bold">{{ pin.title }}</h1>
                <p>{{ pin.description }}</p>
            </div>
        </div>
    </section>
</template>

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