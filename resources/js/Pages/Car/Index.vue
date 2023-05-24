<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    cars: { type: Object },
});
</script>

<template>
    <Head title="Gestionnaire de voiture" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestionnaire de véhicules
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full container">
                        <h2 class="w-full text-left text-3xl py-4 px-3">
                            Liste des voitures
                        </h2>
                        <div class="py-4 px-3 text-gray-900">
                            <div class="w-full">
                                <Link
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    :href="route('dashboard.vehicle.create')"
                                    :active="
                                        route().current('dashboard.vehicle')
                                    "
                                >
                                    Ajouter une voiture
                                </Link>
                            </div>
                        </div>
                        <div
                            class="w-full flex flex-wrap gap-2 justify-start items-start"
                        >
                            <div
                                v-for="car in cars"
                                :key="car.id"
                                class="voiture relative"
                                :style="`background:url('/storage/${car.cover}');
    background-size: cover;background-position: center;`"
                            >
                                <Link
                                    :href="`/dashboard/vehicles/${car.id}`"
                                    class="text-white font-thin text-2xl uppercase"
                                >
                                    <div
                                        class="w-full h-full top-0 z-30 masque flex justify-center items-center"
                                    >
                                        Modifier
                                    </div></Link
                                >
                                <div
                                    class="w-full p-2 text-center text-white bg-slate-800 absolute top-0"
                                >
                                    <h6>
                                        {{ car.marque.nom + " " + car.modele }}
                                    </h6>
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
.voiture {
    height: 300px;
    width: 300px;
    background-color: #ccc;
    cursor: pointer;
}
.voiture a {
    opacity: 0;
    transition: 500ms ease;
}
.voiture:hover a {
    opacity: 1;
}
.masque {
    transition: 500ms ease;
}
.voiture:hover .masque {
    background-color: #00000092;
}
@media screen and (max-width: 992px) {
    .container {
        padding: 5px;
    }
    .voiture {
        height: 200px;
        width: 200px;
    }
}
@media screen and (max-width: 992px) {
    .container {
        padding: 5px;
    }
    .voiture {
        width: 100%;
    }
}
</style>
