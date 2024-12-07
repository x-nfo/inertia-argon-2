<script setup>
    import { ref, watch, computed, onMounted } from 'vue';
    import { useDark, useToggle } from '@vueuse/core';
    import { vOnClickOutside } from '@vueuse/components'
    import DashboardAside from '@/Components/DashboardAside.vue';
    import DashboardNavbar from '@/Components/DashboardNavbar.vue';
    import DashboardConfig from '@/Components/DashboardConfig.vue';
    import CheckboxSlider from '@/Components/CheckboxSlider.vue';
    import { useSidebarColor } from '@/Composables/SidebarColor';
    import DashboardButtonPrimary from '@/Components/DashboardButtonPrimary.vue';


    // Mobile Sidenav
    const isMobileSidenavActive = ref( false );

    const handleMobileSidenavToggle = () =>
    {
        isMobileSidenavActive.value = !isMobileSidenavActive.value;
    };


    //Argon Config
    const isArgonConfigActive = ref( false );
    const configPanel = ref( null )

    const handleArgonConfigToggle = () =>
    {
        isArgonConfigActive.value = !isArgonConfigActive.value;
    };


    //Navbar Notification
    const isNavbarNotificationActive = ref( false )
    const navbarNotification =ref(null)

    const handleNotificationTrigger = () =>
    {
        isNavbarNotificationActive.value = !isNavbarNotificationActive.value
    }



    // Config Sidebar Color
    const { setActiveColor, selectedColor, colorGradients } = useSidebarColor();
    const colors = Object.keys( colorGradients );

    const getActiveBgColor = computed( () =>
    {
        return ( color ) => selectedColor.value === `bg-${color}-500/30`
            ? 'border-slate-700' : 'border-white';
    } )



    //Config Sidebar Type
    const isDarkSidenavActive = ref(false);

    const toggleSidenavMode = (mode) => {
        isDarkSidenavActive.value = mode === 'dark';
    };

    const sidenavButtonClasses = computed( () =>
    {
        return {
            light: isDarkSidenavActive.value
                ? 'text-blue-500 bg-transparent border-blue-500'
                : 'text-white bg-blue-500 border-transparent',
            dark: isDarkSidenavActive.value
                ? 'text-white bg-blue-500 border-transparent'
                : 'text-blue-500 bg-transparent border-blue-500',
        };
    });

    watch(isDarkSidenavActive, (newValue) => {
        localStorage.setItem('sidebarType', JSON.stringify(newValue));
    });




    // Config Navbar Fixed
    const isNavbarFixedActive = ref( false );

    const handleNavbarFixedActive = () =>
    {
        isNavbarFixedActive.value = !isNavbarFixedActive.value
    }

    watch(isNavbarFixedActive, (newValue) => {
    localStorage.setItem('checkboxStatus', JSON.stringify(newValue));
    } );



    // Config Theme Mode
    const isDark = useDark();
    const toggleDark = useToggle( isDark );


    onMounted( () =>
    {
        // Config Navbar Fixed
        const savedValue = localStorage.getItem('checkboxStatus');
        if (savedValue !== null) {
            isNavbarFixedActive.value = JSON.parse(savedValue);
        }

        // Config Sidebar Type
        const sidebarTypeValue = localStorage.getItem( 'sidebarType' );
        if ( sidebarTypeValue !== null )
        {
            isDarkSidenavActive.value = JSON.parse(sidebarTypeValue)
        }
    } );



    // Click Outside
    const onClickOutsideHandler =
    [
        () => {
                isNavbarNotificationActive.value = false
                isArgonConfigActive.value = false
              },
              { ignore: [ navbarNotification, configPanel ] },
    ]


</script>

<template>

    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- Dashboard Aside/Sidebar -->
    <DashboardAside
        :isMobileSidenavActive
        @mobileSidenavTrigger="handleMobileSidenavToggle"

        :isDarkSidenavActive
        :activeColor="selectedColor"

    />
    <!-- End of Dashboard Aside/Sidebar  -->

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
        <DashboardNavbar
            ref="navbarNotification"

            :isMobileSidenavActive
            :isNavbarFixedActive
            :isNavbarNotificationActive
            @mobileSidenavTrigger="handleMobileSidenavToggle"
            @argonConfigTrigger="handleArgonConfigToggle"
            @notificationTrigger="handleNotificationTrigger"
            v-on-click-outside="onClickOutsideHandler"

        />

        <!-- Dashboard Content -->
        <slot />
        <!-- End of Dashboard Content -->

    </main>
    <!-- End of Page Content -->

    <!-- Dashboard Config -->
    <DashboardConfig
        ref="configPanel"
        :isArgonConfigActive
        @argonConfigTrigger="handleArgonConfigToggle"
    >
        <!-- Config Sidebar Active Background Color -->
        <template #sidebarColor>
             <span
                v-for="color in colors"
                :key="color"
                :class="[
                'py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out relative inline-block cursor-pointer whitespace-nowrap border border-solid text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700',
                `bg-gradient-to-tl from-${colorGradients[color].from} to-${colorGradients[color].to}`,
                getActiveBgColor(color)]"
                @click="setActiveColor(color)"
                ></span>
        </template>

        <!-- Config Sidebar Navigation Type -->
        <template #sidenavType>
            <DashboardButtonPrimary
                :class="sidenavButtonClasses.light"
                @click="toggleSidenavMode('light')"
            >
                White
            </DashboardButtonPrimary>

            <DashboardButtonPrimary
                :class="sidenavButtonClasses.dark"
                @click="toggleSidenavMode('dark')"
            >
                Dark
            </DashboardButtonPrimary>
        </template>

        <!-- Config Navbar Fixed -->
        <template #navbarFixed>
            <CheckboxSlider
                name="navbarfixed"
                v-model:checked="isNavbarFixedActive"
                @click="handleNavbarFixedActive"
            />
        </template>

        <!-- Config Theme/DarkMode -->
        <template #darkmode>
            <CheckboxSlider
                name="darkmode"
                v-model:checked="isDark"
                @click="toggleDark()"
            />
        </template>

    </DashboardConfig>
    <!-- End of Dashboard Config -->
</template>
