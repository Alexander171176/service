<script setup>
import {computed} from 'vue'
import {Head, Link, useForm} from '@inertiajs/vue3'
import ImageAuthentication from "@/Components/User/Image/ImageAuthentication.vue"
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import HeadingAuth from '@/Components/User/Heading/HeadingAuth.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    status: String
})

const form = useForm({})

const submit = () => {
    form.post(route('verification.send'))
}

const verificationLinkSent = computed(() => props.status === 'verification-link-sent')
</script>

<template>
    <Head title="Проверка электронной почты"/>
    <div class="flex flex-row flex-wrap w-full">
        <!-- Content -->
        <div class="w-full md:w-1/2">
            <div class="min-h-screen h-full flex flex-col justify-center items-center">

                <div v-if="verificationLinkSent" class="mb-4 font-medium text-md text-green-600">
                    Новая ссылка для подтверждения была отправлена на адрес электронной почты,
                    который вы указали в своем профиле настройки.
                </div>

                <div class="flex flex-col justify-center items-center max-w-sm mx-auto px-4 py-8">
                    <div class="mb-4 flex flex-col justify-center items-center">
                        <!-- Logo -->
                        <AuthenticationCardLogo/>
                    </div>
                    <div>

                        <!-- Heading -->
                        <HeadingAuth>Сброс пароля</HeadingAuth>

                        <div class="mb-4 font-semibold text-md text-gray-900">
                            Прежде чем продолжить, не могли бы вы подтвердить свой адрес электронной почты, перейдя по
                            ссылке,
                            которую мы только что отправили вам по электронной почте ?
                            Если вы не получили электронное письмо, мы с радостью отправим вам другое.
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submit">
                            <div class="mt-4 flex items-center justify-between">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Повторная верификация
                                </PrimaryButton>

                                <div>
                                    <Link
                                        :href="route('profile.show')"
                                        class="underline text-md text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Редактировать профиль
                                    </Link
                                    >

                                    <Link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        class="underline text-md text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2"
                                    >
                                        Выход
                                    </Link>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Image -->
        <ImageAuthentication/>
    </div>
</template>
