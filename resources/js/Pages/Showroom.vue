<script setup>
import GuestLayoutVue from "@/Layouts/GuestLayout.vue";
import { ref } from "vue";
defineProps({
    cars: { type: Object },
    categories: { type: Object },
});

const choice = ref(null);
const picked = ref("Toutes");
const diesel = ref(false);
const neuf = ref(null);
const marque = ref("");
const modele = ref("");
</script>
<template>
    <GuestLayoutVue>
        <Head title="Showroom" />

        <main class="w-full min-h-screen">
            <nav class="w-full flex justify-center fixed">
                <div
                    class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                    :class="
                        picked == 'Toutes'
                            ? 'bg-slate-400 text-slate-800'
                            : 'bg-slate-900 text-slate-400'
                    "
                >
                    <label
                        for="all"
                        class="inline-block cursor-pointer px-8 py-4"
                        >Toutes</label
                    >
                    <input
                        type="radio"
                        id="all"
                        name="categories"
                        value="Toutes"
                        v-model="picked"
                    />
                </div>
                <div
                    class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                    v-for="categorie in categories"
                    :key="categorie.id"
                    :class="
                        picked == categorie.nom
                            ? 'bg-slate-400 text-slate-800'
                            : 'bg-slate-900 text-slate-400'
                    "
                >
                    <label
                        class="cursor-pointer px-8 py-4 inline-block"
                        :for="categorie.nom"
                        >{{ categorie.nom }}</label
                    >
                    <input
                        type="radio"
                        :id="categorie.nom"
                        :value="categorie.nom"
                        name="categories"
                        v-model="picked"
                    />
                </div>
            </nav></main
    ></GuestLayoutVue>
</template>
<style scoped>
main {
    padding-top: 100px;
    background-color: #f5f5f5;
}
input {
    display: none;
}
</style>
