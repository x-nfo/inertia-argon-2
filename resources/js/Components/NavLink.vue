<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    bgColor: {
        type: String
    }
});

const classes = computed(() =>
    props.active
        ? ` ${props.bgColor} dark:text-white bg-blue-500/13 dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors rounded-lg`
        : 'dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
