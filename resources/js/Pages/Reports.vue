<script setup>
import SPTechBDLayout from '@/Layouts/SPTechBDLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps({ stats: Object, by_relation: Object, gifts: Array });
const exportCsv = () => { window.location.href = route('export.csv'); };
const downloadPdf = () => { window.print(); };
const relations = computed(() => props.by_relation || {});
</script>
<template>
    <Head title="Reports – SP Tech BD" />
    <SPTechBDLayout>
        <template #title>Reports</template>
        <template #subtitle>Insights &amp; exports for your celebration</template>
        <!-- Summary Cards -->
        <div class="stats-grid">
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
        <!-- Export -->
        <div class="card mt no-print">
            <div class="rh">
                <div>
                    <div class="et">Export Data</div>
                    <div class="es">Download your data for offline use</div>
                </div>
                <div class="filters">
                    <button @click="exportCsv" class="export-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Export CSV
                    </button>
                    <button @click="downloadPdf" class="pdf-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                        Download PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card mt">
            <div class="rel-grid">
                <div v-for="(amount, rel) in relations" :key="rel" class="rel-card">
                    <div class="rn">{{ rel }}</div>
                    <div class="ra">৳ {{ Number(amount).toLocaleString() }}</div>
                </div>
            </div>
        </div>
        <!-- Analytics -->
        <div class="card mt">
            <div class="et" style="margin-bottom:4px">Analytics</div>
            <div class="es" style="margin-bottom:20px">Visual breakdown</div>
            <div v-if="stats?.total_cash > 0" class="bar-section">
                <div v-for="(amount, rel) in relations" :key="rel" class="bar-row">
                    <div class="bar-label">{{ rel }}</div>
                    <div class="bar-track">
                        <div class="bar-fill" :style="{width: ((amount / (stats?.total_cash||1))*100)+'%'}"></div>
                    </div>
                    <div class="bar-val">৳ {{ Number(amount).toLocaleString() }}</div>
                </div>
            </div>
            <div v-else class="empty">No data yet to display analytics.</div>
        </div>
    </SPTechBDLayout>
</template>
