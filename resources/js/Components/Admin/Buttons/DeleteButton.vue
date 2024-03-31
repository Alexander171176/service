<script setup>
import { Link } from '@inertiajs/vue3'
import { defineProps, ref } from 'vue'

const props = defineProps({
    href: {
        type: String,
        required: true
    }
})

const isPressed = ref(false)
</script>

<template>
    <Link :href="href"
          method="DELETE"
          as="button"
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
          @mousedown="isPressed = true"
          @mouseup="isPressed = false"
          :class="{ 'ring-2 ring-sky-600 ring-offset-2 ring-offset-white': isPressed }">
    <span class="hidden xs:block ml-2">
      <slot name="icon">
        <!-- По умолчанию ваш SVG будет тут -->
        <svg class="w-4 h-4 fill-current text-orange-500 shrink-0" viewBox="0 0 16 16">
            <path
                d="M5 7h2v6H5V7zm4 0h2v6H9V7zm3-6v2h4v2h-1v10c0 .6-.4 1-1 1H2c-.6 0-1-.4-1-1V5H0V3h4V1c0-.6.4-1 1-1h6c.6 0 1 .4 1 1zM6 2v1h4V2H6zm7 3H3v9h10V5z"/>
        </svg>
      </slot>
    </span>
        <span class="hidden xs:block ml-2">
      <slot />
    </span>
    </Link>
</template>
