```vue
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

// MODAL
const modalSetujui = ref(false)
const modalProses = ref(false)
const selectedId = ref(null)

const form = ref({
  nama: '',
  tanggal: ''
})

// FILTER
const filteredData = computed(() => {
  return (props.data || []).filter(item => {
    const no = (item.kas_bukti_no ?? '').toString().toLowerCase()
    const ket = (item.kas_keperluan ?? '').toString().toLowerCase()
    const key = search.value.toLowerCase()
    return no.includes(key) || ket.includes(key)
  })
})

// ACTION
const hapus = (id) => {
  if (confirm('Yakin hapus data ini?')) {
    router.delete(`/pengajuan/${id}`)
  }
}

const openSetujui = (id) => {
  selectedId.value = id
  form.value = { nama: '', tanggal: '' }
  modalSetujui.value = true
}

const openProses = (id) => {
  selectedId.value = id
  form.value = { nama: '', tanggal: '' }
  modalProses.value = true
}

const submitSetujui = () => {
  router.post(`/pengajuan/${selectedId.value}/setujui`, form.value, {
    onSuccess: () => modalSetujui.value = false
  })
}

const submitProses = () => {
  router.post(`/pengajuan/${selectedId.value}/proses`, form.value, {
    onSuccess: () => modalProses.value = false
  })
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
        <input v-model="search" placeholder="Cari..."
          class="px-4 py-2 border rounded-lg w-64 dark:bg-gray-700 dark:text-white"/>

        <a href="/pengajuan/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
          + Tambah
        </a>
      </div>
    </div>

    <!-- ALERT -->
    <div v-if="page.props.flash?.success"
         class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
      {{ page.props.flash.success }}
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl">
      <table class="w-full text-sm">

        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 text-xs uppercase">
          <tr>
            <th class="p-4">No Bukti</th>
            <th class="p-4">Keperluan</th>
            <th class="p-4">Status</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="d in filteredData" :key="d.id"
              class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

            <!-- DATA -->
            <td class="p-4 font-medium">{{ d.kas_bukti_no || '-' }}</td>
            <td class="p-4">{{ d.kas_keperluan || '-' }}</td>

            <!-- STATUS -->
            <td class="p-4">
              <div class="flex flex-col gap-2 text-xs">

                <!-- BARU -->
                <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700 w-fit">
                  📝 Baru ({{ d.created_at?.substring(0,10) || '-' }})
                </span>

                <!-- SETUJUI -->
                <span v-if="Number(d.status_setujui) === 1"
                  class="px-3 py-1 rounded-full bg-green-100 text-green-700 w-fit">
                  ✔ Disetujui ({{ d.date_setujui || '-' }})
                </span>

                <!-- PROSES -->
                <span v-if="Number(d.status_proses) === 1"
                  class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 w-fit">
                  ⚙ Diproses ({{ d.date_proses || '-' }})
                </span>

              </div>
            </td>

            <!-- AKSI -->
            <td class="p-4 text-center">
              <div class="flex flex-wrap justify-center gap-2">

                <!-- EDIT -->
                <a :href="`/pengajuan/${d.id}/edit`"
                  class="px-3 py-1 text-xs bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg shadow">
                  ✏️ Edit
                </a>

                <!-- DELETE -->
                <button @click="hapus(d.id)"
                  class="px-3 py-1 text-xs bg-red-500 hover:bg-red-600 text-white rounded-lg shadow">
                  🗑 Hapus
                </button>

                <!-- SETUJUI -->
                <button
                  v-if="Number(d.status_setujui) !== 1"
                  @click="openSetujui(d.id)"
                  class="px-3 py-1 text-xs bg-green-500 hover:bg-green-600 text-white rounded-lg shadow">
                  ✔ Setujui
                </button>

                <!-- PROSES -->
                <button
                  v-if="Number(d.status_setujui) === 1 && Number(d.status_proses) !== 1"
                  @click="openProses(d.id)"
                  class="px-3 py-1 text-xs bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">
                  ⚙ Proses
                </button>

              </div>
            </td>

          </tr>

          <tr v-if="filteredData.length === 0">
            <td colspan="4" class="text-center p-6 text-gray-400">
              Data tidak ditemukan
            </td>
          </tr>

        </tbody>

      </table>
    </div>

  </div>
</div>

<!-- MODAL SETUJUI -->
<div v-if="modalSetujui"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

  <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl w-96 shadow-2xl">

    <!-- TITLE -->
    <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">
      Setujui Pengajuan
    </h2>

    <!-- NAMA ADMIN -->
    <div class="mb-3">
      <label class="text-sm text-gray-600 dark:text-gray-300">Nama Admin</label>
      <input
        v-model="form.nama"
        placeholder="Masukkan nama admin"
        class="w-full mt-1 border px-3 py-2 rounded-lg 
               focus:ring focus:ring-blue-200 
               dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
    </div>

    <!-- TANGGAL -->
    <div class="mb-3">
      <label class="text-sm text-gray-600 dark:text-gray-300">Tanggal Setujui</label>
      <input
        v-model="form.tanggal"
        type="date"
        class="w-full mt-1 border px-3 py-2 rounded-lg 
               focus:ring focus:ring-blue-200
               dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
    </div>

    <!-- STATUS DIPERIKSA -->
    <div class="mb-4">
      <label class="text-sm text-gray-600 dark:text-gray-300">Status Diperiksa</label>

      <select
        v-model="form.status_periksa"
        class="w-full mt-1 border px-3 py-2 rounded-lg 
               focus:ring focus:ring-blue-200
               dark:bg-gray-700 dark:border-gray-600 dark:text-white">

        <option value="">-- Pilih Status --</option>
        <option value="YA">YA</option>
        <option value="TIDAK">TIDAK</option>
      </select>
    </div>

    <!-- ACTION -->
    <div class="flex justify-end gap-2">
      <button
        @click="modalSetujui=false"
        class="px-3 py-1 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
        Batal
      </button>

      <button
        @click="submitSetujui"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-lg text-sm shadow">
        Simpan
      </button>
    </div>

  </div>
</div>

<!-- MODAL PROSES -->
<div v-if="modalProses" class="fixed inset-0 bg-black/40 flex items-center justify-center">
  <div class="bg-white p-6 rounded-xl w-96 shadow-lg">
    <h2 class="font-bold mb-4">Proses Pengajuan</h2>

    <input v-model="form.nama" placeholder="Nama Admin"
      class="w-full border p-2 mb-3 rounded"/>

    <input v-model="form.tanggal" type="date"
      class="w-full border p-2 mb-3 rounded"/>

    <div class="flex justify-end gap-2">
      <button @click="modalProses=false">Batal</button>
      <button @click="submitProses"
        class="bg-blue-600 text-white px-3 py-1 rounded">
        Simpan
      </button>
    </div>
  </div>
</div>

</AuthenticatedLayout>
</template>
