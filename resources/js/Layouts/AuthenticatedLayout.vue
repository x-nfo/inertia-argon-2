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
    import ArgonTransparentButton from '@/Components/ArgonTransparentButton.vue';



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

    //Sidenav Type
    const isSidenavDark = ref( false )
    const toggleSidenavType = () => isSidenavDark.value = !isSidenavDark.value

    watch( isSidenavDark, ( newValue ) =>
    {
        localStorage.setItem('sidenav-type-status', JSON.stringify(newValue))
    } )






    onMounted( () =>
    {
        const navbarFixedStatus = localStorage.getItem( 'navbar-fixed-status' )

        if ( navbarFixedStatus !== null )
        {
            isNavbarFixed.value = JSON.parse(navbarFixedStatus)
        }


        const sidenavTypeStatus = localStorage.getItem( 'sidenav-type-status' )

        if ( sidenavTypeStatus !== null )
        {
            isSidenavDark.value = JSON.parse(sidenavTypeStatus)
        }
    })









</script>

<template>
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <DashboardAside :isSidenavDark  />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
        <DashboardNavbar :isNavbarFixed/>

        <slot />
    </main>

    <DashboardConfig :isDashboardConfigActive @dashboardConfigTrigger="handleToggleDashboardConfig">

        <template #sidenavType>

           <ArgonTransparentButton :active="!isSidenavDark" text="White" @click="toggleSidenavType" />

           <ArgonTransparentButton :active="isSidenavDark" text="Dark" @click="toggleSidenavType" />


        </template>

        <template #navbarFixed>

            <ArgonSwitchButton name="navbarfixed" v-model:checked="isNavbarFixed" @click="toggleNavbarFixed"/>

        </template>

        <template #darkMode>

            <ArgonSwitchButton name="darkmode" v-model:checked="isDark" @click="toggleDark"/>
        </template>

    </DashboardConfig>
</template>
