<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    guests: Array,
    events: Array,
});

// State for editing
const isEditing = ref(false);
const editingGuestId = ref(null);

// Form for adding/editing entries
const form = useForm({
    event_id: '',
    guest_name: '',
    phone: '',
    address: '',
    relation: 'Friend',
    type: 'cash',
    amount: '',
    item_name: '',
    note: '',
});

const submit = () => {
    if (isEditing.value) {
        form.patch(route('guests.update', editingGuestId.value), {
            onSuccess: () => {
                resetForm();
            },
        });
    } else {
        form.post(route('gifts.store'), {
            onSuccess: () => {
                resetForm();
            },
        });
    }
};

const editGuest = (guest) => {
    isEditing.value = true;
    editingGuestId.value = guest.id;
    const gift = guest.gifts[0] || {};
    
    form.event_id = guest.event_id;
    form.guest_name = guest.name;
    form.phone = guest.phone || '';
    form.address = guest.address || '';
    form.relation = guest.relation || 'Friend';
    form.type = gift.type || 'cash';
    form.amount = gift.amount || '';
    form.item_name = gift.item_name || '';
    form.note = gift.note || '';

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const deleteGuest = (id) => {
    if (confirm('Are you sure you want to delete this entry?')) {
        router.delete(route('guests.destroy', id));
    }
};

const resetForm = () => {
    isEditing.value = false;
    editingGuestId.value = null;
    form.reset();
};

// Search and Filter State
const search = ref('');
const filterType = ref('All');
const filterRelation = ref('All');
const sortBy = ref('newest');

// Computed filtered guests
const filteredGuests = computed(() => {
    let result = [...props.guests];

    // Search
    if (search.value) {
        result = result.filter(g => 
            g.name.toLowerCase().includes(search.value.toLowerCase()) || 
            (g.phone && g.phone.includes(search.value))
        );
    }

    // Filter Type
    if (filterType.value !== 'All') {
        result = result.filter(g => g.gifts[0]?.type === filterType.value.toLowerCase());
    }

    // Filter Relation
    if (filterRelation.value !== 'All') {
        result = result.filter(g => g.relation === filterRelation.value);
    }

    // Sort
    if (sortBy.value === 'highest') {
        result.sort((a, b) => (parseFloat(b.gifts[0]?.amount || 0)) - (parseFloat(a.gifts[0]?.amount || 0)));
    } else if (sortBy.value === 'newest') {
        result.sort((a, b) => b.id - a.id);
    }

    return result;
});

// Auto Calculations
const totalCash = computed(() => {
    return props.guests.reduce((sum, g) => {
        const gift = g.gifts[0];
        return gift?.type === 'cash' ? sum + parseFloat(gift.amount || 0) : sum;
    }, 0);
});

const totalGifts = computed(() => {
    return props.guests.filter(g => g.gifts[0]?.type === 'item').length;
});
</script>

<template>
    <Head title="Guest Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    📋 Guest Management
                </h2>
                <div class="space-x-2">
                    <button @click="window.print()" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition">📄 Export PDF</button>
                    <a :href="route('export.csv')" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition">📊 Export Excel</a>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                
                <!-- 📊 Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-b-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-500 uppercase">Total Guests</div>
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ guests.length }}</div>
                            </div>
                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full text-blue-600">👥</div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-b-4 border-emerald-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-500 uppercase">Total Cash</div>
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">৳ {{ totalCash.toLocaleString() }}</div>
                            </div>
                            <div class="p-3 bg-emerald-100 dark:bg-emerald-900 rounded-full text-emerald-600">💰</div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-b-4 border-amber-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-500 uppercase">Total Gifts</div>
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ totalGifts }}</div>
                            </div>
                            <div class="p-3 bg-amber-100 dark:bg-amber-900 rounded-full text-amber-600">🎁</div>
                        </div>
                    </div>
                </div>

                <!-- 1. Guest Entry Form -->
                <div :class="isEditing ? 'border-2 border-indigo-500' : ''" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm transition-all">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold flex items-center">
                            <span class="mr-2">{{ isEditing ? '✏️ Edit Guest Entry' : '✍️ Add Guest Entry' }}</span>
                        </h3>
                        <button v-if="isEditing" @click="resetForm" class="text-sm text-gray-500 hover:text-gray-700">Cancel Edit</button>
                    </div>
                    <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Event</label>
                            <select v-model="form.event_id" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                                <option value="" disabled>Select Event</option>
                                <option v-for="event in events" :key="event.id" :value="event.id">{{ event.event_name }}</option>
                            </select>
                        </div>
                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Name (নাম)</label>
                            <input v-model="form.guest_name" type="text" placeholder="Guest Name" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required />
                        </div>
                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Phone</label>
                            <input v-model="form.phone" type="text" placeholder="017xxxxxxxx" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>
                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Relation</label>
                            <select v-model="form.relation" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <option>Friend</option>
                                <option>Family</option>
                                <option>Relative</option>
                            </select>
                        </div>
                        
                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Gift Type</label>
                            <select v-model="form.type" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <option value="cash">Cash</option>
                                <option value="item">Gift</option>
                            </select>
                        </div>

                        <div v-if="form.type === 'cash'" class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Amount (৳)</label>
                            <input v-model="form.amount" type="number" placeholder="৳" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>
                        <div v-else class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Gift Name</label>
                            <input v-model="form.item_name" type="text" placeholder="e.g. Dinner Set" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div class="col-span-1 md:col-span-1">
                            <label class="text-xs font-bold uppercase text-gray-500">Note</label>
                            <input v-model="form.note" type="text" placeholder="Optional" class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div class="col-span-1 flex items-end">
                            <button type="submit" :disabled="form.processing" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition disabled:opacity-50">
                                {{ isEditing ? '💾 Update Entry' : '➕ Add Entry' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 🔍 Smart Filter + Search -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm flex flex-wrap gap-4 items-center">
                    <div class="flex-grow min-w-[200px]">
                        <input v-model="search" type="text" placeholder="🔎 Search Name / Phone..." class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" />
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-bold text-gray-500">🎯 Filter:</span>
                        <select v-model="filterType" class="text-sm rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            <option>All</option>
                            <option>Cash</option>
                            <option>Gift</option>
                        </select>
                        <select v-model="filterRelation" class="text-sm rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            <option>All</option>
                            <option>Family</option>
                            <option>Friend</option>
                            <option>Relative</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-bold text-gray-500">💰 Sort:</span>
                        <select v-model="sortBy" class="text-sm rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            <option value="newest">Newest First</option>
                            <option value="highest">Highest Amount ↓</option>
                        </select>
                    </div>
                </div>

                <!-- 📋 Data Table -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900 border-b dark:border-gray-700">
                            <tr>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Name</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Phone / Relation</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Gift Type</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Amount / Gift</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            <tr v-for="guest in filteredGuests" :key="guest.id" class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ guest.name }}</div>
                                    <div class="text-xs text-gray-400">{{ guest.event?.event_name }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-sm text-gray-600 dark:text-gray-300">{{ guest.phone || 'N/A' }}</div>
                                    <div class="text-xs text-indigo-500 font-semibold">{{ guest.relation }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span :class="guest.gifts[0]?.type === 'cash' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'" class="px-2 py-1 rounded text-[10px] font-bold uppercase">
                                        {{ guest.gifts[0]?.type }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div v-if="guest.gifts[0]?.type === 'cash'" class="font-bold text-gray-900 dark:text-white">৳ {{ guest.gifts[0]?.amount }}</div>
                                    <div v-else class="font-bold text-gray-900 dark:text-white">{{ guest.gifts[0]?.item_name }}</div>
                                    <div class="text-[10px] italic text-gray-400">{{ guest.gifts[0]?.note }}</div>
                                </td>
                                <td class="py-4 px-6 space-x-3">
                                    <button @click="editGuest(guest)" class="text-blue-500 hover:text-blue-700 transition">✏️</button>
                                    <button @click="deleteGuest(guest.id)" class="text-red-500 hover:text-red-700 transition">🗑</button>
                                </td>
                            </tr>
                            <tr v-if="filteredGuests.length === 0">
                                <td colspan="5" class="py-20 text-center text-gray-500">
                                    <div class="text-4xl mb-4">🏜</div>
                                    No entries match your search or filters.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
