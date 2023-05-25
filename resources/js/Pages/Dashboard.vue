<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    cars: { type: Object },
    categories: { type: Object },
    marques: { type: Object },
    users: { type: Object },
});

const separator = (value) => {
    var valueStr = String(value);
    var parts = valueStr.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
};
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
                    <div class="p-6 text-gray-900" v-if="cars.length < 4">
                        <h1 class="text-red-600 font-thin text-3xl">
                            Vous devez enregistrer au moins 4 voitures pour que
                            votre site soit disponible pour le public!
                        </h1>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div
                            class="full flex flex-wrap justify-center items-center"
                        >
                            <div class="w-full text-left text-2xl py-4 px-3">
                                <h1 class="font-bold uppercase">
                                    Les données disponibles dans la base de
                                    données:
                                </h1>
                            </div>
                            <Link :href="route('dashboard.vehicle')">
                                <div class="count">
                                    <h2>Voitures</h2>
                                    <h3>{{ cars.length }}</h3>
                                </div></Link
                            >
                            <Link :href="route('dashboard.categorie')">
                                <div class="count">
                                    <h2>Catégories</h2>
                                    <h3>{{ categories.length }}</h3>
                                </div></Link
                            >
                            <div class="count">
                                <h2>Marques</h2>
                                <h3>{{ marques.length }}</h3>
                            </div>
                            <div class="count">
                                <h2>Utilisateurs</h2>
                                <h3>{{ users.length }}</h3>
                            </div>
                        </div>
                        <div class="data--list full flex flex-wrap">
                            <div
                                class="w-full mt-8 relative overflow-x-auto shadow-md sm:rounded-lg"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        Utilisateurs
                                        <p
                                            class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            La liste complète de utilisateurs
                                            ayant accès au système de gestion du
                                            site.
                                        </p>
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Nom
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Email
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-for="user in users"
                                            :key="user.id"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
                                                {{ user.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ user.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ user.email }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        <Link
                                            :href="
                                                route('dashboard.user.create')
                                            "
                                            class="ml-4 my-3 bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Ajouter utilisateur
                                        </Link>
                                    </caption>
                                </table>
                            </div>
                            <div
                                class="w-full mt-8 relative overflow-x-auto shadow-md sm:rounded-lg"
                                id="#marques"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        Marques
                                        <p
                                            class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            La liste complète des marques de
                                            voiture.
                                        </p>
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Nom
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-for="marque in marques"
                                            :key="marque.id"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
                                                {{ marque.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ marque.nom }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        <Link
                                            :href="
                                                route('dashboard.user.create')
                                            "
                                            class="ml-4 my-3 bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Ajouter une marque
                                        </Link>
                                    </caption>
                                </table>
                            </div>
                            <div
                                class="w-full mt-8 relative overflow-x-auto shadow-md sm:rounded-lg"
                                id="#car"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        Voitures
                                        <p
                                            class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            La liste des voitures en vente.
                                        </p>
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Marque
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Modèle
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Catégorie
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Prix
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-for="car in cars"
                                            :key="car.id"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
                                                {{ car.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ car.marque.nom }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ car.modele }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ car.categorie.nom }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ separator(car.prix) }}£
                                            </td>
                                            <td class="px-6 py-4">
                                                <Link
                                                    :href="`/dashboard/vehicles/${car.id}`"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    >Edit</Link
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'dashboard.vehicle.create'
                                                )
                                            "
                                            class="ml-4 my-3 bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Ajouter une voiture
                                        </Link>
                                    </caption>
                                </table>
                            </div>
                            <div
                                class="w-full mt-8 relative overflow-x-auto shadow-md sm:rounded-lg"
                                id="#car"
                            >
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        Catégories
                                        <p
                                            class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            La liste des Catégories de voiture.
                                        </p>
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Nom
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Description
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3"
                                            ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            v-for="cat in categories"
                                            :key="cat.id"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
                                                {{ cat.id }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ cat.nom }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ cat.description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <Link
                                                    :href="`/dashboard/categories/${cat.id}`"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    >Edit</Link
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'dashboard.categorie.create'
                                                )
                                            "
                                            class="ml-4 my-3 bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Ajouter une catégorie
                                        </Link>
                                    </caption>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.count {
    height: 200px;
    width: 200px;
    margin: 5px 7.5px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 12px;
    box-shadow: 0px 0px 10px 0px #5b5b5b;
    transition: 500ms ease;
}
.count:hover {
    box-shadow: 0px 0px 10px 0px #5b5b5b inset;
}
.count h2 {
    text-transform: uppercase;
    font-weight: thin;
    font-size: 1.5rem;
}
.count h3 {
    font-size: 2rem;
}
</style>
