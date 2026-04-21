<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
const props = defineProps({ reminders: Array });
const form = useForm({ text: '', due_date: '' });
const submit = () => { form.post(route('reminders.store'), { onSuccess: () => form.reset() }); };
const deleteReminder = (id) => { if (confirm('Delete?')) router.delete(route('reminders.destroy', id)); };
const fmt = (d) => d ? new Date(d).toLocaleDateString('en-BD',{day:'2-digit',month:'short',year:'numeric'}) : '';
</script>
<template>
    <Head title="Reminders – Shagun" />
    <ShagunLayout>
        <template #title>Reminders</template>
        <template #subtitle>Thank-yous, follow-ups &amp; to-dos</template>
        <div class="card">
            <div class="rht">Add Reminder</div>
            <div class="rhs">Don't forget to send thank-you notes 📅</div>
            <form @submit.prevent="submit" class="rf">
                <div class="ri"><input v-model="form.text" type="text" placeholder="e.g. Thank Rahim uncle personally" class="finput" required /></div>
                <div class="rd"><input v-model="form.due_date" type="date" class="finput" /></div>
                <button type="submit" :disabled="form.processing" class="add-btn">+ Add</button>
            </form>
        </div>
        <div class="card mt">
            <div class="rht">Your Reminders</div>
            <div class="rhs">{{ (reminders||[]).filter(r=>!r.done).length }} pending</div>
            <div v-if="(reminders||[]).length > 0" class="rem-list">
                <div v-for="r in reminders" :key="r.id" :class="['rem-item', r.done?'done':'']">
                    <div class="rem-left">
                        <div class="rem-text">{{ r.text }}</div>
                        <div v-if="r.due_date" class="rem-date">📅 {{ fmt(r.due_date) }}</div>
                    </div>
                    <div class="rem-actions">
                        <button @click="deleteReminder(r.id)" class="dbtn" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                <div style="margin-top:8px">No reminders yet</div>
            </div>
        </div>
    </ShagunLayout>
</template>
<style scoped>
.card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.mt{margin-top:20px;}
.rht{font-size:18px;font-weight:700;color:#1e1b4b;margin-bottom:4px;}
.rhs{font-size:13px;color:#9ca3af;margin-bottom:16px;}
.rf{display:flex;gap:10px;flex-wrap:wrap;}
.ri{flex:1;min-width:200px;}
.rd{min-width:160px;}
.finput{width:100%;padding:10px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;color:#1e1b4b;outline:none;transition:border-color .2s;background:white;box-sizing:border-box;}
.finput:focus{border-color:#a855f7;box-shadow:0 0 0 3px rgba(168,85,247,.1);}
.add-btn{padding:10px 20px;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;white-space:nowrap;}
.add-btn:disabled{opacity:.6;cursor:not-allowed;}
.rem-list{display:flex;flex-direction:column;gap:10px;}
.rem-item{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-radius:12px;background:#fdf4ff;border:1.5px solid #f3e8ff;transition:all .2s;}
.rem-item.done{opacity:.5;text-decoration:line-through;}
.rem-left{flex:1;}
.rem-text{font-size:14px;font-weight:500;color:#1e1b4b;}
.rem-date{font-size:12px;color:#9ca3af;margin-top:3px;}
.dbtn{border:none;background:transparent;color:#d1d5db;cursor:pointer;padding:6px;border-radius:8px;transition:all .2s;display:flex;align-items:center;}
.dbtn:hover{color:#ef4444;background:#fef2f2;}
.empty{text-align:center;padding:48px;color:#9ca3af;display:flex;flex-direction:column;align-items:center;}
</style>
