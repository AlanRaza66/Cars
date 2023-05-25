<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    cars: { type: Object },
    categories: { type: Object },
    marques: { type: Object },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900" v-if="cars.length < 5">
                        <h1 class="text-red-600 font-thin text-3xl">
                            Vous devez enregistrer au moins 4 voitures pour que
                            votre site soit disponible!
                        </h1>
                    </div>
                    <div class="p-6 text-gray-900">

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
