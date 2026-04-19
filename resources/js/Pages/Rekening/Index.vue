<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { router } from '@inertiajs/vue3'

defineProps({ data: Array })

const hapus = (id) => {
  if (confirm('Yakin hapus?')) {
    router.delete(`/rekening/${id}`)
  }
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="p-6">
      <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
            Data Rekening
          </h1>

          <a href="/rekening/create"
             class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Tambah
          </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">

            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
              <tr>
                <th class="p-3 text-left">Kode</th>
                <th class="p-3 text-left">Nama Rekening</th>
                <th class="p-3 text-center">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="r in data" :key="r.id"
                  class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                <td class="p-3">{{ r.kode_rekening }}</td>
                <td class="p-3">{{ r.nama_rekening }}</td>

                <td class="p-3 text-center space-x-3">
                  <a :href="`/rekening/${r.id}/edit`"
                     class="text-blue-500 hover:text-blue-700">
                    Edit
                  </a>

                  <button @click="hapus(r.id)"
                     class="text-red-500 hover:text-red-700">
                    Hapus
                  </button>
                </td>

              </tr>

              <tr v-if="data.length === 0">
                <td colspan="3" class="text-center p-4 text-gray-400">
                  Data belum ada
                </td>
              </tr>

            </tbody>

          </table>
        </div>

      </div>
    </div>

  </AuthenticatedLayout>
</template>