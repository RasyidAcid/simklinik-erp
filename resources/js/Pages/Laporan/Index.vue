<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from 'vue'

const showPdf = ref(false)
const pdfUrl = ref('')
</script>

<template>
  <AuthenticatedLayout>

    <div class="p-6">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">
          Master Rekening
        </h1>

        <!-- CARD -->
        <div class="border rounded-lg p-4 flex justify-between items-center mb-6">

          <div>
            <h2 class="font-semibold text-lg">
              Laporan Master Rekening
            </h2>
            <p class="text-sm text-gray-500">
              Menampilkan seluruh data rekening
            </p>
          </div>

          <div class="flex gap-2">

            <!-- VIEW -->
            <button
              @click="() => { pdfUrl = '/laporan/rekening/pdf'; showPdf = true }"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
              Preview
            </button>

            <!-- DOWNLOAD -->
            <a href="/laporan/rekening/download"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
              Download
            </a>

          </div>

        </div>

        <!-- PDF VIEWER -->
        <div v-if="showPdf" class="mt-6">

          <h2 class="font-semibold mb-2">Preview PDF</h2>

          <iframe
            :src="pdfUrl"
            class="w-full h-[600px] border rounded-lg">
          </iframe>

        </div>

      </div>
    </div>

  </AuthenticatedLayout>
</template>