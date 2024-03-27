<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Components/Welcome.vue'
</script>

<template>
  <AppLayout title="Панель управления">
    <template #header>
        <h2 class="text-center font-semibold text-slate-800 text-xl leading-tight">Панель управления ✨</h2>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <Welcome />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
