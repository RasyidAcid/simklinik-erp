<script setup>
import { ref, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const props = defineProps({
  data: {
    type: Array,
    default: () => []
  }
})

const search = ref('')

// ✅ FILTER AMAN (ANTI WHITE SCREEN)
const filteredData = computed(() => {
  return (props.data || []).filter(item => {
    const no = (item.kas_bukti_no ?? '').toString().toLowerCase()
    const ket = (item.kas_keperluan ?? '').toString().toLowerCase()
    const key = search.value.toLowerCase()

    return no.includes(key) || ket.includes(key)
  })
})

const hapus = (id) => {
  if (confirm('Yakin hapus data ini?')) {
    router.delete(`/pengajuan/${id}`)
  }
}
</script>

<template>
<AuthenticatedLayout>

<div class="p-6">
  <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
      <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
        Data Pengajuan
      </h1>

      <div class="flex gap-3">
        <!-- Search -->
        <input
          v-model="search"
          type="text"
          placeholder="Cari pengajuan..."
          class="px-4 py-2 border rounded-lg w-64 
                 dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                 focus:ring focus:ring-blue-200"
        />

        <!-- Button -->
        <a href="/pengajuan/create"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
          + Tambah
        </a>
      </div>
    </div>

    <!-- SUCCESS -->
    <div v-if="page.props.flash?.success"
         class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
      {{ page.props.flash.success }}
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl">
      <table class="w-full text-sm text-left">

        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs">
          <tr>
            <th class="p-4">No Bukti</th>
            <th class="p-4">Tanggal</th>
            <th class="p-4">Kode Pengajuan</th>
            <th class="p-4">Keperluan</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="d in filteredData"
            :key="d.id"
            class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
          >
            <td class="p-4 font-medium">
              {{ d.kas_bukti_no || '-' }}
            </td>

            <td class="p-4">
              {{ d.kas_bukti_date || '-' }}
            </td>

            <td class="p-4">
              {{ d.pj_code || '-' }}
            </td>

            <td class="p-4">
              {{ d.kas_keperluan || '-' }}
            </td>

            <td class="p-4 text-center space-x-2">
              <a :href="`/pengajuan/${d.id}/edit`"
              class="px-3 py-1 bg-yellow-400 text-white rounded">
              Edit
            </a>
              <button
                @click="hapus(d.id)"
                class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg"
              >
                Hapus
              </button>
            </td>
          </tr>

          <tr v-if="filteredData.length === 0">
            <td colspan="5" class="text-center p-6 text-gray-400">
              Data tidak ditemukan
            </td>
          </tr>

        </tbody>

      </table>
    </div>

  </div>
</div>

</AuthenticatedLayout>
</template>