<script setup>
    import { onMounted, ref, watch } from 'vue';
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Link } from '@inertiajs/vue3';
    import DashboardAside from '@/Components/DashboardAside.vue';
    import DashboardNavbar from '@/Components/DashboardNavbar.vue';
    import DashboardConfig from '@/Components/DashboardConfig.vue';
    import ArgonSwitchButton from '@/Components/ArgonSwitchButton.vue';
    import { useDark, useToggle } from '@vueuse/core'



    const isDashboardConfigActive = ref( false )

    const handleToggleDashboardConfig = () =>
    {
        isDashboardConfigActive.value = !isDashboardConfigActive.value
    }

    //Dark Mode
    const isDark = useDark()
    const toggleDark = useToggle( isDark )

    //Navbar Fixed
    const isNavbarFixed = ref( false )

    const toggleNavbarFixed = () => isNavbarFixed.value = !isNavbarFixed.value

    watch( isNavbarFixed, ( newValue ) =>
    {
        localStorage.setItem('navbar-fixed-status', JSON.stringify(newValue))
    } )


    onMounted( () =>
    {
        const navbarFixedStatus = localStorage.getItem( 'navbar-fixed-status' )

        if ( navbarFixedStatus !== null )
        {
            isNavbarFixed.value = JSON.parse(navbarFixedStatus)
        }
    })









</script>

<template>
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <DashboardAside />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
        <DashboardNavbar :isNavbarFixed/>

        <slot />
    </main>

    <DashboardConfig :isDashboardConfigActive @dashboardConfigTrigger="handleToggleDashboardConfig">

        <template #navbarfixed>

            <ArgonSwitchButton name="navbarfixed" v-model:checked="isNavbarFixed" @click="toggleNavbarFixed"/>

        </template>

        <template #darkmode>

            <ArgonSwitchButton name="darkmode" v-model:checked="isDark" @click="toggleDark"/>
        </template>

    </DashboardConfig>
</template>
