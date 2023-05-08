<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    label: { type: String, default: "" },
    link: { type: String, default: "#" },
});
</script>
<template>
    <Link class="px-6 py-3 mt-3 button text-xl" :href="link">{{ label }}</Link>
</template>
<style scoped>
.button {
    display: inline-block;
    border: solid 2px #fff;
    text-transform: uppercase;
    transition: 500ms ease;
}
.button:hover{
    background-color: #fff;
    color: #000;
}
</style>
