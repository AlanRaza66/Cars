<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    marque: "",
    modele: "",
    cover: null,
    prix: 0,
    diesel: false,
    neuf: true,
    categorie_id: null,
});

const submit = () => {
    form.post(route("form.store"));
};
</script>
<template>
    <Head title="Ajouter une voiture" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Voiture
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div class="my-3">
                                <InputLabel for="marque" value="Marque" />

                                <TextInput
                                    id="marque"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.marque"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.marque"
                                />
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
