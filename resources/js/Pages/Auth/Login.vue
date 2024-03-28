<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3'
import ImageAuthentication from "@/Components/User/Image/ImageAuthentication.vue"
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import HeadingAuth from '@/Components/User/Heading/HeadingAuth.vue'
import Checkbox from '@/Components/Checkbox.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
    canResetPassword: Boolean,
    status: String
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form
        .transform((data) => ({
            ...data,
            remember: form.remember ? 'on' : ''
        }))
        .post(route('login'), {
            onFinish: () => form.reset('password')
        })
}
</script>

<template>
    <Head title="Вход в систему"/>

        <div class="flex flex-row flex-wrap w-full">
            <!-- Content -->
            <div class="w-full md:w-1/2">
                <div class="min-h-screen h-full flex flex-col justify-center items-center">

                    <div v-if="status" class="w-full mb-4 font-medium text-md text-green-600">
                        {{ status }}
                    </div>

                    <div class="flex flex-col justify-center items-center max-w-sm mx-auto px-4 py-8">

                        <div class="mb-4 flex flex-col justify-center items-center">
                            <!-- Logo -->
                            <AuthenticationCardLogo/>
                        </div>

                        <div>

                            <!-- Heading -->
                            <HeadingAuth>Вход пользователя</HeadingAuth>

                            <!-- Form -->
                            <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Пароль"/>
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="current-password"
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.remember" name="remember"/>
                                    <span class="ms-2 text-md text-gray-600">Запомнить меня</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="border-b-[2px] text-lg text-sky-600 hover:text-sky-900"
                                >
                                    Забыли свой пароль?
                                </Link>

                                <PrimaryButton
                                    class="ms-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Вход
                                </PrimaryButton>
                            </div>
                        </form>

                            <!-- Footer -->
                            <div class="pt-5 mt-6 border-t border-slate-200">
                                <div class="text-center text-lg">
                                    Зарегистрироваться в системе ?

                                    <Link
                                        :href="route('register')"
                                        class="border-b-[2px] text-lg text-sky-600 hover:text-sky-900"
                                    >
                                        Регистрация
                                    </Link>
                                </div>
                                <!-- Warning -->
                                <div class="mt-5">
                                    <div class="bg-amber-100 text-amber-600 px-3 py-2 rounded">
                                        <svg class="inline w-3 h-3 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                                            <path
                                                d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                        </svg>
                                        <span class="text-sm">
                                                Для входа в систему требуется ввести email и пароль зарегистрированного аккаунта.
                                            </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Image -->
            <ImageAuthentication/>
        </div>

</template>
