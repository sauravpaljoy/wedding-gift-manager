<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps({ stats: Object, by_relation: Object, gifts: Array });
const exportCsv = () => { window.location.href = route('export.csv'); };
const relations = computed(() => props.by_relation || {});
</script>
<template>
    <Head title="Reports – SP Tech BD" />
    <ShagunLayout>
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
        <div class="card mt">
            <div class="eh">
                <div>
                    <div class="et">Export Data</div>
                    <div class="es">Download everything as CSV</div>
                </div>
                <button @click="exportCsv" class="exp-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export CSV
                </button>
            </div>
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
    </ShagunLayout>
</template>
<style scoped>
.stats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;}
.stat-card{background:white;border-radius:16px;padding:20px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.sl{font-size:11px;font-weight:700;color:#9ca3af;letter-spacing:.8px;margin-bottom:4px;}
.sv{font-size:24px;font-weight:700;color:#1e1b4b;line-height:1;}
.sd{font-size:12px;color:#9ca3af;margin-top:4px;}
.si{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.mt{margin-top:20px;}
.eh{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
.et{font-size:18px;font-weight:700;color:#1e1b4b;}
.es{font-size:13px;color:#9ca3af;margin-top:2px;}
.exp-btn{display:flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;border:none;border-radius:12px;font-size:14px;font-weight:600;cursor:pointer;box-shadow:0 4px 12px rgba(168,85,247,.3);}
.rel-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;}
.rel-card{background:#fdf4ff;border-radius:12px;padding:14px 16px;border:1px solid #f3e8ff;}
.rn{font-size:13px;color:#6b7280;margin-bottom:4px;}
.ra{font-size:18px;font-weight:700;color:#1e1b4b;}
.bar-section{display:flex;flex-direction:column;gap:12px;}
.bar-row{display:flex;align-items:center;gap:12px;}
.bar-label{font-size:13px;color:#374151;width:80px;flex-shrink:0;}
.bar-track{flex:1;height:10px;background:#f3f4f6;border-radius:99px;overflow:hidden;}
.bar-fill{height:100%;background:linear-gradient(90deg,#a855f7,#ec4899);border-radius:99px;transition:width .5s ease;}
.bar-val{font-size:13px;font-weight:600;color:#1e1b4b;width:100px;text-align:right;flex-shrink:0;}
.empty{text-align:center;padding:32px;color:#9ca3af;}
@media(max-width:640px){.stats-grid{grid-template-columns:1fr 1fr;}}
</style>
