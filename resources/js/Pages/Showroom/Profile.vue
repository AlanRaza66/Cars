<script setup>
import GuestLayoutVue from "@/Layouts/GuestLayout.vue";
import { Link, Head } from "@inertiajs/vue3";
defineProps({
    car: { type: Object },
});
const separator = (value) => {
    var valueStr = String(value);
    var parts = valueStr.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
};
</script>
<template>
    <Head :title="car.marque.nom + ' ' + car.modele"/>
    <GuestLayoutVue>
        <main class="min-h-screen w-full">
            <div
                class="fil w-full bg-white py-2 px-8 flex cursor-pointer fixed z-30"
            >
                <Link :href="route('home')">Accueil </Link>
                <p>></p>
                <Link :href="route('showroom.index')">Showroom </Link>
                <p>></p>
                <Link :href="`/showroom/${car.id}`">{{
                    car.marque_id + " " + car.modele
                }}</Link>
            </div>
            <div class="hero w-full">
                <div class="w-full h-full flex flex-wrap gap-x-3 groupe">
                    <div class="images bg-white">
                        <img
                            :src="`/storage/${car.cover}`"
                            :alt="car.marque_id + ' ' + car.modele"
                            class="w-full h-1/2 object-cover object-center"
                        />
                        <div class="side w-full h-1/2 flex gap-x-3">
                            <img
                                src=""
                                alt="face"
                                class="w-full h-full object-cover"
                            />
                            <img
                                src=""
                                alt="côté"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                    <div class="fiche bg-white overflow-hidden">
                        <div
                            class="w-full px-8 py-4 bg-slate-800 flex justify-between items-center z-30"
                        >
                            <h3 class="font-thin text-xl text-white">
                                Fiche technique
                            </h3>
                        </div>
                        <div class="content w-full">
                            <ul class="w-full px-6 text-left flex flex-wrap">
                                <li class="w-full p-1">
                                    <p class="text-justify" v-if="car.about">
                                        {{ car.about }}
                                    </p>
                                    <p class="text-sm text-justify" v-else>
                                        Lorem ipsum dolor sit amet consectetur,
                                        adipisicing elit. Et facilis,
                                        consectetur in accusantium, mollitia
                                        necessitatibus unde soluta, impedit iure
                                        officiis voluptatibus totam cupiditate.
                                        Deserunt cum et laudantium. Ratione
                                        nostrum eligendi praesentium mollitia id
                                        vitae eos porro magni quod tempore velit
                                        nisi, cupiditate optio dicta tenetur
                                        iusto officia inventore ab earum totam
                                        quaerat! Minus reprehenderit eveniet
                                        atque inventore? Doloribus quasi modi
                                        iste nobis sed facilis soluta, hic ad
                                        quisquam aperiam possimus dicta
                                        consectetur cum necessitatibus accusamus
                                        cupiditate, odit asperiores omnis? Iure
                                        ad modi laborum tempora dolorum. Facere
                                        nemo culpa aspernatur amet impedit, sunt
                                        illum. Veniam possimus, amet sit
                                        reprehenderit nemo quaerat?
                                    </p>
                                </li>
                                <li class="w-full">
                                    <h6 class="p-1">
                                        <span class="font-bold"
                                            >Catégorie :</span
                                        >
                                        {{
                                            car.categorie_id
                                                ? car.categorie_id
                                                : "Non répertoriée"
                                        }}
                                    </h6>
                                </li>
                                <li class="w-full" v-if="car.puissance">
                                    <h6 class="p-1">
                                        <span class="font-bold"
                                            >Puissance :</span
                                        >
                                        {{ car.puissance }}CV
                                    </h6>
                                </li>
                                <li class="w-full">
                                    <h6 class="p-1">
                                        <span class="font-bold"
                                            >Carburant :</span
                                        >
                                        {{ car.diesel ? "Gasoil" : "Essence" }}
                                    </h6>
                                </li>
                                <li class="w-full">
                                    <h6 class="p-2">
                                        <span class="font-bold">Etat :</span>
                                        {{ car.neuf ? "Neuf" : "Occasion" }}
                                    </h6>
                                </li>
                                <li class="w-full">
                                    <h6 class="p-2">
                                        <span class="font-bold">Prix :</span>
                                        {{ separator(car.prix) }} MGA
                                    </h6>
                                </li>
                                <li class="w-full">
                                    <div
                                        class="w-full flex items-center justify-center p-2"
                                    >
                                        <a
                                            class="px-5 py-3 button text-xl text-white bg-slate-700 hover:bg-slate-500 transition-all"
                                            href="mailto:alanraza66@gmail.com"
                                            >Prendre rendez-vous pour
                                            achat</a
                                        >
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main></GuestLayoutVue
    >
</template>
<style scoped>
main {
    padding-top: 100px;
}
.fil {
    box-shadow: 4px -1px 20px 0px #ebebeb;
    background-color: #fff;
}
.fil a {
    color: rgb(111, 133, 196);
}
.hero {
    height: calc(100vh - 100px);
    padding: 10px;
    padding-top: 50px;
}
.images,
.fiche {
    width: calc(50% - 0.75rem);
    height: 100%;
    box-shadow: 4px -1px 20px 0px #ebebeb;
    border-radius: 12px;
}
.images {
    padding: 12px;
}
.images img:nth-child(1) {
    border-top-right-radius: 12px;
    border-top-left-radius: 12px;
    background-color: #ebebeb;
}
.images .side {
    padding-top: 12px;
}
.images .side img {
    border-radius: 12px;
    background-color: #ebebeb;
}
.fiche .content {
    padding: 12px;
    height: calc(100% - 40px);
}

@media screen and (max-width:992px) {
    .groupe{
        row-gap: 0.75rem;
        column-gap: 0;
    }
    .images, .fiche{
        width: 100%!important;
        height: auto;
    }
}
</style>
