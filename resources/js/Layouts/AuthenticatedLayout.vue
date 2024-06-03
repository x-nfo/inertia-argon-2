<script setup>
import { ref, watchEffect } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import DashboardAside from '@/Components/DashboardAside.vue';
import DashboardNavbar from '@/Components/DashboardNavbar.vue';

const isSidenavActive = ref(false);

const handleToggleSidenav = () => {
    isSidenavActive.value = !isSidenavActive.value;
};

watchEffect(() => {
    console.log('From AutLayout' + ' ' + isSidenavActive.value);
});
</script>

<template>
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <DashboardAside />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
        <DashboardNavbar
            :isSidenavActive="isSidenavActive"
            @sidenavTrigger="handleToggleSidenav"
        />
        <slot />
    </main>
</template>
