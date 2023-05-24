<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    categories: { type: Object },
});
</script>
<template>
    <Head title="Gestionnaire de catégories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestionnaire de catégories
            </h2>
        </template>
        <div class="py-12">
            <div class="w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full container">
                        <h2 class="w-full text-left text-3xl py-4 px-3">
                            Liste des catégories existantes
                        </h2>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div class="w-full">
                            <Link
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                :href="route('dashboard.categorie.create')"
                                :active="route().current('dashboard.categorie')"
                            >
                                Ajouter une catégorie
                            </Link>
                        </div>
                    </div>
                    <div
                        class="w-full flex flex-wrap gap-2 justify-start items-start"
                    ></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
@media screen and (max-width: 992px) {
    .container {
        padding: 5px;
    }
}
</style>
