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
            <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full container">
                        <h2 class="w-full text-left text-3xl py-4 px-3">
                            Liste des catégories
                        </h2>
                        <div class="py-4 px-3 text-gray-900">
                            <div class="w-full">
                                <Link
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('dashboard.categorie.create')"
                                    :active="
                                        route().current('dashboard.categorie')
                                    "
                                >
                                    Ajouter une catégorie
                                </Link>
                            </div>
                        </div>
                        <div
                            class="categorie--wrapper w-full flex flex-wrap gap-2 justify-start items-stretch"
                        >
                            <div
                                class="categorie--container p-4 bg-slate-200 flex justify-between rounded-xl"
                                v-for="cat in categories"
                                :key="cat.id"
                            >
                                <div class="categorie--image">
                                    <img
                                        :src="`/storage/${cat.cover}`"
                                        :alt="cat.nom"
                                    />
                                    <div
                                        class="w-full p-2 flex items-center justify-center"
                                    >
                                        <Link
                                            :href="`/dashboard/categories/${cat.id}`"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            <div
                                                class="w-full h-full top-0 z-30 masque flex justify-center items-center"
                                            >
                                                Modifier
                                            </div></Link
                                        >
                                    </div>
                                </div>
                                <div class="categorie--info text-justify">
                                    <h3 class="text-3xl">{{ cat.nom }}</h3>
                                    <p>{{ cat.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.categorie--container {
    width: 100%;
}
.categorie--image img {
    width: 300px;
    height: 300px;
    border-radius: 12px;
    object-fit: cover;
}
.categorie--info {
    width: calc(100% - 300px - 1rem);
}
@media screen and (max-width: 1024px) {
    .categorie--container {
        align-items: flex-start;
        flex-wrap: wrap;
        flex-direction: column-reverse;
    }
    .categorie--image {
        margin-top: 5px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .container {
        padding: 5px;
    }
    .categorie--container {
        width: 100%;
    }
    .categorie--info {
        width: 100%;
    }
}
</style>
