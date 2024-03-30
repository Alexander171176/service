<script setup>
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'

defineProps({
  tokens: Array,
  availablePermissions: Array,
  defaultPermissions: Array
})
</script>

<template>
  <AdminLayout title="API Tokens">
    <template #header>
        <TitlePage>
            API Токены
        </TitlePage>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <ApiTokenManager
          :tokens="tokens"
          :available-permissions="availablePermissions"
          :default-permissions="defaultPermissions"
        />
      </div>
    </div>
  </AdminLayout>
</template>
