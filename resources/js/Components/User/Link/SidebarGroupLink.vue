<script setup>
import SidebarLink from '@/Components/Admin/Link/SidebarLink.vue'
</script>

<template>
    <SidebarLink :href="route('dashboard')"
                 :active="route().current('dashboard')">
        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
            <path class="fill-current text-blue-500"
                  d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z"/>
            <path class="fill-current text-blue-600"
                  d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z"/>
            <path class="fill-current text-blue-200"
                  d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z"/>
        </svg>
        <span
            class="text-lg font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
            Главная
        </span>
    </SidebarLink>
    <SidebarLink :href="route('profile.show')" :active="route().current('profile.show')">
        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
            <path class="fill-current text-blue-600" d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z"></path>
            <path class="fill-current text-blue-400" d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z"></path>
        </svg>
        <span
            class="text-lg font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
            Мой Профиль
        </span>
    </SidebarLink>
</template>
