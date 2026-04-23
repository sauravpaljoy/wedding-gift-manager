<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    wedding_name: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout maxWidth="sm:max-w-2xl">
        <Head title="Create Your Account" />

        <div class="mb-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Create Account</h2>
            <p class="mt-2 text-sm sm:text-base text-gray-500 font-medium px-4">
                Join thousands of happy couples today
            </p>
        </div>

        <form @submit.prevent="submit" class="space-y-6 sm:space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-5 sm:gap-y-4">
                <!-- Row 1: Name & Phone -->
                <div>
                    <InputLabel for="name" value="Your Name*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                    />
                    <InputError class="mt-1" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="phone" value="Phone Number*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="phone"
                        type="text"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.phone"
                        required
                        placeholder="01712XXXXXX"
                    />
                    <InputError class="mt-1" :message="form.errors.phone" />
                </div>

                <!-- Row 2: Email & Wedding Name (New 2-Column Row) -->
                <div>
                    <InputLabel for="email" value="Email Address*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="hello@example.com"
                    />
                    <InputError class="mt-1" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="wedding_name" value="Wedding Celebration Name*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="wedding_name"
                        type="text"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.wedding_name"
                        required
                        placeholder="e.g. S & A Wedding"
                    />
                    <InputError class="mt-1" :message="form.errors.wedding_name" />
                </div>

                <!-- Row 3: Password & Confirmation -->
                <div>
                    <InputLabel for="password" value="Password*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <InputError class="mt-1" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="password_confirmation" value="Confirm Password*" class="text-sm font-black text-gray-900" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1.5 block w-full rounded-xl border-2 border-gray-100 py-2.5 px-4 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <InputError class="mt-1" :message="form.errors.password_confirmation" />
                </div>
            </div>

            <div class="pt-2">
                <button
                    class="flex w-full justify-center rounded-lg bg-purple-600 px-6 py-4 text-sm font-black text-white shadow-lg shadow-purple-200 hover:bg-purple-700 hover:shadow-purple-300 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 active:scale-[0.98]"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Create Free Account
                </button>
            </div>

            <p class="text-center text-sm font-bold text-gray-500">
                Already have an account? 
                <Link :href="route('login')" class="text-purple-600 hover:underline">Sign in</Link>
            </p>
        </form>
    </GuestLayout>
</template>
