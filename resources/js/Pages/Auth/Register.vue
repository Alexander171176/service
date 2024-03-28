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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    })
}
</script>

<template>
    <Head title="Регистрация"/>

    <div class="flex flex-row flex-wrap w-full">

        <div class="w-full md:w-1/2">
            <div class="min-h-screen h-full flex flex-col justify-center items-center">
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
                                <InputLabel for="name" value="Имя"/>
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
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
                                    autocomplete="new-password"
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Повторите пароль"/>
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="new-password"
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                            </div>

                            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                                <InputLabel for="terms">
                                    <div class="flex items-center">
                                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required/>

                                        <div class="ms-2">
                                            Я согласен,
                                            <a
                                                target="_blank"
                                                :href="route('terms.show')"
                                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >с условиями обслуживания</a
                                            >
                                            и
                                            <a
                                                target="_blank"
                                                :href="route('policy.show')"
                                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >политикой конфиденциальности</a
                                            >
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.terms"/>
                                </InputLabel>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    class="ms-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Регистрация
                                </PrimaryButton>
                            </div>
                        </form>

                        <!-- Footer -->
                        <div class="pt-5 mt-6 border-t border-slate-200">
                            <div class="text-center text-lg">
                                Уже зарегистрированы ?
                                <Link
                                    :href="route('login')"
                                    class="border-b-[2px] text-lg text-sky-600 hover:text-sky-900"
                                >
                                    Вход
                                </Link>
                            </div>
                        </div>
                        <!-- Warning -->
                        <div class="mt-5">
                            <div class="bg-amber-100 text-amber-600 px-3 py-2 rounded">
                                <svg class="inline w-3 h-3 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                                    <path
                                        d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z"/>
                                </svg>
                                <span class="text-sm">
                                        Необходимо заполнить все поля
                                    </span>
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
