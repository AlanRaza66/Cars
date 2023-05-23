<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    nom: "",
    description: "",
    cover: null,
});

const submit = () => {
    form.post(route("form.categorie.store"));
};
</script>
<template>
    <Head title="Ajouter une catégorie" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter une nouvelle catégorie
            </h2>
        </template>

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
                                <InputLabel for="nom" value="Nom catégorie" />

                                <TextInput
                                    id="nom"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nom"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.nom"
                                />
                            </div>
                            <div class="my-3">
                                <InputLabel
                                    for="description"
                                    value="Description"
                                />

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.description"
                                />
                            </div>
                            <div class="my-3">
                                <InputLabel for="banner" value="Couverture" />

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

                            <PrimaryButton
                                class="ml-4 my-3"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Créer la catégorie
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
