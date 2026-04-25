<script setup>
import SPTechBDLayout from '@/Layouts/SPTechBDLayout.vue';
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
<<<<<<< HEAD
    <Head title="Settings – SP Tech BD" />
    <SPTechBDLayout>
        <template #title>Settings</template>
=======
    <Head title="Settings – WeddingGift" />
    <ShagunLayout>
        <template #title>Settings Information</template>
>>>>>>> ab8016a57718c7c8119e32d07693d79b7f237d1e
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
    </SPTechBDLayout>
</template>
</template>
