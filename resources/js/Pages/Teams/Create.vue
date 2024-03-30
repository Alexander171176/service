<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import CreateTeamForm from '@/Pages/Teams/Partials/CreateTeamForm.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'
</script>

<template>
  <AdminLayout title="Create Team">
    <template #header>
        <TitlePage>
            Создать Группу
        </TitlePage>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <CreateTeamForm />
      </div>
    </div>
  </AdminLayout>
</template>
