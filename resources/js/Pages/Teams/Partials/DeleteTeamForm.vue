<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ActionSection from '@/Components/ActionSection.vue'
import ConfirmationModal from '@/Components/ConfirmationModal.vue'
import DangerButton from '@/Components/DangerButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
  team: Object
})

const confirmingTeamDeletion = ref(false)
const form = useForm({})

const confirmTeamDeletion = () => {
  confirmingTeamDeletion.value = true
}

const deleteTeam = () => {
  form.delete(route('teams.destroy', props.team), {
    errorBag: 'deleteTeam'
  })
}
</script>

<template>
  <ActionSection>
    <template #title> Удаление группы </template>

    <template #description> Безвозвратно удалить эту группу. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
          Как только группа будет удалена, все ее ресурсы и данные будут удалены безвозвратно.
          Перед удалением этой группы, пожалуйста, загрузите любые данные или информацию об этой команде,
          которые вы хотите сохранить.
      </div>

      <div class="mt-5">
        <DangerButton @click="confirmTeamDeletion"> Удалить группу </DangerButton>
      </div>

      <!-- Delete Team Confirmation Modal -->
      <ConfirmationModal :show="confirmingTeamDeletion" @close="confirmingTeamDeletion = false">
        <template #title> Удаление группы </template>

        <template #content>
            Вы уверены, что хотите удалить эту группу? Как только группа будет удалена, все ее ресурсы
            и данные будут удалены безвозвратно.
        </template>

        <template #footer>
          <SecondaryButton @click="confirmingTeamDeletion = false"> Отмена </SecondaryButton>

          <DangerButton
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteTeam"
          >
            Удалить группу
          </DangerButton>
        </template>
      </ConfirmationModal>
    </template>
  </ActionSection>
</template>
