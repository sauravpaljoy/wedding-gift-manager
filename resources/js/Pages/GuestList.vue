<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({ guests: Array });

const search = ref('');

const filteredGuests = computed(() => {
    if (!search.value) return props.guests || [];
    return (props.guests || []).filter(g =>
        g.name?.toLowerCase().includes(search.value.toLowerCase()) ||
        g.address?.toLowerCase().includes(search.value.toLowerCase())
    );
});

const totalCash = (guest) => (guest.gifts || []).filter(g => g.type === 'cash').reduce((s, g) => s + parseFloat(g.amount || 0), 0);
const totalItems = (guest) => (guest.gifts || []).filter(g => g.type === 'item').length;
const entryCount = (guest) => (guest.gifts || []).length;
</script>

<template>
    <Head title="Guests – Shagun" />
    <ShagunLayout>
        <template #title>Guests</template>
        <template #subtitle>Every beautiful soul who blessed you</template>

        <div class="card">
            <div class="gh">
                <div>
                    <div class="gt">Guest List</div>
                    <div class="gs">{{ filteredGuests.length }} unique guests</div>
                </div>
                <div class="sw">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="si"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input v-model="search" type="text" placeholder="Search guest..." class="sinput" />
                </div>
            </div>

            <div class="guest-grid">
                <div v-for="guest in filteredGuests" :key="guest.id" class="guest-card">
                    <div class="gc-header">
                        <div class="gc-name">{{ guest.name }}</div>
                        <span class="rel-badge">{{ guest.relation }}</span>
                    </div>
                    <div class="gc-addr">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ guest.address || 'Unknown' }}
                    </div>
                    <div class="gc-stats">
                        <div class="gstat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            <span class="cash-val">৳ {{ totalCash(guest).toLocaleString() }}</span>
                        </div>
                        <div class="gstat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/></svg>
                            <span class="item-val">{{ totalItems(guest) }}</span>
                        </div>
                        <div class="gentry">{{ entryCount(guest) }} entries</div>
                    </div>
                </div>
                <div v-if="!filteredGuests.length" class="empty">
                    <div style="font-size:32px;margin-bottom:8px">👥</div>
                    No guests found
                </div>
            </div>
        </div>
    </ShagunLayout>
</template>

<style scoped>
.card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.gh{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.gt{font-size:20px;font-weight:700;color:#1e1b4b;}
.gs{font-size:13px;color:#9ca3af;margin-top:2px;}
.sw{position:relative;}
.si{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;}
.sinput{padding:9px 12px 9px 36px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;width:220px;}
.sinput:focus{border-color:#a855f7;}
.guest-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;}
.guest-card{background:white;border:1.5px solid #f3e8ff;border-radius:14px;padding:18px;transition:all .2s;cursor:default;}
.guest-card:hover{border-color:#d8b4fe;box-shadow:0 4px 16px rgba(168,85,247,.1);transform:translateY(-2px);}
.gc-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;}
.gc-name{font-size:16px;font-weight:700;color:#1e1b4b;}
.rel-badge{display:inline-block;padding:3px 10px;border-radius:20px;background:#f5f3ff;color:#7c3aed;font-size:11px;font-weight:600;}
.gc-addr{display:flex;align-items:center;gap:5px;font-size:12px;color:#9ca3af;margin-bottom:14px;}
.gc-stats{display:flex;align-items:center;gap:16px;padding-top:14px;border-top:1px solid #f3f4f6;}
.gstat{display:flex;align-items:center;gap:5px;}
.cash-val{font-size:13px;font-weight:700;color:#059669;}
.item-val{font-size:13px;font-weight:700;color:#d97706;}
.gentry{font-size:12px;color:#9ca3af;margin-left:auto;}
.empty{grid-column:1/-1;text-align:center;padding:48px;color:#9ca3af;}
@media(max-width:640px){.sinput{width:160px;}}
</style>
