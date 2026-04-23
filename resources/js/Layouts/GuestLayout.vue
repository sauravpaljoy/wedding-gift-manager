<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    maxWidth: {
        type: String,
        default: 'sm:max-w-md',
    },
});
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-[#f9fafb] px-4 py-8 sm:justify-center sm:px-0 sm:py-0"
    >
        <div class="mb-6 sm:mb-8">
            <Link href="/">
                <ApplicationLogo class="w-auto h-12 sm:h-16" />
            </Link>
        </div>

        <div
            :class="['w-full bg-white px-6 py-8 sm:px-10 shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-gray-100 rounded-2xl sm:rounded-3xl', maxWidth]"
        >
            <slot />
        </div>
    </div>
</template>
