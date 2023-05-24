<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
const props = defineProps({
    car: { type: Object },
    categories: { type: Object },
    marques: { type: Object },
});
const form = useForm({
    id: props.car.id,
    marque: props.car.marque.id,
    modele: props.car.modele,
    cover: null,
    puissance: props.car.puissance,
    prix: props.car.prix,
    diesel: props.car.diesel == 0 ? false : true,
    neuf: props.car.neuf == 0 ? false : true,
    categorie_id: props.car.categorie.id,
});
const submit = () => {
    form.put(route("dashboard.vehicle.change"));
};
</script>
<template>
    <Head :title="car.marque.nom + ' ' + car.modele" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ car.marque.nom + " " + car.modele }}
            </h2>
        </template>
        <div class="fil w-full bg-white py-2 px-64 flex cursor-pointer">
            <Link class="mx-2 text-blue-500" :href="route('dashboard.vehicle')"
                >Gestionnaire</Link
            >
            <p>></p>
            <Link
                class="mx-2 text-blue-500"
                :href="`/dashboard/vehicles/${car.id}`"
            >
                {{ car.marque.nom + " " + car.modele }}</Link
            >
        </div>
        <div class="py-12">
            <div class="w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full container flex flex-wrap">
                        <img
                            :src="`/storage/${car.cover}`"
                            :alt="car.marque.nom + '' + car.modele"
                            class="w-1/2 object-cover"
                        />
                        <div
                            class="w-1/2 pl-6 flex flex-wrap justify-between form-container"
                        >
                            <div class="py-6 text-gray-900 w-full">
                                <form
                                    @submit.prevent="submit"
                                    enctype="multipart/form-data"
                                    class="flex flex-wrap justify-between"
                                >
                                    <div
                                        class="p-3 pt-6 w-full text-gray-800 leading-tight text-center font-bold text-2xl"
                                    >
                                        <h1>
                                            Modifiez les données à mettre à jour
                                        </h1>
                                    </div>
                                    <div class="my-3 w-full">
                                        <InputLabel
                                            for="marque"
                                            value="Marque"
                                        />

                                        <select
                                            class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            name="marque"
                                            id="marque"
                                            v-model="form.marque"
                                            required
                                        >
                                            <option
                                                v-for="marque in marques"
                                                :value="marque.id"
                                            >
                                                {{ marque.nom }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="my-3 w-full">
                                        <InputLabel
                                            for="modele"
                                            value="Modèle"
                                        />

                                        <TextInput
                                            id="modele"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.modele"
                                            required
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.modele"
                                        />
                                    </div>
                                    <div class="my-3 w-1/2 input">
                                        <InputLabel
                                            for="banner"
                                            value="Image"
                                        />

                                        <TextInput
                                            id="banner"
                                            type="file"
                                            class="mt-1 block w-full"
                                            @input="
                                                form.cover =
                                                    $event.target.files[0]
                                            "
                                            autofocus
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.modele"
                                        />
                                    </div>
                                    <div class="my-3 w-1/2 input">
                                        <InputLabel
                                            for="cat"
                                            value="Catégorie"
                                        />
                                        <select
                                            class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            name="catégorie"
                                            id="cat"
                                            v-model="form.categorie_id"
                                        >
                                            <option
                                                v-for="categorie in categories"
                                                :value="categorie.id"
                                            >
                                                {{ categorie.nom }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="my-3 w-full">
                                        <InputLabel
                                            for="puissance"
                                            value="Puissance en CV"
                                        />

                                        <TextInput
                                            id="puissance"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model="form.puissance"
                                            min="0"
                                            required
                                            autofocus
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.puissnace"
                                        />
                                    </div>
                                    <div class="my-3 flex flex-wrap">
                                        <InputLabel
                                            value="Etat"
                                            class="w-full"
                                        />
                                        <div
                                            class="flex mx-3 items-center justify-center"
                                            id="etat_input"
                                        >
                                            <input
                                                type="radio"
                                                :value="true"
                                                v-model="form.neuf"
                                                id="neuf"
                                                name="etat"
                                            /><label for="neuf" class="mx-2"
                                                >Neuf</label
                                            >
                                        </div>
                                        <div
                                            class="flex mx-3 items-center justify-center"
                                        >
                                            <input
                                                type="radio"
                                                :value="false"
                                                v-model="form.neuf"
                                                id="occasion"
                                                name="etat"
                                            /><label for="occasion" class="mx-2"
                                                >Occasion</label
                                            >
                                        </div>
                                    </div>
                                    <div class="my-3 flex flex-wrap">
                                        <InputLabel
                                            value="Carburant"
                                            class="w-full"
                                        />
                                        <div
                                            class="flex mx-3 items-center justify-center"
                                        >
                                            <input
                                                type="radio"
                                                :value="false"
                                                v-model="form.diesel"
                                                id="essence"
                                                name="carburant"
                                            /><label for="essence" class="mx-2"
                                                >Essence</label
                                            >
                                        </div>
                                        <div
                                            class="flex mx-3 items-center justify-center"
                                        >
                                            <input
                                                type="radio"
                                                :value="true"
                                                v-model="form.diesel"
                                                id="gasoil"
                                                name="carburant"
                                            /><label for="gasoil" class="mx-2"
                                                >Gasoil</label
                                            >
                                        </div>
                                    </div>
                                    <div class="my-3 w-1/2 input">
                                        <InputLabel
                                            for="prix"
                                            value="Prix en MGA"
                                        />

                                        <TextInput
                                            id="prix"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model="form.prix"
                                            min="0"
                                            required
                                            autofocus
                                        />

                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.prix"
                                        />
                                    </div>
                                    <div class="flex w-full gap-x-2">
                                        <PrimaryButton
                                            class="ml-4 my-3"
                                            :class="{
                                                'opacity-25': form.processing,
                                            }"
                                            :disabled="form.processing"
                                        >
                                            Modifier
                                        </PrimaryButton>
                                        <Link
                                        :href="`/dashboard/vehicles/${car.id}`" 
                                            method="DELETE"
                                            class="ml-4 my-3 bg-red-600 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Supprimer
                                        </Link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.container img {
    border-radius: 12px;
}
@media screen and (max-width: 992px) {
    .fil{
        display: none;
    }
    .container img {
        width: 100%;
    }
    .form-container {
        width: 100%;
    }
    .input {
        width: 100%;
    }
}
</style>
