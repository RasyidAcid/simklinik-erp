<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  data: Object
})

const form = useForm({
  kode_rekening: props.data.kode_rekening,
  nama_rekening: props.data.nama_rekening
})

const submit = () => {
  form.put(`/rekening/${props.data.id}`)
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-6">
      <h1 class="text-2xl font-bold mb-6 text-gray-700">
        Edit Rekening
      </h1>

      <form @submit.prevent="submit" class="space-y-5">

        <div>
          <label class="block text-sm text-gray-600">Kode Rekening</label>
          <input v-model="form.kode_rekening"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400" />
          <p v-if="form.errors.kode_rekening" class="text-red-500 text-sm">
            {{ form.errors.kode_rekening }}
          </p>
        </div>

        <div>
          <label class="block text-sm text-gray-600">Nama Rekening</label>
          <input v-model="form.nama_rekening"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400" />
          <p v-if="form.errors.nama_rekening" class="text-red-500 text-sm">
            {{ form.errors.nama_rekening }}
          </p>
        </div>

        <div class="flex justify-end gap-3 pt-4">
          <a href="/rekening" class="px-4 py-2 bg-gray-200 rounded-lg">
            Batal
          </a>

          <button type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Update
          </button>
        </div>

      </form>
    </div>

  </AuthenticatedLayout>
</template>