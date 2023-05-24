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
    form.put(route("dashboard.vehicle.change"));
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
    </AuthenticatedLayout>
</template>
