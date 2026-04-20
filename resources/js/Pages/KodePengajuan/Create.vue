<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
  pj_code: '',
  pj_sub_code: '', // tetap ada tapi hidden
  pj_name: '',
  pj_ket: '',
  cab_code: '',
  usaha_code: '',
  gud_code: '',
  saldo: 0,
})

const submit = () => {
  form.post('/kode-pengajuan')
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
      <h1 class="text-2xl font-bold mb-6 text-gray-700 dark:text-gray-200">
        Tambah Kode Pengajuan
      </h1>

      <form @submit.prevent="submit" class="space-y-5">

        <!-- Hidden Sub Code -->
        <input type="hidden" v-model="form.pj_sub_code" />

        <!-- Kode Pengajuan -->
        <div>
          <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
            Kode Pengajuan
          </label>
          <input
            v-model="form.pj_code"
            type="text"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Contoh: PJ001"
          />
          <p v-if="form.errors.pj_code" class="text-red-500 text-sm mt-1">
            {{ form.errors.pj_code }}
          </p>
        </div>

        <!-- Nama -->
        <div>
          <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
            Nama Pengajuan
          </label>
          <input
            v-model="form.pj_name"
            type="text"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Contoh: Pengajuan Operasional"
          />
          <p v-if="form.errors.pj_name" class="text-red-500 text-sm mt-1">
            {{ form.errors.pj_name }}
          </p>
        </div>

        <!-- Keterangan -->
        <div>
          <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
            Keterangan
          </label>
          <textarea
            v-model="form.pj_ket"
            rows="3"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Isi keterangan pengajuan..."
          ></textarea>
          <p v-if="form.errors.pj_ket" class="text-red-500 text-sm mt-1">
            {{ form.errors.pj_ket }}
          </p>
        </div>

        <!-- Grid tambahan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Cabang</label>
            <input v-model="form.cab_code" type="text"
              class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
          </div>

          <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Usaha</label>
            <input v-model="form.usaha_code" type="text"
              class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
          </div>

          <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Gudang</label>
            <input v-model="form.gud_code" type="text"
              class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
          </div>

          <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Saldo</label>
            <input v-model="form.saldo" type="number"
              class="w-full border rounded-lg px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"/>
          </div>

        </div>

        <!-- Button -->
        <div class="flex justify-end gap-3 pt-4">
          <a
            href="/kode-pengajuan"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
          >
            Batal
          </a>

          <button
            type="submit"
            :disabled="form.processing"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50"
          >
            {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
          </button>
        </div>

      </form>
    </div>

  </AuthenticatedLayout>
</template>