<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  total: Number,
  approve: Number,
  proses: Number
})
</script>

<template>
<AuthenticatedLayout>
<Head title="Dashboard" />

<div class="p-6">

  <!-- TITLE -->
  <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-6">
    Dashboard ERP
  </h1>

  <!-- CARD SUMMARY -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- TOTAL PENGAJUAN -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 flex items-center gap-4">
      <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-xl">
        📄
      </div>
      <div>
        <p class="text-gray-500 text-sm">Total Pengajuan</p>
        <h2 class="text-2xl font-bold text-gray-700 dark:text-white">
          {{ total }}
        </h2>
      </div>
    </div>

    <!-- APPROVE -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 flex items-center gap-4">
      <div class="bg-green-100 dark:bg-green-900 p-4 rounded-xl">
        ✅
      </div>
      <div>
        <p class="text-gray-500 text-sm">Pengajuan Disetujui</p>
        <h2 class="text-2xl font-bold text-gray-700 dark:text-white">
          {{ approve }}
        </h2>
      </div>
    </div>

    <!-- PROSES -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 flex items-center gap-4">
      <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-xl">
        ⏳
      </div>
      <div>
        <p class="text-gray-500 text-sm">Sedang Diproses</p>
        <h2 class="text-2xl font-bold text-gray-700 dark:text-white">
          {{ proses }}
        </h2>
      </div>
    </div>

  </div>

  <!-- OPTIONAL: INFO BOX -->
  <div class="mt-8 bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
      Informasi
    </h2>
    <p class="text-gray-500 dark:text-gray-400 text-sm">
      Selamat datang di sistem ERP. Gunakan menu di samping untuk mengelola data pengajuan.
    </p>
  </div>

</div>

</AuthenticatedLayout>
</template>