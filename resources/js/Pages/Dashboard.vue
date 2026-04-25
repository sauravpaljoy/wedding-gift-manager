<script setup>
import SPTechBDLayout from '@/Layouts/SPTechBDLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    stats: Object,
    recent_gifts: Array,
});

const giftType = ref('cash');
const editingGuestId = ref(null);

const form = useForm({
    guest_name: '',
    address: '',
    relation: 'Family',
    type: 'cash',
    amount: '',
    item_name: '',
    note: '',
});

const submit = () => {
    form.type = giftType.value;
    if (editingGuestId.value) {
        form.patch(route('guests.update', editingGuestId.value), {
            onSuccess: () => {
                form.reset();
                editingGuestId.value = null;
            },
        });
    } else {
        form.post(route('gifts.store'), {
            onSuccess: () => form.reset('guest_name', 'address', 'amount', 'item_name', 'note'),
        });
    }
};

const editEntry = (gift) => {
    editingGuestId.value = gift.guest_id;
    giftType.value = gift.type;
    form.guest_name = gift.guest?.name || '';
    form.address = gift.guest?.address || '';
    form.relation = gift.guest?.relation || 'Family';
    form.type = gift.type;
    form.amount = gift.amount || '';
    form.item_name = gift.item_name || '';
    form.note = gift.note || '';
    
    // Scroll to form
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const cancelEdit = () => {
    editingGuestId.value = null;
    form.reset();
};

const search = ref('');
const filterType = ref('All types');
const filterRelation = ref('All relations');

const filteredGifts = computed(() => {
    let result = [...(props.recent_gifts || [])];
    if (search.value) result = result.filter(g => g.guest?.name?.toLowerCase().includes(search.value.toLowerCase()) || g.guest?.address?.toLowerCase().includes(search.value.toLowerCase()));
    if (filterType.value !== 'All types') result = result.filter(g => g.type === filterType.value.toLowerCase());
    if (filterRelation.value !== 'All relations') result = result.filter(g => g.guest?.relation === filterRelation.value);
    return result;
});

const deleteEntry = (guestId) => {
    if (confirm('Delete this entry?')) router.delete(route('guests.destroy', guestId));
};

const formatDate = (d) => {
    const date = new Date(d);
    return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' }) + ', ' + date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
};

const downloadPdf = () => {
    window.print();
};
</script>

<template>
    <Head title="Dashboard – SP Tech BD" />
    <SPTechBDLayout>
        <template #title>Dashboard</template>
        <template #subtitle>Track every guest, gift and blessing 🌸</template>
        
        <!-- Summary Cards -->
        <div class="stats-grid mb">
            <div class="stat-card" style="--c:#a855f7">
                <div><div class="sl">TOTAL GUESTS</div><div class="sv">{{ stats?.total_guests ?? 0 }}</div><div class="sd">entries</div></div>
                <div class="si" style="background:#f3e8ff"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
            </div>
            <div class="stat-card" style="--c:#059669">
                <div><div class="sl">TOTAL CASH</div><div class="sv">৳ {{ Number(stats?.total_cash??0).toLocaleString() }}</div><div class="sd">received</div></div>
                <div class="si" style="background:#d1fae5"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
            </div>
            <div class="stat-card" style="--c:#ec4899">
                <div><div class="sl">CASH ENTRIES</div><div class="sv">{{ stats?.cash_contributors_count ?? 0 }}</div><div class="sd">contributors</div></div>
                <div class="si" style="background:#fce7f3"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ec4899" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg></div>
            </div>
            <div class="stat-card" style="--c:#d97706">
                <div><div class="sl">TOTAL ITEMS</div><div class="sv">{{ stats?.total_items ?? 0 }}</div><div class="sd">physical gifts</div></div>
                <div class="si" style="background:#fef3c7"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/></svg></div>
            </div>
        </div>

        <div class="quick-card no-print">
            <div class="qh">
                <div class="qh-left">
                    <div class="pulse-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div>
                    <div>
                        <div class="qt">{{ editingGuestId ? 'Update Entry' : 'Quick Add' }}</div>
                        <div class="qs">Event mode — Enter চাপলেই next field</div>
                    </div>
                </div>
                <div class="type-toggle">
                    <button :class="['tb', giftType==='cash'?'tb-on':'']" @click="giftType='cash'" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        Cash
                    </button>
                    <button :class="['tb', giftType==='item'?'tb-on':'']" @click="giftType='item'" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                        Item
                    </button>
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="fg">
                    <div class="fi">
                        <label class="fl">নাম (Name)</label>
                        <input v-model="form.guest_name" type="text" placeholder="Guest name" class="finput" required />
                    </div>
                    <div class="fi">
                        <label class="fl">ঠিকানা (Address)</label>
                        <input v-model="form.address" type="text" placeholder="City / Area" class="finput" />
                    </div>
                    <div class="fi">
                        <label class="fl">{{ giftType === 'cash' ? 'Amount (৳)' : 'Gift Item' }}</label>
                        <input v-if="giftType==='cash'" v-model="form.amount" type="number" placeholder="e.g. 5000" class="finput" />
                        <input v-else v-model="form.item_name" type="text" placeholder="e.g. Dinner Set" class="finput" />
                    </div>
                    <div class="fi">
                        <label class="fl">Relation</label>
                        <select v-model="form.relation" class="finput">
                            <option>Family</option>
                            <option>Relative</option>
                            <option>Friend</option>
                            <option>Colleague</option>
                        </select>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;align-items:center;gap:12px;margin-top:20px">
                    <button v-if="editingGuestId" type="button" @click="cancelEdit" class="cancel-btn">Cancel</button>
                    <button type="submit" :disabled="form.processing" class="save-btn">
                        {{ editingGuestId ? 'Update Entry' : 'Save Entry' }}
                    </button>
                </div>
            </form>
        </div>

        <div class="card mt">
            <div class="rh no-print">
                <div>
                    <div class="rt">Recent Entries</div>
                    <div class="rs">{{ (recent_gifts||[]).length }} of {{ (recent_gifts||[]).length }} entries</div>
                </div>
                <button @click="downloadPdf" class="pdf-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                    Download PDF
                </button>
            </div>
            <div class="filters no-print">
                <div class="sw"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sic"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><input v-model="search" type="text" placeholder="Search name or address..." class="si-input" /></div>
                <select v-model="filterType" class="fsel"><option>All types</option><option>cash</option><option>item</option></select>
                <select v-model="filterRelation" class="fsel"><option>All relations</option><option>Family</option><option>Relative</option><option>Friend</option><option>Colleague</option></select>
            </div>
            <div style="overflow-x:auto">
                <table class="et">
                    <thead><tr><th>NAME</th><th>TYPE</th><th>GIFT / AMOUNT</th><th>RELATION</th><th>ADDRESS</th><th style="text-align:right">ACTION</th></tr></thead>
                    <tbody>
                        <tr v-for="g in filteredGifts" :key="g.id" class="er">
                            <td data-label="NAME"><div class="gc"><div class="ga">{{ (g.guest?.name||'G')[0].toUpperCase() }}</div><div class="gn">{{ g.guest?.name }}</div></div></td>
                            <td data-label="TYPE"><span :class="['tbg',g.type==='cash'?'bc':'bi']">{{ g.type==='cash'?'💳 Cash':'🎁 Item' }}</span></td>
                            <td data-label="GIFT / AMOUNT"><span v-if="g.type==='cash'" class="av">৳ {{ Number(g.amount||0).toLocaleString() }}</span><span v-else class="iv">{{ g.item_name }}</span></td>
                            <td data-label="RELATION"><span class="rb">{{ g.guest?.relation }}</span></td>
                            <td data-label="ADDRESS" class="daddr">{{ g.guest?.address || '—' }}</td>
                            <td style="text-align:right">
                                <div class="action-cell">
                                    <button @click="editEntry(g)" class="ebtn" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    <button @click="deleteEntry(g.guest_id)" class="dbtn" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!filteredGifts.length"><td colspan="5" class="ee"><div style="font-size:28px;margin-bottom:8px">🏜</div>No entries found</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </SPTechBDLayout>
</template>

</template>
