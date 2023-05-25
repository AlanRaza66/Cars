<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    categorie: { type: Object },
    cars: { type: Object },
});

const form = useForm({
    id: props.categorie.id,
    nom: props.categorie.nom,
    description: props.categorie.description,
});
const submit = () => {
    form.put(route("dashboard.categorie.change"));
};
</script>
<template>
    <Head :title="categorie.nom" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ categorie.nom }}
            </h2>
        </template>
        <div class="fil w-full bg-white py-2 px-64 flex cursor-pointer">
            <Link
                class="mx-2 text-blue-500"
                :href="route('dashboard.categorie')"
                >Gestionnaire</Link
            >
            <p>></p>
            <Link
                class="mx-2 text-blue-500"
                :href="`/dashboard/categories/${categorie.id}`"
            >
                {{ categorie.nom }}</Link
            >
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full container flex flex-wrap">
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
                                    <InputLabel for="nom" value="Nom" />
                                    <TextInput
                                        id="nom"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.nom"
                                        required
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.nom"
                                    />
                                </div>
                                <div class="my-3 w-full">
                                    <InputLabel
                                        for="description"
                                        value="Description"
                                    />
                                    <textarea
                                        id="description"
                                        type="text"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-96"
                                        v-model="form.description"
                                        required
                                    >
                                    </textarea>

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.description"
                                    />
                                </div>
                                <div class="flex w-full gap-x-2 justify-end">
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
                                        :href="`/dashboard/categories/${categorie.id}`"
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
    </AuthenticatedLayout>
</template>
