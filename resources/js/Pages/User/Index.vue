<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { router } from '@inertiajs/vue3'

defineProps({ users: Array })

const hapus = (id) => {
  if (confirm('Yakin hapus user?')) {
    router.delete(`/user/${id}`)
  }
}
</script>

<template>
  <AuthenticatedLayout>

    <div class="p-6">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <div class="flex justify-between mb-4">
          <h1 class="text-xl font-bold">User</h1>
          <a href="/user/create" class="bg-blue-500 text-white px-3 py-1 rounded">
            + Tambah
          </a>
        </div>

        <table class="w-full border">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="u in users" :key="u.id">
              <td>{{ u.name }}</td>
              <td>{{ u.email }}</td>
              <td>{{ u.roles[0]?.name }}</td>
              <td>
                <a :href="`/user/${u.id}/edit`">Edit</a> |
                <button @click="hapus(u.id)">Hapus</button>
              </td>
            </tr>
          </tbody>

        </table>

      </div>
    </div>

  </AuthenticatedLayout>
</template>