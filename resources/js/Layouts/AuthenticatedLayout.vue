<script setup>
    import { onMounted, onUpdated, ref, watch } from 'vue';
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
    import ArgonSidebarColors from '@/Components/ArgonSidebarColors.vue';


    const isMobileSidenavActive = ref( false )

    const toggleMobileSidenav = () =>
    {
        isMobileSidenavActive.value = !isMobileSidenavActive.value
    }




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


    //Sidebar Colors
    const selectedColor = ref( 'bg-blue-500/13' );

    const sidebarColors = [
        ['bg-blue-500/30', {from:'blue-500', to:'violet-500'}],
        ['bg-gray-500/30', {from:'zinc-800', to:'zinc-700'}],
        ['bg-cyan-500/30', {from:'blue-700', to:'cyan-500'}],
        ['bg-emerald-500/30', {from:'emerald-500', to:'teal-400'}],
        ['bg-orange-500/30', {from:'orange-500', to:'yellow-500'}],
        ['bg-red-500/30', {from:'red-600', to:'orange-600'}],
    ]


    const setSidebarColor = ( color ) => selectedColor.value = color

    watch( selectedColor, ( newColor ) =>
    {
        localStorage.setItem('selected-sidebar-color', newColor)
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


        const selectedSidebarColor = localStorage.getItem( 'selected-sidebar-color' )

        if ( selectedSidebarColor !== null )
        {
            selectedColor.value = selectedSidebarColor
        }
    })

</script>

<template>
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <DashboardAside
        :isSidenavDark
        :selectedColor
        :isMobileSidenavActive
        @mobileSidenavTrigger="toggleMobileSidenav"
    />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
        <DashboardNavbar
            :isNavbarFixed
            :isMobileSidenavActive
            @mobileSidenavTrigger="toggleMobileSidenav"
            @toggleConfig="handleToggleDashboardConfig"
        />

        <slot />
    </main>

    <DashboardConfig
        :isDashboardConfigActive
        @dashboardConfigTrigger="handleToggleDashboardConfig"
    >

        <template #sidebarColors>

            <ArgonSidebarColors
                v-for="([color, shades], index)  in sidebarColors"
                :key="index"
                :from="shades.from"
                :to="shades.to"
                :isActive="selectedColor === color"
                @click="setSidebarColor(color)"
            />
        </template>

        <template #sidenavType>

           <ArgonTransparentButton
                :active="!isSidenavDark"
                text="White"
                @click="toggleSidenavType"
            />

           <ArgonTransparentButton
                :active="isSidenavDark"
                text="Dark"
                @click="toggleSidenavType"
            />


        </template>

        <template #navbarFixed>

            <ArgonSwitchButton
                name="navbarfixed"
                v-model:checked="isNavbarFixed"
                @click="toggleNavbarFixed"
            />

        </template>

        <template #darkMode>

            <ArgonSwitchButton
                name="darkmode"
                v-model:checked="isDark"
                @click="toggleDark"
            />
        </template>

    </DashboardConfig>
</template>
