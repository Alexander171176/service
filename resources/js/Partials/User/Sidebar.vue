<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import { defineProps, defineEmits } from 'vue'
import {Link} from '@inertiajs/vue3'
import ApplicationMark from '@/Components/ApplicationMark.vue'
import SidebarGroupLink from '@/Components/User/Link/SidebarGroupLink.vue'

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
                        <!-- Группа ссылок -->
                        <SidebarGroupLink/>
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
