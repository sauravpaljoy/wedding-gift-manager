<script setup>
import ShagunLayout from '@/Layouts/ShagunLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
const props = defineProps({ user: Object });
const form = useForm({
    name: props.user?.name ?? '',
    email: props.user?.email ?? '',
    wedding_name: props.user?.wedding_name ?? '',
    wedding_date: props.user?.wedding_date ?? '',
});
const submit = () => { form.patch(route('settings.update')); };
const pwForm = useForm({ current_password: '', password: '', password_confirmation: '' });
const updatePw = () => { pwForm.put(route('password.update'), { onSuccess: () => pwForm.reset() }); };
</script>
<template>
    <Head title="Settings – WeddingGift" />
    <ShagunLayout>
        <template #title>Settings</template>
        <template #subtitle>Manage your account and preferences</template>
        <!-- Profile -->
        <div class="card">
            <div class="st">Profile </div>
            <div class="ss">Update your account details</div>
            <form @submit.prevent="submit" class="sform">
                <div class="fg">
                    <div class="fi"><label class="fl">Full Name</label><input v-model="form.name" type="text" class="finput" required /></div>
                    <div class="fi"><label class="fl">Email Address</label><input v-model="form.email" type="email" class="finput" required /></div>
                    <div class="fi"><label class="fl">Wedding / Event Name</label><input v-model="form.wedding_name" type="text" placeholder="e.g. Saurav & Priya Wedding" class="finput" /></div>
                    <div class="fi"><label class="fl">Wedding Date</label><input v-model="form.wedding_date" type="date" class="finput" /></div>
                </div>
                <div style="margin-top:16px">
                    <button type="submit" :disabled="form.processing" class="save-btn">Save Changes</button>
                    <span v-if="form.recentlySuccessful" class="saved">✓ Saved!</span>
                </div>
            </form>
        </div>
        <!-- Password -->
        <div class="card mt">
            <div class="st">Change Password</div>
            <div class="ss">Ensure your account is using a long, random password</div>
            <form @submit.prevent="updatePw" class="sform">
                <div class="fg">
                    <div class="fi"><label class="fl">Current Password</label><input v-model="pwForm.current_password" type="password" class="finput" /></div>
                    <div class="fi"><label class="fl">New Password</label><input v-model="pwForm.password" type="password" class="finput" /></div>
                    <div class="fi"><label class="fl">Confirm New Password</label><input v-model="pwForm.password_confirmation" type="password" class="finput" /></div>
                </div>
                <div style="margin-top:16px">
                    <button type="submit" :disabled="pwForm.processing" class="save-btn">Update Password</button>
                    <span v-if="pwForm.recentlySuccessful" class="saved">✓ Updated!</span>
                </div>
            </form>
        </div>
        <!-- Logout -->
        <div class="card mt logout-card">
            <div class="logout-row">
                <div>
                    <div class="st">Log Out</div>
                    <div class="ss">Sign out from your SP Tech BD account</div>
                </div>
                <Link :href="route('logout')" method="post" as="button" class="logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Log Out
                </Link>
            </div>
        </div>
        <!-- Danger Zone -->
        <div class="card mt danger-card">
            <div class="st" style="color:#dc2626">Danger Zone</div>
            <div class="ss">Once deleted, all your data will be permanently removed.</div>
            <Link :href="route('profile.destroy')" method="delete" as="button" class="danger-btn" onclick="return confirm('Are you absolutely sure? This cannot be undone.')">
                Delete Account
            </Link>
        </div>
    </ShagunLayout>
</template>
<style scoped>
.card{background:white;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(168,85,247,.06);border:1px solid rgba(243,232,255,.6);}
.mt{margin-top:20px;}
.st{font-size:18px;font-weight:700;color:#1e1b4b;margin-bottom:4px;}
.ss{font-size:13px;color:#9ca3af;margin-bottom:16px;}
.fg{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.fi{display:flex;flex-direction:column;gap:6px;}
.fl{font-size:13px;font-weight:600;color:#374151;}
.finput{padding:10px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;color:#1e1b4b;outline:none;transition:border-color .2s;background:white;}
.finput:focus{border-color:#a855f7;box-shadow:0 0 0 3px rgba(168,85,247,.1);}
.save-btn{padding:10px 24px;background:linear-gradient(135deg,#a855f7,#ec4899);color:white;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;}
.save-btn:disabled{opacity:.6;cursor:not-allowed;}
.saved{margin-left:12px;font-size:13px;color:#059669;font-weight:600;}
.logout-card{border-color:#e0e7ff;}
.logout-row{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
.logout-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#f5f3ff;color:#7c3aed;border:1.5px solid #ddd6fe;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;}
.logout-btn:hover{background:#ede9fe;border-color:#a855f7;color:#6d28d9;}
.danger-card{border-color:#fecaca;}
.danger-btn{display:inline-block;padding:10px 20px;background:#fef2f2;color:#dc2626;border:1.5px solid #fecaca;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;text-decoration:none;}
.danger-btn:hover{background:#fee2e2;}
@media(max-width:640px){.fg{grid-template-columns:1fr;}}
</style>
