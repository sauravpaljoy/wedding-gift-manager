<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                📊 Dashboard Summary
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-indigo-500">
                        <div class="text-sm font-medium text-gray-500 uppercase">Total Cash Received</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">৳ {{ stats.total_cash.toLocaleString() }}</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-emerald-500">
                        <div class="text-sm font-medium text-gray-500 uppercase">Total Gift Items</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.total_items }}</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-amber-500">
                        <div class="text-sm font-medium text-gray-500 uppercase">Total Guests</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ stats.total_guests }}</div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in! Click on <strong>Event Mode</strong> to start recording gifts.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
