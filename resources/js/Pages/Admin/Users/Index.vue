<script setup>
import {defineProps, ref} from 'vue'
import {useForm} from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import TitlePage from '@/Components/Admin/Headlines/TitlePage.vue'
import DefaultButton from '@/Components/Admin/Buttons/DefaultButton.vue'
import IconButton from '@/Components/Admin/Buttons/IconButton.vue'
import DangerModal from '@/Components/Admin/Modal/DangerModal.vue'

const props = defineProps(['users', 'usersCount']);
const tooltipButtonEdit = 'редактировать';

const form = useForm({})

const showConfirmDeleteModal = ref(false)
const confirmDelete = () => {
    showConfirmDeleteModal.value = true;
}
const closeModal = () => {
    showConfirmDeleteModal.value = false;
}
const deleteUser = (id) => {
    form.delete(route('users.destroy', id), {
        onSuccess: () => closeModal()
    });
}
</script>

<template>
    <AdminLayout title="Администратор">
        <template #header>
            <TitlePage>
                Пользователи
            </TitlePage>
        </template>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <div class="sm:flex sm:justify-between sm:items-center mb-5">
                <!-- Кнопка добавить -->
                <DefaultButton :href="route('users.create')">
                    <template #icon>
                        <!-- SVG -->
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path
                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path>
                        </svg>
                    </template>
                    Добавить Пользователя
                </DefaultButton>

                <!-- Right: Actions -->
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    <!-- Datepicker built with flatpickr -->
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-5 py-1 text-right">
                    <h2 class="font-semiboldtext-slate-800 dark:text-slate-100">
                        Всего: <span class="text-blue-500 dark:text-blue-200 font-medium">
                        {{ usersCount }}</span>
                    </h2>
                </div>
                <div class="bg-white dark:bg-cyan-700 shadow-lg rounded-sm border border-slate-200 relative">
                    <div class="overflow-x-auto">
                        <table v-if="usersCount > 0" class="table-auto w-full">
                            <thead
                                class="text-xs
                                       font-semibold
                                       uppercase
                                       text-slate-700
                                       dark:text-slate-100
                                       bg-slate-200
                                       dark:bg-cyan-900
                                       border
                                       border-solid
                                       border-gray-300">
                            <tr>
                                <!-- Заголовки столбцов -->
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                    <span class="sr-only">ID</span>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Имя</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="font-semibold text-center">Действия</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm dark:text-slate-100 divide-y divide-slate-200"
                                   v-for="user in users" :key="user.id">
                            <!-- Отображение сущностей -->
                            <tr class="border-b-2 hover:bg-slate-100 dark:hover:bg-cyan-500">
                                <td class="px-2 first:pl-5 last:pr-5 py-1 whitespace-nowrap px">
                                    <div class="text-left">{{ user.id }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-1 whitespace-nowrap">
                                    <div class="text-left">{{ user.name }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-1 whitespace-nowrap">
                                    <div class="text-left">{{ user.email }}</div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-1 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <IconButton :href="route('users.edit', user.id)"
                                                    :tooltip-text="tooltipButtonEdit">
                                            <template #svg>
                                                <!-- SVG -->
                                                <svg class="w-4 h-4
                                                            fill-current
                                                            text-teal-500
                                                            hover:text-sky-500
                                                            dark:text-violet-200
                                                            dark:hover:text-slate-100
                                                            shrink-0" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z"/>
                                                </svg>
                                            </template>
                                        </IconButton>
                                        <button @click="confirmDelete"
                                                class="btn
                                                       flex
                                                       items-center
                                                       py-2 px-2
                                                       border-solid
                                                       rounded
                                                       border
                                                       border-slate-300
                                                       hover:border-rose-500
                                                       dark:border-yellow-200
                                                       dark:hover:border-yellow-700"
                                                title="удалить">
                                            <svg class="w-4 h-4
                                                        fill-current
                                                        text-orange-400
                                                        hover:text-rose-500
                                                        dark:text-red-300
                                                        dark:hover:text-red-700
                                                        shrink-0"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M5 7h2v6H5V7zm4 0h2v6H9V7zm3-6v2h4v2h-1v10c0 .6-.4 1-1 1H2c-.6 0-1-.4-1-1V5H0V3h4V1c0-.6.4-1 1-1h6c.6 0 1 .4 1 1zM6 2v1h4V2H6zm7 3H3v9h10V5z"/>
                                            </svg>
                                        </button>
                                        <DangerModal :show="showConfirmDeleteModal" @close="closeModal">
                                            <button
                                                class="flex
                                                       items-center
                                                       btn
                                                       px-3 py-1
                                                       bg-sky-600
                                                       text-white
                                                       rounded-sm
                                                       shadow-md
                                                       transition-colors
                                                       duration-300
                                                       ease-in-out
                                                       hover:bg-sky-700
                                                       focus:bg-sky-700
                                                       focus:outline-none"
                                                @click="closeModal">Отмена
                                            </button>
                                            <button
                                                class="flex
                                                       items-center
                                                       btn
                                                       px-3 py-1
                                                       bg-rose-500
                                                       text-white
                                                       rounded-sm
                                                       shadow-md
                                                       transition-colors
                                                       duration-300
                                                       ease-in-out
                                                       hover:bg-rose-700
                                                       focus:bg-rose-700
                                                       focus:outline-none"
                                                    @click="$event => deleteUser(user.id)">Да,
                                                Удалить
                                            </button>
                                        </DangerModal>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
