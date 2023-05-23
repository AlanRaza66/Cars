<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    marque: null,
    modele: "",
    cover: null,
    puissance: null,
    prix: 0,
    diesel: false,
    neuf: true,
    categorie_id: null,
});
defineProps({
    categories: { type: Object },
    marques: { type: Object },
});

const submit = () => {
    form.post(route("dashboard.vehicle.store"));
};
</script>
<template>
    <Head title="Ajouter une voiture" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter une nouvelle voiture
            </h2>
        </template>
        <div class="fil w-full bg-white py-2 px-64 flex cursor-pointer">
            <Link class="mx-2  text-blue-500" :href="route('dashboard.vehicle')">Gestionnaire</Link>
            <p>></p>
            <Link class="mx-2  text-blue-500" :href="route('dashboard.vehicle.create')"
                >Formulaire d'ajout</Link
            >
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center justify-center flex-wrap"
                >
                    <div
                        class="p-3 pt-6 w-full text-gray-800 leading-tight text-center font-bold text-2xl"
                    >
                        <h1>Remplissez les données nécessaires</h1>
                    </div>
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="submit"
                            enctype="multipart/form-data"
                        >
                            <div class="my-3">
                                <InputLabel for="marque" value="Marque" />

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
                            <div class="my-3">
                                <InputLabel for="modele" value="Modèle" />

                                <TextInput
                                    id="modele"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.modele"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.modele"
                                />
                            </div>
                            <div class="my-3">
                                <InputLabel for="banner" value="Image" />

                                <TextInput
                                    id="banner"
                                    type="file"
                                    class="mt-1 block w-full"
                                    @input="form.cover = $event.target.files[0]"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.modele"
                                />
                            </div>
                            <div class="my-3">
                                <InputLabel for="cat" value="Catégorie" />
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
                            <div class="my-3">
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
                                    :message="form.errors.prix"
                                />
                            </div>
                            <div class="my-3 flex flex-wrap">
                                <InputLabel
                                    for="etat_input"
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
                                    for="carburant"
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
                            <div class="my-3">
                                <InputLabel for="prix" value="Prix en MGA" />

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
                            <PrimaryButton
                                class="ml-4 my-3"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Créer la voiture
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
form {
    width: 500px;
}
</style>
