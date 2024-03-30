<script setup>
import SidebarLink from '@/Components/Admin/Link/SidebarLink.vue'
</script>

<template>
    <SidebarLink :href="route('admin')"
                 :active="route().current('admin')">
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
    <SidebarLink v-if="$page.props.jetstream.hasApiFeatures"
                 :href="route('api-tokens.index')"
                 :active="route().current('api-tokens.index')">
        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
            <path class="fill-current text-blue-700" d="M4.418 19.612A9.092 9.092 0 0 1 2.59 17.03L.475 19.14c-.848.85-.536 2.395.743 3.673a4.413 4.413 0 0 0 1.677 1.082c.253.086.519.131.787.135.45.011.886-.16 1.208-.474L7 21.44a8.962 8.962 0 0 1-2.582-1.828Z"></path>
            <path class="fill-current text-blue-600" d="M10.034 13.997a11.011 11.011 0 0 1-2.551-3.862L4.595 13.02a2.513 2.513 0 0 0-.4 2.645 6.668 6.668 0 0 0 1.64 2.532 5.525 5.525 0 0 0 3.643 1.824 2.1 2.1 0 0 0 1.534-.587l2.883-2.882a11.156 11.156 0 0 1-3.861-2.556Z"></path>
            <path class="fill-current text-blue-400" d="M21.554 2.471A8.958 8.958 0 0 0 18.167.276a3.105 3.105 0 0 0-3.295.467L9.715 5.888c-1.41 1.408-.665 4.275 1.733 6.668a8.958 8.958 0 0 0 3.387 2.196c.459.157.94.24 1.425.246a2.559 2.559 0 0 0 1.87-.715l5.156-5.146c1.415-1.406.666-4.273-1.732-6.666Zm.318 5.257c-.148.147-.594.2-1.256-.018A7.037 7.037 0 0 1 18.016 6c-1.73-1.728-2.104-3.475-1.73-3.845a.671.671 0 0 1 .465-.129c.27.008.536.057.79.146a7.07 7.07 0 0 1 2.6 1.711c1.73 1.73 2.105 3.472 1.73 3.846Z"></path>
        </svg>
        <span
            class="text-lg font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
            API Tokens
        </span>
    </SidebarLink>
    <SidebarLink :href="route('teams.show', $page.props.auth.user.current_team)"
                 :active="route().current('teams.show')">
        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
            <path class="fill-current text-blue-600" d="M19.714 14.7l-7.007 7.007-1.414-1.414 7.007-7.007c-.195-.4-.298-.84-.3-1.286a3 3 0 113 3 2.969 2.969 0 01-1.286-.3z"></path>
            <path class="fill-current text-blue-400" d="M10.714 18.3c.4-.195.84-.298 1.286-.3a3 3 0 11-3 3c.002-.446.105-.885.3-1.286l-6.007-6.007 1.414-1.414 6.007 6.007z"></path>
            <path class="fill-current text-blue-600" d="M5.7 10.714c.195.4.298.84.3 1.286a3 3 0 11-3-3c.446.002.885.105 1.286.3l7.007-7.007 1.414 1.414L5.7 10.714z"></path>
            <path class="fill-current text-blue-400" d="M19.707 9.292a3.012 3.012 0 00-1.415 1.415L13.286 5.7c-.4.195-.84.298-1.286.3a3 3 0 113-3 2.969 2.969 0 01-.3 1.286l5.007 5.006z"></path>
        </svg>
        <span
            class="text-lg font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
            Настройки группы
        </span>
    </SidebarLink>
    <SidebarLink v-if="$page.props.jetstream.canCreateTeams"
                 :href="route('teams.create')"
                 :active="route().current('teams.create')">
        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
            <path class="fill-current text-blue-600" d="M8.07 16H10V8H8.07a8 8 0 110 8z"></path>
            <path class="fill-current text-blue-400" d="M15 12L8 6v5H0v2h8v5z"></path>
        </svg>
        <span
            class="text-lg font-medium ml-3 sm:opacity-0 sm:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
            Создать новую группу
        </span>
    </SidebarLink>
</template>
