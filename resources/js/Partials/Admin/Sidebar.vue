<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { defineProps, defineEmits } from 'vue'
import {Link} from '@inertiajs/vue3'
import ApplicationMark from '@/Components/ApplicationMark.vue'
import SidebarLink from '@/Components/Admin/Link/SidebarLink.vue'

const props = defineProps(['sidebarOpen'])
const emit = defineEmits()
const trigger = ref(null)
const sidebar = ref(null)
const sidebarExpanded = ref(localStorage.getItem('sidebar-expanded') === 'true')

const clickHandler = ({ target }) => {
    if (!sidebar.value || !trigger.value) return
    if (!props.sidebarOpen || sidebar.value.contains(target) || trigger.value.contains(target)) return
    emit('close-sidebar')
}

const keyHandler = ({ keyCode }) => {
    if (!props.sidebarOpen || keyCode !== 27) return
    emit('close-sidebar')
}

onMounted(() => {
    document.addEventListener('click', clickHandler)
    document.addEventListener('keydown', keyHandler)
})

onUnmounted(() => {
    document.removeEventListener('click', clickHandler)
    document.removeEventListener('keydown', keyHandler)
})

watch(sidebarExpanded, () => {
    localStorage.setItem('sidebar-expanded', sidebarExpanded.value)
})
</script>

<template>
    <div>
        <div class="fixed
                    inset-0
                    z-40
                    bg-cyan-900
                    dark:bg-gray-700
                    dark:border-r
                    dark:border-gray-600
                    bg-opacity-30
                    sm:hidden
                    sm:z-auto
                    transition-opacity duration-200"
             :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true"></div>

        <div id="sidebar" ref="sidebar" class="flex
                                               flex-col
                                               absolute
                                               z-40
                                               w-64
                                               p-4
                                               bg-cyan-900
                                               dark:bg-gray-700
                                               dark:border-r
                                               dark:border-gray-600
                                               left-0
                                               top-0
                                               sm:static
                                               sm:left-auto
                                               sm:top-auto
                                               sm:translate-x-0
                                               h-screen
                                               overflow-y-scroll
                                               sm:overflow-y-auto
                                               no-scrollbar
                                               sm:w-16
                                               sm:sidebar-expanded:!w-64 2xl:!w-64
                                               shrink-0
                                               transition-all duration-200 ease-in-out"
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

            <div class="flex justify-between items-center mb-10 pr-3 sm:px-0">
                <button ref="trigger" class="sm:hidden text-slate-500 hover:text-slate-400"
                        @click.stop="$emit('close-sidebar')" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Закрыть</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z"/>
                    </svg>
                </button>
                <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-9 w-auto"/>
                </Link>
                <span class="text-indigo-300 font-semibold text-lg hidden 2xl:block">Панель управления</span>
            </div>

            <div class="space-y-8">
                <div>
                    <h3 class="text-center text-md uppercase text-white font-semibold pl-3">
                        <span class="hidden sm:block sm:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
                        <span class="sm:hidden sm:sidebar-expanded:block 2xl:block">Страницы</span>
                    </h3>
                    <ul class="mt-3">
                        <!-- Ваш код ссылок -->
                        <SidebarLink :href="route('admin')" :active="route().current('admin')">
                            <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                <path class="fill-current text-blue-500"
                                      d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z"/>
                                <path class="fill-current text-blue-600"
                                      d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z"/>
                                <path class="fill-current text-blue-200"
                                      d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z"/>
                            </svg>
                            <span
                                class="font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                Панель Администратора
                            </span>
                        </SidebarLink>
                        <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                <path class="fill-current text-blue-600" d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z"></path>
                                <path class="fill-current text-blue-400" d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z"></path>
                            </svg>
                            <span
                                class="font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                Панель Пользователя
                            </span>
                        </SidebarLink>
                    </ul>
                </div>
            </div>

            <div class="pt-3 sm:inline-flex justify-end mt-auto">
                <div class="px-3 py-2">
                    <button @click.prevent="sidebarExpanded = !sidebarExpanded">
                        <span class="sr-only">Развернуть / свернуть боковую панель</span>
                        <svg :class="{ 'rotate-180': sidebarExpanded }" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                            <path class="text-slate-600" d="M3 23H1V1h2z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>

<style>
.sidebar-expanded {
    width: 16rem !important;
}
</style>
