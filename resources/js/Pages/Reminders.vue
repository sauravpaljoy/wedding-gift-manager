<script setup>
import SPTechBDLayout from '@/Layouts/SPTechBDLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
const props = defineProps({ reminders: Array });
const form = useForm({ text: '', due_date: '' });
const submit = () => { form.post(route('reminders.store'), { onSuccess: () => form.reset() }); };
const deleteReminder = (id) => { if (confirm('Delete?')) router.delete(route('reminders.destroy', id)); };
const fmt = (d) => d ? new Date(d).toLocaleDateString('en-BD',{day:'2-digit',month:'short',year:'numeric'}) : '';
</script>
<template>
    <Head title="Reminders – SP Tech BD" />
    <SPTechBDLayout>
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
    </SPTechBDLayout>
</template>
</template>
