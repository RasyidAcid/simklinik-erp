<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({ roles: Array })

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: ''
})

const submit = () => {
  form.post('/user')
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
      <h1 class="text-xl mb-4">Tambah User</h1>

      <form @submit.prevent="submit" class="space-y-3">

        <input v-model="form.name" placeholder="Nama" class="w-full border p-2" />
        <input v-model="form.email" placeholder="Email" class="w-full border p-2" />
        <input v-model="form.password" type="password" placeholder="Password" class="w-full border p-2" />

        <select v-model="form.role" class="w-full border p-2">
          <option value="">-- pilih role --</option>
          <option v-for="r in roles" :value="r.name">{{ r.name }}</option>
        </select>

        <button class="bg-blue-500 text-white px-4 py-2">Simpan</button>

      </form>
    </div>

  </AuthenticatedLayout>
</template>