<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="mb-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">Sign in</h2>
            <p class="mt-2 text-sm text-gray-500 font-medium">
                or
                <Link :href="route('register')" class="font-bold text-purple-600 hover:text-purple-700 underline-offset-4 hover:underline">
                    sign up for an account
                </Link>
            </p>
        </div>

        <div v-if="status" class="mb-3 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="email" value="Email address*" class="text-sm font-black text-gray-900" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1.5 block w-full rounded-lg border-2 border-gray-200 py-2 px-3 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between mb-1.5">
                    <InputLabel for="password" value="Password*" class="text-sm font-black text-gray-900" />
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-xs font-black text-purple-600 hover:text-purple-700"
                    >
                        Forgot password?
                    </Link>
                </div>

                <div class="relative">
                    <TextInput
                        id="password"
                        type="password"
                        class="block w-full rounded-lg border-2 border-gray-200 py-2 px-3 shadow-sm hover:border-purple-300 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 placeholder:text-gray-300 text-sm font-bold"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-2 border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 w-4 h-4" />
                <span class="ms-2 text-sm font-black text-gray-700">Remember me</span>
            </div>

            <div class="pt-2">
                <button
                    class="flex w-full justify-center rounded-lg bg-purple-600 px-6 py-3 text-sm font-black text-white shadow-lg shadow-purple-200 hover:bg-purple-700 hover:shadow-purple-300 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 active:scale-[0.98]"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Sign in to Account
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
