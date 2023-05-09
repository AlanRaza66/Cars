<script setup>
import LearnMoreButton from "@/Components/LearnMoreButton.vue";
import GuestLayoutVue from "@/Layouts/GuestLayout.vue";
import { ref, computed } from "vue";
const props = defineProps({
    cars: { type: Object },
    categories: { type: Object },
});
const picked = ref("Toutes");
const choice = ref(null);
const diesel = ref(false);
const neuf = ref(null);
const marque = ref("");
const modele = ref("");
const filteredCars = computed(() => {
    if (picked.value == "Toutes") {
        return props.cars;
    } else {
        return props.cars.filter((car) => car.categorie_id == picked.value);
    }
});
const separator = (value) => {
    var valueStr = String(value);
    var parts = valueStr.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".")
};
</script>
<template>
    <GuestLayoutVue>
        <Head title="Showroom" />

        <main class="w-full min-h-screen flex flex-wrap">
            <div class="filter-container">
                <div class="w-full px-8 py-4 bg-slate-800">
                    <h3 class="font-thin text-xl text-white">Filtres</h3>
                </div>
            </div>
            <div class="showroom">
                <nav class="flex flex-wrap justify-start fixed z-40">
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        :class="
                            picked == 'Toutes'
                                ? 'bg-slate-400 text-slate-800'
                                : 'bg-slate-900 text-slate-400'
                        "
                    >
                        <label
                            for="all"
                            class="inline-block cursor-pointer px-8 py-4"
                            >Toutes</label
                        >
                        <input
                            type="radio"
                            id="all"
                            name="categories"
                            value="Toutes"
                            v-model="picked"
                        />
                    </div>
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        v-for="categorie in categories"
                        :key="categorie.id"
                        :class="
                            picked == categorie.nom
                                ? 'bg-slate-400 text-slate-800'
                                : 'bg-slate-900 text-slate-400'
                        "
                    >
                        <label
                            class="cursor-pointer px-8 py-4 inline-block"
                            :for="categorie.nom"
                            >{{ categorie.nom }}</label
                        >
                        <input
                            type="radio"
                            :id="categorie.nom"
                            :value="categorie.nom"
                            name="categories"
                            v-model="picked"
                        />
                    </div>
                </nav>
                <div class="show">
                    <div class="car" v-for="car in filteredCars" :key="car.id">
                        <div class="car-info relative overflow-hidden">
                            <img
                                :src="`/storage/${car.cover}`"
                                :alt="car.marque + ' ' + car.modele"
                                class="w-full h-full object-cover"
                            />
                            <div class="name absolute w-full z-30 text-center text-slate-800">
                                <h6
                                    class=" uppercase font-thin px-4 py-2 w-full bg-white"
                                >
                                    {{ car.marque + " " + car.modele }}
                                </h6>
                                <ul
                                    class=" px-6 text-left flex flex-wrap"
                                >
                                    <li class="w-full p-3">
                                        <p
                                            class="text-lg text-justify"
                                            v-if="car.about"
                                        >
                                            {{ car.about }}
                                        </p>
                                        <p class="text-sm text-justify" v-else>
                                            Lorem, ipsum dolor sit amet
                                            consectetur adipisicing elit.
                                            Dolores optio hic aliquid repellat
                                            totam corporis commodi, in adipisci
                                            iste beatae a distinctio ullam quod
                                        </p>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-2">
                                            <span class="font-bold"
                                                >Catégorie :</span
                                            >
                                            {{ car.categorie_id }}
                                        </h6>
                                    </li>
                                    <li class="w-1/2" v-if="car.puissance">
                                        <h6 class="p-2">
                                            <span class="font-bold"
                                                >Puissance :</span
                                            >
                                            {{ car.categorie_id }}
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-2">
                                            <span class="font-bold"
                                                >Carburant :</span
                                            >
                                            {{
                                                car.diesel
                                                    ? "Gasoil"
                                                    : "Essence"
                                            }}
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-2">
                                            <span class="font-bold">Etat :</span>
                                            {{
                                                car.neuf ? "Neuve" : "Occasion"
                                            }}
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-2">
                                            <span class="font-bold">Prix :</span>
                                            {{ separator(car.prix) }} MGA
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <LearnMoreButton
                                            :label="`Voir`"
                                            :link="'#'"
                                        />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div></main
    ></GuestLayoutVue>
</template>
<style scoped>
main {
    padding-top: 100px;
}
input {
    display: none;
}
.filter-container {
    background-color: #fff;
    box-shadow: 5px 5px 5px 5px #4d4d4d;
    height: calc(100vh - 100px);
    width: 300px;
    z-index: 20;
}
.showroom {
    background-color: #fff;
    height: calc(100vh - 100px);
    width: calc(100% - 300px);
}
.showroom nav {
    width: 100%;
}
.show {
    width: 100%;
    height: 100%;
    overflow-y: scroll;
    padding: 20px 30px;
    padding-top: 5rem;
    display: flex;
    justify-content: flex-start;
    align-items: start;
    flex-wrap: wrap;
}
.show .car {
    height: 250px;
    width: calc(100% / 2);
    padding: 5px;
    flex-shrink: 0;
    flex-grow: 0;
}
.show .car .car-info {
    background-color: #c3c3c3;
    box-shadow: 4px -1px 20px 0px #c3c3c3;
    width: 100%;
    height: 100%;
    cursor: pointer;
}
.show .car .car-info .name {
    top: 0;
    height: 100%;
    transform: translateY(calc(100% - 2.2rem));
    transition: 500ms ease-out;
}
.show .car:hover .car-info .name {
    transform: translateY(0);
    background-color: rgba(255, 255, 255, 0.681);
    backdrop-filter: blur(3px);
}

@media screen and (min-width: 1024px) {
    .show .car {
        height: 300px;
        width: calc(100% / 3);
    }
}
@media screen and (max-width: 992px) {
    .show .car {
        height: 300px;
        width: calc(100%);
    }
}
</style>
