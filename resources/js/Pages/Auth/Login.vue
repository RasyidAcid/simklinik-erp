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

<div class="min-h-screen flex bg-gray-100">

    <!-- LEFT SIDE (BRANDING) -->
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-600 to-indigo-800 text-white flex-col justify-center items-center p-10">
        <h1 class="text-4xl font-bold mb-4">ERP System</h1>
        <p class="text-blue-100 text-center max-w-md">
            Sistem manajemen terintegrasi untuk mengelola pengajuan, keuangan, dan operasional perusahaan Anda.
        </p>

        <div class="mt-10 text-6xl opacity-20">
            📊
        </div>
    </div>

    <!-- RIGHT SIDE (FORM) -->
    <div class="flex w-full md:w-1/2 items-center justify-center p-6">

        <div class="w-full max-w-md">

            <!-- CARD -->
            <div class="bg-white/90 backdrop-blur shadow-2xl rounded-2xl p-8">

                <!-- TITLE -->
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                    <p class="text-gray-500 text-sm">Masuk ke sistem ERP</p>
                </div>

                <!-- STATUS -->
                <div v-if="status" class="mb-4 text-sm text-green-600 text-center">
                    {{ status }}
                </div>

                <!-- FORM -->
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input
                            type="email"
                            v-model="form.email"
                            class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="email@company.com"
                            required
                        />
                        <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600">Password</label>
                        <input
                            type="password"
                            v-model="form.password"
                            class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="••••••••"
                            required
                        />
                        <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <!-- REMEMBER -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-gray-600">
                            <input type="checkbox" v-model="form.remember" />
                            Remember me
                        </label>

                    
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90 text-white py-2 rounded-lg font-semibold shadow transition"
                    >
                        {{ form.processing ? 'Loading...' : 'Login' }}
                    </button>

                </form>

                <!-- FOOTER -->
                <div class="mt-6 text-center text-xs text-gray-400">
                    © 2026 ERP System
                </div>

            </div>

        </div>

    </div>

</div>
</template>