
<script setup>
import { computed, onUpdated } from 'vue';


    const props = defineProps( {
    from: {type:String},
        to: { type: String },
    isActive: {type:Boolean}
    } )

    const classes = computed( () => props.isActive ? 'border-slate-700 dark:border-white' : 'border-white dark:border-slate-700' )

    const grayDarkClasses = computed( () => props.from === 'zinc-800' ? 'dark:from-slate-750 dark:to-gray-850' : '' )

    onUpdated( () =>
    {
        console.log( 'isActive ', props.isActive)

    })



</script>




<template>


    <span
    :class="` ${classes} py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-${props.from} to-${props.to} dark:bg-gradient-to-tl ${grayDarkClasses} relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700`"></span>


</template>