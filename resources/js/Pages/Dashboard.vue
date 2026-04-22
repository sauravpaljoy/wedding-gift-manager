<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
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
</script>

<template>
    <Head title="Dashboard – SP Tech BD" />
    <ShagunLayout>
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

        <div class="quick-card">
            <div class="qh">
                <div class="qh-left">
                    <span style="font-size:20px">⚡</span>
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
                <div style="display:flex;justify-content:flex-end;align-items:center;gap:12px;margin-top:16px">
                    <button v-if="editingGuestId" type="button" @click="cancelEdit" class="cancel-btn">Cancel</button>
                    <button type="submit" :disabled="form.processing" class="save-btn">
                        {{ editingGuestId ? 'Update Entry' : 'Save Entry' }}
                    </button>
                </div>
            </form>
        </div>

        <div class="recent-card">
            <div class="rh">
                <div>
                    <div class="rt">Recent Entries</div>
                    <div class="rs">{{ filteredGifts.length }} of {{ (recent_gifts||[]).length }} entries</div>
                </div>
            </div>
            <div class="filters">
                <div class="sw">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="si"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input v-model="search" type="text" placeholder="Search name or address..." class="si-input" />
                </div>
                <select v-model="filterType" class="fsel">
                    <option>All types</option><option>cash</option><option>item</option>
                </select>
                <select v-model="filterRelation" class="fsel">
                    <option>All relations</option><option>Family</option><option>Relative</option><option>Friend</option><option>Colleague</option>
                </select>
                <select class="fsel"><option>Latest entry</option><option>Highest amount</option></select>
            </div>
            <div style="overflow-x:auto">
                <table class="etable">
                    <thead>
                        <tr>
                            <th>NAME</th><th>TYPE</th><th>GIFT / AMOUNT</th><th>RELATION</th><th>ADDRESS</th><th style="text-align:right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="g in filteredGifts" :key="g.id" class="erow">
                            <td>
                                <div class="gcell">
                                    <div class="gav">{{ (g.guest?.name||'G')[0].toUpperCase() }}</div>
                                    <div class="gname">{{ g.guest?.name }}</div>
                                </div>
                            </td>
                            <td>
                                <span :class="['tbadge', g.type==='cash'?'bcash':'bitem']">
                                    {{ g.type==='cash'?'💳 Cash':'🎁 Item' }}
                                </span>
                            </td>
                            <td>
                                <span v-if="g.type==='cash'" class="aval">৳ {{ Number(g.amount||0).toLocaleString() }}</span>
                                <span v-else class="ival">{{ g.item_name }}</span>
                            </td>
                            <td><span class="rbadge">{{ g.guest?.relation }}</span></td>
                            <td class="daddr">{{ g.guest?.address || '—' }}</td>
                            <td style="text-align:right">
                                <div class="action-cell">
                                    <button @click="editEntry(g)" class="ebtn" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    <button @click="deleteEntry(g.guest_id)" class="dbtn" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!filteredGifts.length">
                            <td colspan="6" class="eempty">
                                <div style="font-size:28px;margin-bottom:8px">🏜</div>
                                No entries found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </ShagunLayout>
</template>

<style scoped>
.quick-card,.recent-card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.mb{margin-bottom:24px;}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;}
.stat-card{background:white;border-radius:16px;padding:20px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.sl{font-size:11px;font-weight:700;color:#9ca3af;letter-spacing:.8px;margin-bottom:4px;}
.sv{font-size:24px;font-weight:700;color:#1e1b4b;line-height:1;}
.sd{font-size:12px;color:#9ca3af;margin-top:4px;}
.si{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.recent-card{margin-top:24px;}
.qh{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.qh-left{display:flex;align-items:center;gap:10px;}
.qt{font-size:18px;font-weight:700;color:#1e1b4b;}
.qs{font-size:13px;color:#9ca3af;margin-top:2px;}
.type-toggle{display:flex;gap:8px;}
.tb{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;border:1.5px solid #e5e7eb;background:white;color:#6b7280;font-size:13px;font-weight:500;cursor:pointer;transition:all .2s;}
.tb:hover{border-color:#a855f7;color:#a855f7;}
.tb-on{background:#f5f3ff;border-color:#a855f7;color:#7c3aed;font-weight:600;}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.fi{display:flex;flex-direction:column;gap:6px;}
.fl{font-size:13px;font-weight:600;color:#374151;}
.finput{padding:10px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;color:#1e1b4b;outline:none;transition:border-color .2s;background:white;}
.finput:focus{border-color:#a855f7;box-shadow:0 0 0 3px rgba(168,85,247,.1);}
.save-btn{padding:11px 28px;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;border:none;border-radius:12px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;box-shadow:0 4px 12px rgba(168,85,247,.3);}
.save-btn:hover:not(:disabled){transform:translateY(-1px);box-shadow:0 6px 16px rgba(168,85,247,.4);}
.save-btn:disabled{opacity:.6;cursor:not-allowed;}
.cancel-btn{padding:10px 20px;background:#f3f4f6;color:#4b5563;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;}
.cancel-btn:hover{background:#e5e7eb;}
.rh{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
.rt{font-size:18px;font-weight:700;color:#1e1b4b;}
.rs{font-size:13px;color:#9ca3af;margin-top:2px;}
.filters{display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap;}
.sw{position:relative;flex:1;min-width:180px;}
.si{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;}
.si-input{width:100%;padding:9px 12px 9px 36px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;transition:border-color .2s;box-sizing:border-box;}
.si-input:focus{border-color:#a855f7;}
.fsel{padding:9px 12px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:13px;color:#374151;outline:none;background:white;cursor:pointer;}
.etable{width:100%;border-collapse:collapse;}
.etable thead tr{background:linear-gradient(135deg,#a855f7 0%,#ec4899 100%);}
.etable thead th{padding:12px 16px;text-align:left;font-size:11px;font-weight:700;color:white;letter-spacing:.8px;}
.etable thead th:first-child{border-radius:10px 0 0 10px;}
.etable thead th:last-child{border-radius:0 10px 10px 0;}
.erow{border-bottom:1px solid #f3f4f6;transition:background .15s;}
.erow:hover{background:#fdf4ff;}
.etable td{padding:14px 16px;font-size:14px;color:#374151;}
.gcell{display:flex;align-items:center;gap:10px;}
.gav{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;flex-shrink:0;}
.gname{font-weight:600;color:#1e1b4b;}
.gaddr{font-size:12px;color:#9ca3af;margin-top:1px;}
.tbadge{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:600;}
.bcash{background:#d1fae5;color:#065f46;}
.bitem{background:#fef3c7;color:#92400e;}
.aval{font-weight:700;color:#059669;font-size:15px;}
.ival{font-weight:600;color:#d97706;}
.rbadge{display:inline-block;padding:3px 10px;border-radius:20px;background:#f3f4f6;font-size:12px;color:#4b5563;font-weight:500;}
.daddr{color:#6b7280;font-size:13px;}
.action-cell{display:flex;align-items:center;justify-content:flex-end;gap:8px;}
.dbtn, .ebtn{border:none;background:transparent;color:#d1d5db;cursor:pointer;padding:6px;border-radius:8px;transition:all .2s;display:flex;align-items:center;}
.ebtn:hover{color:#a855f7;background:#f5f3ff;}
.dbtn:hover{color:#ef4444;background:#fef2f2;}
.eempty{text-align:center;padding:48px 16px !important;color:#9ca3af;}
@media(max-width:640px){.fg{grid-template-columns:1fr;}.qh{flex-direction:column;}}
</style>
