<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const page = usePage()

const dark = ref(false)

onMounted(() => {
  dark.value = document.documentElement.classList.contains('dark')
})

const toggleDark = () => {
  dark.value = !dark.value

  if (dark.value) {
    document.documentElement.classList.add('dark')
    localStorage.theme = 'dark'
  } else {
    document.documentElement.classList.remove('dark')
    localStorage.theme = 'light'
  }
}

// ✅ FIX CEK ROLE ADMIN
const isAdmin = () => {
  return page.props.auth.user?.roles?.some(r => r.name === 'admin')
}
</script>

<template>
  <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-800 dark:bg-gray-950 text-white">

      <div class="p-4 text-lg font-bold border-b border-gray-700">
        ERP APP
      </div>

      <nav class="p-4 space-y-2">

        <Link href="/dashboard"
          :class="[
            'block p-2 rounded',
            page.url.startsWith('/dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700'
          ]">
          Dashboard
        </Link>

        <Link href="/rekening"
          :class="[
            'block p-2 rounded',
            page.url.startsWith('/rekening') ? 'bg-gray-700' : 'hover:bg-gray-700'
          ]">
          Master Rekening
        </Link>

        <Link href="/pengajuan"
          :class="[
            'block p-2 rounded',
            page.url.startsWith('/pengajuan') ? 'bg-gray-700' : 'hover:bg-gray-700'
          ]">
          Pengajuan
        </Link>

        <Link href="/laporan"
          :class="[
            'block p-2 rounded',
            page.url.startsWith('/laporan') ? 'bg-gray-700' : 'hover:bg-gray-700'
          ]">
          Laporan
        </Link>

        <!-- ✅ MASTER USER (ADMIN ONLY) -->
        <Link v-if="isAdmin()"
          href="/user"
          :class="[
            'block p-2 rounded',
            page.url.startsWith('/user') ? 'bg-gray-700' : 'hover:bg-gray-700'
          ]">
          Master User
        </Link>

      </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

      <!-- NAVBAR -->
      <header class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow p-4 flex justify-between">
        <h1 class="font-semibold">ERP System</h1>

        <div class="flex items-center gap-4">

          <!-- Dark Mode -->
          <button @click="toggleDark"
            class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700">
            <span v-if="dark">🌙</span>
            <span v-else>☀️</span>
          </button>

          <span>{{ $page.props.auth.user.name }}</span>

          <Link href="/logout" method="post" as="button" class="text-red-500">
            Logout
          </Link>
        </div>
      </header>

      <!-- CONTENT -->
      <main class="p-6 overflow-y-auto text-gray-700 dark:text-gray-200">
        <slot />
      </main>

    </div>
  </div>
</template>