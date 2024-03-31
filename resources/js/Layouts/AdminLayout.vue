<script setup>
import {ref} from 'vue'
import {Head, Link, router} from '@inertiajs/vue3'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import Sidebar from '@/Partials/Admin/Sidebar.vue'
import ApplicationMark from '@/Components/ApplicationMark.vue'
import ThemeToggle from '@/Components/User/ThemeToggle/ThemeToggle.vue'
import { usePermission } from '@/composables/permissions.js'

defineProps({
    title: String
})

const { HasRole } = usePermission();
const sidebarOpen = ref(false)
const showingNavigationDropdown = ref(false)

const switchToTeam = (team) => {
    router.put(
        route('current-team.update'),
        {
            team_id: team.id
        },
        {
            preserveState: false
        }
    )
}

const logout = () => {
    router.post(route('logout'))
}
</script>

<template>
    <Head :title="title"/>
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false"/>

        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden bg-gray-100 dark:bg-gray-900">

            <!-- Header -->
            <div
                class="sticky
                       top-0
                       bg-gray-300
                       dark:bg-gray-800
                       border-b border-slate-200
                       dark:border-slate-700
                       z-30">
                <nav class="border-b border-gray-100">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-full mx-auto px-4 sm:px-0">
                        <div class="flex justify-between h-16">

                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center sm:hidden sm:z-auto">
                                    <Link :href="route('dashboard')">
                                        <ApplicationMark class="block h-9 w-auto"/>
                                    </Link>
                                </div>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <div class="ms-3 relative">

                                    <!-- Teams Dropdown -->
                                    <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                        <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                  <button
                                                      type="button"
                                                      class="inline-flex
                                                             items-center
                                                             px-3 py-2
                                                             border
                                                             border-transparent
                                                             text-md
                                                             leading-4
                                                             font-medium
                                                             rounded-md
                                                             text-slate-500
                                                             bg-white
                                                             dark:bg-slate-500
                                                             dark:text-slate-100
                                                             hover:text-slate-700
                                                             focus:outline-none
                                                             focus:bg-gray-50
                                                             active:bg-gray-50
                                                             transition ease-in-out duration-150"
                                                  >
                                                    {{ $page.props.auth.user.current_team.name }}

                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                      <path
                                                          stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                                      />
                                                    </svg>
                                                  </button>
                                                </span>
                                        </template>

                                        <template #content>
                                            <div class="w-60">

                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-md text-slate-400">
                                                    Управление Группы
                                                </div>

                                                <!-- Team Settings -->
                                                <DropdownLink
                                                    :href="route('teams.show', $page.props.auth.user.current_team)">
                                                    Настройки Группы
                                                </DropdownLink>

                                                <DropdownLink
                                                    v-if="$page.props.jetstream.canCreateTeams"
                                                    :href="route('teams.create')"
                                                >
                                                    Создать новую Группу
                                                </DropdownLink>

                                                <!-- Team Switcher -->
                                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                    <div class="w-60 border-t border-gray-200"/>

                                                    <div class="block px-4 py-2 text-md text-slate-400">
                                                        Переключение Группы
                                                    </div>

                                                    <template v-for="team in $page.props.auth.user.all_teams"
                                                              :key="team.id">
                                                        <form @submit.prevent="switchToTeam(team)">
                                                            <DropdownLink as="button">
                                                                <div class="flex items-center">
                                                                    <svg
                                                                        v-if="team.id == $page.props.auth.user.current_team_id"
                                                                        class="me-2 h-5 w-5 text-green-400"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none"
                                                                        viewBox="0 0 24 24"
                                                                        stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                    >
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                        />
                                                                    </svg>

                                                                    <div>{{ team.name }}</div>
                                                                </div>
                                                            </DropdownLink>
                                                        </form>
                                                    </template>
                                                </template>
                                            </div>
                                        </template>
                                    </Dropdown>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="60">
                                        <template #trigger>
                                            <button
                                                v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="flex text-md
                                                   border-2 border-transparent
                                                   rounded-full
                                                   focus:outline-none focus:border-gray-300
                                                   transition"
                                            >
                                                <img
                                                    class="h-8 w-8 rounded-full object-cover"
                                                    :src="$page.props.auth.user.profile_photo_url"
                                                    :alt="$page.props.auth.user.name"
                                                />
                                            </button>

                                            <span v-else class="inline-flex rounded-md">
                                              <button
                                                  type="button"
                                                  class="inline-flex
                                                         items-center
                                                         px-3 py-2
                                                         border border-transparent
                                                         text-md leading-4 font-medium
                                                         rounded-md text-slate-500
                                                         bg-white
                                                         hover:text-slate-700
                                                         focus:outline-none focus:bg-gray-50
                                                         active:bg-gray-50
                                                         transition ease-in-out duration-150"
                                              >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                >
                                                  <path
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                  />
                                                </svg>
                                              </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-md text-slate-400">Управление Аккаунтом
                                            </div>

                                            <DropdownLink :href="route('profile.show')"> Профиль</DropdownLink>

                                            <DropdownLink
                                                v-if="$page.props.jetstream.hasApiFeatures"
                                                :href="route('api-tokens.index')"
                                            >
                                                API Tokens
                                            </DropdownLink>

                                            <div class="border-t border-gray-200"/>

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button"> Выход</DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>

                                <!-- ThemeToggle -->
                                <div class="mx-2 flex items-center">
                                    <ThemeToggle/>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button
                                    class="inline-flex
                                       items-center
                                       justify-center
                                       p-2 rounded-md
                                       text-slate-400
                                       hover:text-slate-500
                                       hover:bg-gray-100
                                       focus:outline-none
                                       focus:bg-gray-100
                                       focus:text-slate-500
                                       transition duration-150 ease-in-out"
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                >
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path
                                            :class="{
                                              hidden: showingNavigationDropdown,
                                              'inline-flex': !showingNavigationDropdown
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                              hidden: !showingNavigationDropdown,
                                              'inline-flex': showingNavigationDropdown
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Панель управления
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('admin')" :active="route().current('admin')">
                                Панель Администратора
                            </ResponsiveNavLink>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="flex items-center px-4">
                                <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        :src="$page.props.auth.user.profile_photo_url"
                                        :alt="$page.props.auth.user.name"
                                    />
                                </div>

                                <div>
                                    <div class="font-medium text-base text-slate-800">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="font-medium text-md text-slate-500">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink
                                    :href="route('profile.show')"
                                    :active="route().current('profile.show')"
                                >
                                    Профиль
                                </ResponsiveNavLink>

                                <ResponsiveNavLink
                                    v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')"
                                    :active="route().current('api-tokens.index')"
                                >
                                    API Tokens
                                </ResponsiveNavLink>

                                <!-- Authentication -->
                                <form method="POST" @submit.prevent="logout">
                                    <ResponsiveNavLink as="button"> Выход</ResponsiveNavLink>
                                </form>

                                <!-- Team Management -->
                                <template v-if="$page.props.jetstream.hasTeamFeatures">
                                    <div class="border-t border-gray-200"/>

                                    <div class="block px-4 py-2 text-md text-slate-400">Управление Группы</div>

                                    <!-- Team Settings -->
                                    <ResponsiveNavLink
                                        :href="route('teams.show', $page.props.auth.user.current_team)"
                                        :active="route().current('teams.show')"
                                    >
                                        Настройки Группы
                                    </ResponsiveNavLink>

                                    <ResponsiveNavLink
                                        v-if="$page.props.jetstream.canCreateTeams"
                                        :href="route('teams.create')"
                                        :active="route().current('teams.create')"
                                    >
                                        Создать новую Группу
                                    </ResponsiveNavLink>

                                    <!-- Team Switcher -->
                                    <template v-if="$page.props.auth.user.all_teams.length > 1">
                                        <div class="border-t border-gray-200"/>

                                        <div class="block px-4 py-2 text-md text-slate-400">Переключение Группы</div>

                                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                            <form @submit.prevent="switchToTeam(team)">
                                                <ResponsiveNavLink as="button">
                                                    <div class="flex items-center">
                                                        <svg
                                                            v-if="team.id == $page.props.auth.user.current_team_id"
                                                            class="me-2 h-5 w-5 text-green-400"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            />
                                                        </svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </ResponsiveNavLink>
                                            </form>
                                        </template>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-slate-100 dark:bg-sky-900 shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-4 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main class="dark:bg-gray-900">
                <slot/>
            </main>

        </div>
    </div>
</template>
