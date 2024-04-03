<script setup>
import {useForm} from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'
import DefaultButton from '@/Components/Admin/Buttons/DefaultButton.vue'
import LabelInput from '@/Components/Admin/Input/LabelInput.vue'
import InputText from '@/Components/Admin/Input/InputText.vue'
import InputError from '@/Components/Admin/Input/InputError.vue'
import PrimaryButton from '@/Components/Admin/Buttons/PrimaryButton.vue'

const form = useForm({
    name: '',
})
</script>

<template>
    <AdminLayout title="Создать Разрешение">
        <template #header>
            <TitlePage>
                Создать Разрешение
            </TitlePage>
        </template>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <div class="sm:flex sm:justify-between sm:items-center mb-5">
                <!-- Кнопка назад -->
                <DefaultButton :href="route('permissions.index')">
                    <template #icon>
                        <!-- SVG -->
                        <svg class="w-4 h-4 fill-current text-slate-100 shrink-0 mr-2" viewBox="0 0 16 16">
                            <path d="M4.3 4.5c1.9-1.9 5.1-1.9 7 0 .7.7 1.2 1.7 1.4 2.7l2-.3c-.2-1.5-.9-2.8-1.9-3.8C10.1.4 5.7.4 2.9 3.1L.7.9 0 7.3l6.4-.7-2.1-2.1zM15.6 8.7l-6.4.7 2.1 2.1c-1.9 1.9-5.1 1.9-7 0-.7-.7-1.2-1.7-1.4-2.7l-2 .3c.2 1.5.9 2.8 1.9 3.8 1.4 1.4 3.1 2 4.9 2 1.8 0 3.6-.7 4.9-2l2.2 2.2.8-6.4z"></path>
                        </svg>
                    </template>
                    Назад
                </DefaultButton>

                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <!-- Datepicker built with flatpickr -->
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center bg-white dark:bg-slate-700 shadow-lg rounded-sm border border-slate-200 relative">
                    <form @submit.prevent="form.post(route('permissions.store'))" class="p-3 w-full md:w-1/2">
                        <div class="mb-3 flex flex-col items-start">
                            <LabelInput for="name" value="Название Разрешения *" />

                            <InputText
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                requireds
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <template #icon>
                                    <!-- SVG -->
                                    <svg class="w-4 h-4 fill-current text-slate-100" viewBox="0 0 16 16">
                                        <path d="M14.3 2.3L5 11.6 1.7 8.3c-.4-.4-1-.4-1.4 0-.4.4-.4 1 0 1.4l4 4c.2.2.4.3.7.3.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4-.4-.4-1-.4-1.4 0z"></path>
                                    </svg>
                                </template>

                                Создать
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
