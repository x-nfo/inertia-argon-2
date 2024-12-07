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
     activeBgColor: {
        type: String,
        default: 'bg-blue-500/13'
    },
});

const classes = computed(() =>
    props.active
        ? `${props.activeBgColor} rounded-lg font-semibold text-slate-700`
        : ''
);
</script>

<template>
    <Link
        :href="href"
        :class="classes"
        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors "
    >
        <slot />
    </Link>
</template>
