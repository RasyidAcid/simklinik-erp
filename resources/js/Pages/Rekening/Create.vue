<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
  kode_rekening: '',
  nama_rekening: ''
})

const submit = () => {
  form.post('/rekening')
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-6">
      <h1 class="text-2xl font-bold mb-6 text-gray-700">
        Tambah Rekening
      </h1>

      <form @submit.prevent="submit" class="space-y-5">

        <!-- Kode Rekening -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Kode Rekening
          </label>

          <input
            v-model="form.kode_rekening"
            type="text"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Contoh: 101"
          />

          <p v-if="form.errors.kode_rekening" class="text-red-500 text-sm mt-1">
            {{ form.errors.kode_rekening }}
          </p>
        </div>

        <!-- Nama Rekening -->
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">
            Nama Rekening
          </label>

          <input
            v-model="form.nama_rekening"
            type="text"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Contoh: Kas Besar"
          />

          <p v-if="form.errors.nama_rekening" class="text-red-500 text-sm mt-1">
            {{ form.errors.nama_rekening }}
          </p>
        </div>

        <!-- Button -->
        <div class="flex justify-end gap-3 pt-4">
          <a
            href="/rekening"
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