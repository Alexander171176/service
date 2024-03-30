<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'
</script>

<template>
  <AppLayout title="Панель управления">
    <template #header>
        <TitlePage>
            Главная
        </TitlePage>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">

        </div>
      </div>
    </div>
  </AppLayout>
</template>
