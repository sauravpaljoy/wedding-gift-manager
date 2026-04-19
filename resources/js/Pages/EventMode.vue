<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    events: Array,
    recent_gifts: Array,
});

const form = useForm({
    event_id: props.events.length > 0 ? props.events[0].id : '',
    guest_name: '',
    phone: '',
    relation: 'Friend',
    type: 'cash',
    amount: '',
    item_name: '',
    note: '',
});

const submit = () => {
    form.post(route('gifts.store'), {
        onSuccess: () => {
            form.reset('guest_name', 'phone', 'amount', 'item_name', 'note');
            // Notification or feedback could be added here
        },
    });
};
</script>

<template>
    <Head title="Event Mode" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                🚀 Event Mode (Fast Entry)
            </h2>
        </template>

        <div class="py-6 sm:py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Entry Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
                            <div class="p-6 sm:p-8">
                                <form @submit.prevent="submit" class="space-y-6">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <!-- Event Selection -->
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Select Event</label>
                                            <select v-model="form.event_id" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-lg py-3">
                                                <option v-for="event in events" :key="event.id" :value="event.id">
                                                    {{ event.event_name }}
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Guest Name -->
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Guest Name (নাম)</label>
                                            <input v-model="form.guest_name" type="text" placeholder="Enter full name" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-lg py-3" required />
                                        </div>

                                        <!-- Phone -->
                                        <div>
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Phone</label>
                                            <input v-model="form.phone" type="tel" placeholder="017xxxxxxxx" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-lg py-3" />
                                        </div>

                                        <!-- Relation -->
                                        <div>
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Relation</label>
                                            <select v-model="form.relation" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-lg py-3">
                                                <option>Friend</option>
                                                <option>Family</option>
                                                <option>Relative</option>
                                            </select>
                                        </div>

                                        <!-- Gift Type -->
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Gift Type</label>
                                            <div class="grid grid-cols-2 gap-4">
                                                <button type="button" @click="form.type = 'cash'" :class="form.type === 'cash' ? 'bg-indigo-600 text-white shadow-lg ring-2 ring-indigo-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300'" class="py-4 rounded-xl font-bold transition-all text-center">
                                                    💵 Cash
                                                </button>
                                                <button type="button" @click="form.type = 'item'" :class="form.type === 'item' ? 'bg-indigo-600 text-white shadow-lg ring-2 ring-indigo-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300'" class="py-4 rounded-xl font-bold transition-all text-center">
                                                    🎁 Gift
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Amount (if cash) -->
                                        <div v-if="form.type === 'cash'" class="sm:col-span-2">
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Amount (৳)</label>
                                            <input v-model="form.amount" type="number" placeholder="Enter amount in BDT" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-2xl py-4 font-bold" />
                                        </div>

                                        <!-- Item Name (if item) -->
                                        <div v-if="form.type === 'item'" class="sm:col-span-2">
                                            <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Gift Item Name</label>
                                            <input v-model="form.item_name" type="text" placeholder="e.g. Dinner Set, Blender" class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-lg py-3" />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold uppercase text-gray-500 mb-2">Note (Optional)</label>
                                        <textarea v-model="form.note" rows="2" placeholder="Any special note..." class="block w-full rounded-xl border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                                    </div>

                                    <button type="submit" :disabled="form.processing" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-bold text-xl hover:bg-indigo-700 transition shadow-xl active:scale-95 disabled:opacity-50">
                                        บันทึก / Save Entry ➕
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Entries Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden h-full">
                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-4 flex items-center">
                                    <span class="mr-2">🕒</span> Recent Entries
                                </h3>
                                <div class="space-y-4">
                                    <div v-for="gift in recent_gifts" :key="gift.id" class="p-4 bg-gray-50 dark:bg-gray-750 rounded-xl border-l-4 border-indigo-500">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white">{{ gift.guest.name }}</div>
                                                <div class="text-xs text-gray-500">{{ gift.guest.relation }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="font-bold text-indigo-600">
                                                    {{ gift.type === 'cash' ? '৳ ' + gift.amount : gift.item_name }}
                                                </div>
                                                <div class="text-[10px] text-gray-400">{{ new Date(gift.created_at).toLocaleTimeString() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="recent_gifts.length === 0" class="text-center py-10 text-gray-500 italic">
                                        No entries yet today.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
