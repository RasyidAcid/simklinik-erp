<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <Head title="Login ERP" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-700">
        <div class="w-full max-w-md">

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">

                <!-- Logo / Title -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">ERP System</h1>
                    <p class="text-gray-500 text-sm">Silakan login untuk melanjutkan</p>
                </div>

                <!-- Status -->
                <div v-if="status" class="mb-4 text-sm text-green-600 text-center">
                    {{ status }}
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            v-model="form.email"
                            class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Masukkan email"
                            required
                        />
                        <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input
                            type="password"
                            v-model="form.password"
                            class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Masukkan password"
                            required
                        />
                        <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-gray-600">
                            <input type="checkbox" v-model="form.remember" class="rounded" />
                            Remember me
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-blue-600 hover:underline"
                        >
                            Lupa password?
                        </Link>
                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition disabled:opacity-50"
                    >
                        Login
                    </button>

                </form>

                <!-- Footer -->
                <div class="mt-6 text-center text-xs text-gray-400">
                    © 2026 ERP System - All rights reserved
                </div>

            </div>

        </div>
    </div>
</template>