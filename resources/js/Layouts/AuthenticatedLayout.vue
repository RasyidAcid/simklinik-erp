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

const isAdmin = () => {
  return page.props.auth.user?.roles?.some(r => r.name === 'admin')
}

// Toggle menu group
const openMenu = ref({ master: true, transaksi: true })

const toggleMenu = (menu) => {
  openMenu.value[menu] = !openMenu.value[menu]
}
</script>

<template>
<div class="flex h-screen bg-gray-100 dark:bg-gray-900">

  <!-- SIDEBAR -->
  <aside class="w-64 bg-gray-800 dark:bg-gray-950 text-white">

    <div class="p-4 text-lg font-bold border-b border-gray-700">
      ERP KLINIK
    </div>

    <nav class="p-4 space-y-3 text-sm">

      <!-- Dashboard -->
      <Link href="/dashboard"
        :class="['block p-2 rounded', page.url.startsWith('/dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700']">
        Dashboard
      </Link>

      <!-- MASTER MENU -->
      <div>
        <button @click="toggleMenu('master')"
          class="w-full text-left p-2 rounded hover:bg-gray-700 flex justify-between">
          <span>Master Data</span>
          <span>{{ openMenu.master ? '-' : '+' }}</span>
        </button>

        <div v-show="openMenu.master" class="ml-3 mt-2 space-y-1">
          <Link href="/rekening"
            :class="['block p-2 rounded', page.url.startsWith('/rekening') ? 'bg-gray-700' : 'hover:bg-gray-700']">
            Rekening
          </Link>

          <Link href="/kode-pengajuan"
            :class="['block p-2 rounded', page.url.startsWith('/kode-pengajuan') ? 'bg-gray-700' : 'hover:bg-gray-700']">
            Kode Pengajuan
          </Link>

          <Link v-if="isAdmin()" href="/user"
            :class="['block p-2 rounded', page.url.startsWith('/user') ? 'bg-gray-700' : 'hover:bg-gray-700']">
            User
          </Link>
        </div>
      </div>

      <!-- TRANSAKSI MENU -->
      <div>
        <button @click="toggleMenu('transaksi')"
          class="w-full text-left p-2 rounded hover:bg-gray-700 flex justify-between">
          <span>Transaksi</span>
          <span>{{ openMenu.transaksi ? '-' : '+' }}</span>
        </button>

        <div v-show="openMenu.transaksi" class="ml-3 mt-2 space-y-1">
          <Link href="/pengajuan"
            :class="['block p-2 rounded', page.url.startsWith('/pengajuan') ? 'bg-gray-700' : 'hover:bg-gray-700']">
            Pengajuan
          </Link>
        </div>
      </div>

      <!-- LAPORAN -->
      <Link href="/laporan"
        :class="['block p-2 rounded', page.url.startsWith('/laporan') ? 'bg-gray-700' : 'hover:bg-gray-700']">
        Laporan
      </Link>

    </nav>
  </aside>

  <!-- MAIN -->
  <div class="flex-1 flex flex-col">

    <!-- NAVBAR -->
    <header class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow p-4 flex justify-between">
      <h1 class="font-semibold">ERP System</h1>

      <div class="flex items-center gap-4">

        <button @click="toggleDark" class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700">
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