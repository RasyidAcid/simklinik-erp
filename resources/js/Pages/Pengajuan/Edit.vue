<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  data: Object
})

const form = useForm({
  kas_bukti_no: props.data.kas_bukti_no ?? '',
  kas_bukti_date: props.data.kas_bukti_date ?? '',
  pj_code: props.data.pj_code ?? '',
  kas_keperluan: props.data.kas_keperluan ?? '',
  kas_notes: props.data.kas_notes ?? '',
  details: props.data.details ?? []
})

const addRow = () => {
  form.details.push({
    bar_name: '',
    kas_jumlah: 0,
    kas_nilai: 0
  })
}

const removeRow = (i) => {
  form.details.splice(i, 1)
}

const submit = () => {
  form.put(`/pengajuan/${props.data.id}`)
}
</script>

<template>
<AuthenticatedLayout>

<div class="p-6">
  <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
      <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
        Edit Pengajuan
      </h1>

      <a href="/pengajuan"
         class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
        ← Kembali
      </a>
    </div>

    <!-- FORM HEADER -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

      <input v-model="form.kas_bukti_no"
        placeholder="No Bukti"
        class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring focus:ring-blue-200"/>

      <input v-model="form.kas_bukti_date"
        type="date"
        class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring focus:ring-blue-200"/>

      <input v-model="form.pj_code"
        placeholder="Kode Pengajuan"
        class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring focus:ring-blue-200"/>

      <input v-model="form.kas_keperluan"
        placeholder="Keperluan"
        class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring focus:ring-blue-200"/>

    </div>

    <!-- NOTES -->
    <div class="mb-6">
      <textarea v-model="form.kas_notes"
        rows="3"
        placeholder="Catatan..."
        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring focus:ring-blue-200"></textarea>
    </div>

    <!-- DETAIL HEADER -->
    <div class="flex justify-between items-center mb-3">
      <h2 class="font-semibold text-gray-700 dark:text-gray-200">
        Detail Pengajuan
      </h2>

      <button @click="addRow"
        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow">
        + Tambah Item
      </button>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl">
      <table class="w-full text-sm text-left">

        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs">
          <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Jumlah</th>
            <th class="p-3">Nilai</th>
            <th class="p-3">Total</th>
            <th class="p-3 text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="(d,i) in form.details"
              :key="i"
              class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="p-3">
              <input v-model="d.bar_name"
                class="w-full px-2 py-1 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
            </td>

            <td class="p-3">
              <input v-model="d.kas_jumlah" type="number"
                class="w-full px-2 py-1 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
            </td>

            <td class="p-3">
              <input v-model="d.kas_nilai" type="number"
                class="w-full px-2 py-1 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
            </td>

            <td class="p-3 font-medium">
              {{ d.kas_jumlah * d.kas_nilai }}
            </td>

            <td class="p-3 text-center">
              <button @click="removeRow(i)"
                class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded">
                Hapus
              </button>
            </td>
          </tr>

          <tr v-if="form.details.length === 0">
            <td colspan="5" class="text-center p-4 text-gray-400">
              Belum ada item
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <!-- ACTION -->
    <div class="mt-6 flex justify-end gap-3">
      <a href="/pengajuan"
         class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
        Batal
      </a>

      <button
        @click="submit"
        :disabled="form.processing"
        class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow disabled:opacity-50">
        {{ form.processing ? 'Mengupdate...' : 'Update' }}
      </button>
    </div>

  </div>
</div>

</AuthenticatedLayout>
</template>