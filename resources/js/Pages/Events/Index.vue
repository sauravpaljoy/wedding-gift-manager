<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    events: Array,
});

const form = useForm({
    event_name: '',
    event_date: '',
    location: '',
});

const submit = () => {
    form.post(route('events.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                🎉 Manage Events
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <!-- Create Event Form -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Create New Event</h3>
                    <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div class="md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Event Name</label>
                            <input v-model="form.event_name" type="text" placeholder="e.g. Wedding" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required />
                        </div>
                        <div class="md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Date</label>
                            <input v-model="form.event_date" type="date" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required />
                        </div>
                        <div class="md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Location</label>
                            <input v-model="form.location" type="text" placeholder="Optional" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>
                        <div class="md:col-span-1">
                            <button type="submit" :disabled="form.processing" class="w-full py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">
                                ➕ Create Event
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Events List -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900 border-b dark:border-gray-700">
                            <tr>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Event Name</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Date</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Location</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            <tr v-for="event in events" :key="event.id">
                                <td class="py-4 px-6 font-bold">{{ event.event_name }}</td>
                                <td class="py-4 px-6">{{ event.event_date }}</td>
                                <td class="py-4 px-6 text-gray-500">{{ event.location || 'N/A' }}</td>
                            </tr>
                            <tr v-if="events.length === 0">
                                <td colspan="3" class="py-10 text-center text-gray-500 italic">No events created yet. Create one above to start adding gifts!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
