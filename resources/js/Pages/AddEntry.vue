<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
const props = defineProps({ recent_gifts: Array });
const giftType = ref('cash');
const form = useForm({
    guest_name: '', address: '', relation: 'Family',
    type: 'cash', amount: '', item_name: '', note: '',
});
const editingGuestId = ref(null);
const submit = () => {
    form.type = giftType.value;
    if (editingGuestId.value) {
        form.patch(route('guests.update', editingGuestId.value), {
            onSuccess: () => {
                form.reset();
                editingGuestId.value = null;
            }
        });
    } else {
        form.post(route('gifts.store'), { 
            onSuccess: () => form.reset('guest_name','address','amount','item_name','note') 
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
    let r = [...(props.recent_gifts||[])];
    if (search.value) r = r.filter(g => g.guest?.name?.toLowerCase().includes(search.value.toLowerCase()));
    if (filterType.value !== 'All types') r = r.filter(g => g.type === filterType.value.toLowerCase());
    if (filterRelation.value !== 'All relations') r = r.filter(g => g.guest?.relation === filterRelation.value);
    return r;
});
const fmt = (d) => { const dt = new Date(d); return dt.toLocaleDateString('en-GB',{day:'2-digit',month:'short'})+', '+dt.toLocaleTimeString('en-US',{hour:'numeric',minute:'2-digit',hour12:true}); };
</script>

<template>
    <Head title="Add Entry – SP Tech BD" />
    <ShagunLayout>
        <template #title>Add Entry</template>
        <template #subtitle>Quick event-mode entry — press Enter to fly through fields</template>
        <div class="card">
            <div class="qh">
                <div style="display:flex;align-items:center;gap:10px">
                    <span style="font-size:20px">⚡</span>
                    <div><div class="qt">{{ editingGuestId ? 'Update Entry' : 'Quick Add' }}</div><div class="qs">Event mode — Enter চাপলেই next field</div></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button :class="['tb',giftType==='cash'?'tb-on':'']" @click="giftType='cash'" type="button">💳 Cash</button>
                    <button :class="['tb',giftType==='item'?'tb-on':'']" @click="giftType='item'" type="button">🎁 Item</button>
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="fg">
                    <div class="fi"><label class="fl">নাম (Name)</label><input v-model="form.guest_name" type="text" placeholder="Guest name" class="finput" required autofocus /></div>
                    <div class="fi"><label class="fl">ঠিকানা (Address)</label><input v-model="form.address" type="text" placeholder="City / Area" class="finput" /></div>
                    <div class="fi">
                        <label class="fl">{{ giftType==='cash'?'Amount (৳)':'Gift Item' }}</label>
                        <input v-if="giftType==='cash'" v-model="form.amount" type="number" placeholder="e.g. 5000" class="finput" />
                        <input v-else v-model="form.item_name" type="text" placeholder="e.g. Dinner Set" class="finput" />
                    </div>
                    <div class="fi"><label class="fl">Relation</label>
                        <select v-model="form.relation" class="finput"><option>Family</option><option>Relative</option><option>Friend</option><option>Colleague</option></select>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;align-items:center;gap:12px;margin-top:16px">
                    <button v-if="editingGuestId" type="button" @click="cancelEdit" class="cancel-btn">Cancel</button>
                    <button type="submit" :disabled="form.processing" class="save-btn">{{ editingGuestId ? 'Update Entry' : 'Save Entry' }}</button>
                </div>
            </form>
        </div>
        <div class="card mt">
            <div class="rt">Recent Entries</div>
            <div class="rs">{{ (recent_gifts||[]).length }} of {{ (recent_gifts||[]).length }} entries</div>
            <div class="filters">
                <div class="sw"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sic"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><input v-model="search" type="text" placeholder="Search name or address..." class="si-input" /></div>
                <select v-model="filterType" class="fsel"><option>All types</option><option>cash</option><option>item</option></select>
                <select v-model="filterRelation" class="fsel"><option>All relations</option><option>Family</option><option>Relative</option><option>Friend</option><option>Colleague</option></select>
            </div>
            <div style="overflow-x:auto">
                <table class="et">
                    <thead><tr><th>NAME</th><th>TYPE</th><th>GIFT / AMOUNT</th><th>RELATION</th><th>ADDRESS</th><th style="text-align:right">ACTION</th></tr></thead>
                    <tbody>
                        <tr v-for="g in filteredGifts" :key="g.id" class="er">
                            <td><div class="gc"><div class="ga">{{ (g.guest?.name||'G')[0].toUpperCase() }}</div><div class="gn">{{ g.guest?.name }}</div></div></td>
                            <td><span :class="['tbg',g.type==='cash'?'bc':'bi']">{{ g.type==='cash'?'💳 Cash':'🎁 Item' }}</span></td>
                            <td><span v-if="g.type==='cash'" class="av">৳ {{ Number(g.amount||0).toLocaleString() }}</span><span v-else class="iv">{{ g.item_name }}</span></td>
                            <td><span class="rb">{{ g.guest?.relation }}</span></td>
                            <td class="daddr">{{ g.guest?.address || '—' }}</td>
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
    </ShagunLayout>
</template>

<style scoped>
.card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.mt{margin-top:24px;}
.qh{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.qt{font-size:18px;font-weight:700;color:#1e1b4b;}
.qs{font-size:13px;color:#9ca3af;margin-top:2px;}
.tb{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;border:1.5px solid #e5e7eb;background:white;color:#6b7280;font-size:13px;font-weight:500;cursor:pointer;transition:all .2s;}
.tb-on{background:#f5f3ff;border-color:#a855f7;color:#7c3aed;font-weight:600;}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.fi{display:flex;flex-direction:column;gap:6px;}
.fl{font-size:13px;font-weight:600;color:#374151;}
.finput{padding:10px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;color:#1e1b4b;outline:none;transition:border-color .2s;background:white;}
.finput:focus{border-color:#a855f7;box-shadow:0 0 0 3px rgba(168,85,247,.1);}
.save-btn{padding:11px 28px;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;border:none;border-radius:12px;font-size:14px;font-weight:600;cursor:pointer;box-shadow:0 4px 12px rgba(168,85,247,.3);}
.save-btn:disabled{opacity:.6;cursor:not-allowed;}
.cancel-btn{padding:10px 20px;background:#f3f4f6;color:#4b5563;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;}
.cancel-btn:hover{background:#e5e7eb;}
.rt{font-size:18px;font-weight:700;color:#1e1b4b;margin-bottom:4px;}
.rs{font-size:13px;color:#9ca3af;margin-bottom:16px;}
.filters{display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap;}
.sw{position:relative;flex:1;min-width:180px;}
.sic{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;}
.si-input{width:100%;padding:9px 12px 9px 36px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;}
.si-input:focus{border-color:#a855f7;}
.fsel{padding:9px 12px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:13px;color:#374151;outline:none;background:white;}
.et{width:100%;border-collapse:collapse;}
.et thead tr{background:linear-gradient(135deg,#a855f7 0%,#ec4899 100%);}
.et thead th{padding:12px 16px;text-align:left;font-size:11px;font-weight:700;color:white;letter-spacing:.8px;}
.et thead th:first-child{border-radius:10px 0 0 10px;}
.et thead th:last-child{border-radius:0 10px 10px 0;}
.er{border-bottom:1px solid #f3f4f6;transition:background .15s;}
.er:hover{background:#fdf4ff;}
.et td{padding:14px 16px;font-size:14px;color:#374151;}
.gc{display:flex;align-items:center;gap:10px;}
.ga{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;flex-shrink:0;}
.gn{font-weight:600;color:#1e1b4b;}
.gad{font-size:12px;color:#9ca3af;margin-top:1px;}
.tbg{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:600;}
.bc{background:#d1fae5;color:#065f46;}.bi{background:#fef3c7;color:#92400e;}
.av{font-weight:700;color:#059669;font-size:15px;}
.iv{font-weight:600;color:#d97706;}
.rb{display:inline-block;padding:3px 10px;border-radius:20px;background:#f3f4f6;font-size:12px;color:#4b5563;font-weight:500;}
.daddr{color:#6b7280;font-size:13px;}
.action-cell{display:flex;align-items:center;justify-content:flex-end;gap:10px;}
.dbtn, .ebtn{border:1px solid #e2e8f0;background:white;color:#64748b;cursor:pointer;padding:8px;border-radius:10px;transition:all .2s;display:flex;align-items:center;box-shadow:0 1px 2px rgba(0,0,0,0.05);}
.ebtn:hover{color:#a855f7;background:#f5f3ff;border-color:#d8b4fe;transform:translateY(-1px);box-shadow:0 4px 6px -1px rgba(168,85,247,0.1);}
.dbtn:hover{color:#ef4444;background:#fef2f2;border-color:#fecaca;transform:translateY(-1px);box-shadow:0 4px 6px -1px rgba(239,68,68,0.1);}
.ee{text-align:center;padding:48px 16px !important;color:#9ca3af;}
@media(max-width:640px){.fg{grid-template-columns:1fr;}.qh{flex-direction:column;}}
</style>
