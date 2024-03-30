<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Welcome from '@/Components/Welcome.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'
</script>

<template>
  <AdminLayout title="Администратор">
    <template #header>
        <TitlePage>
            Панель управления
        </TitlePage>
    </template>

      <div class="py-8">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">
                  <Welcome />
              </div>
          </div>
      </div>
  </AdminLayout>
</template>
