<script setup>
import GuestLayoutVue from "@/Layouts/GuestLayout.vue";
import InputLabel from "../Components/InputLabel.vue";
import { ref, reactive, computed } from "vue";
import { Link, Head } from "@inertiajs/vue3";
const props = defineProps({
    cars: { type: Object },
    categories: { type: Object },
});
//const picked = ref("Toutes");
const filtres = reactive({
    car: "",
    picked: "Toutes",
    diesel: null,
    neuf: null,
    puissance: 0,
    prix: 1000000000,
});
const car = ref("");
const openFilter = ref(false);
const details = ref(false);
const filteredCars = computed(() => {
    return props.cars.filter((car) => {
        //Filter by categories
        if (
            filtres.picked.toLowerCase() != "toutes" &&
            filtres.picked != car.categorie_id
        ) {
            return false;
        }
        //Filter by name or model
        if (
            filtres.car !== "" &&
            !car.marque.nom.toLowerCase().includes(filtres.car.toLowerCase())
        ) {
            if (
                filtres.car !== "" &&
                !car.modele.toLowerCase().includes(filtres.car.toLowerCase())
            ) {
                return false;
            }
        }
        if (filtres.diesel != null) {
            if (filtres.diesel != car.diesel) {
                return false;
            }
        }
        if (filtres.neuf != null) {
            if (filtres.neuf != car.neuf) {
                return false;
            }
        }
        if (filtres.puissance > car.puissance) {
            return false;
        }

        if (filtres.prix < car.prix) {
            return false;
        }

        return true;
    });
});
const separator = (value) => {
    var valueStr = String(value);
    var parts = valueStr.split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
};
</script>
<template>
    <GuestLayoutVue>
        <Head title="Showroom" />

        <main class="w-full min-h-screen flex flex-wrap">
            <div
                class="filter-container overflow-auto"
                :class="openFilter ? 'active' : ''"
            >
                <div
                    class="w-full px-8 py-4 bg-slate-800 flex justify-between items-center fixed z-30"
                >
                    <h3 class="font-thin text-xl text-white">Filtres</h3>
                    <div
                        class="activator bg-white h-6 w-6 cursor-pointer hidden items-center justify-center"
                        @click="openFilter = !openFilter"
                    ><p class="text-2xl">!</p></div>
                </div>
                <nav class="flex-wrap justify-center hidden">
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        :class="
                            filtres.picked == 'Toutes'
                                ? 'bg-slate-400 text-slate-800'
                                : 'bg-slate-900 text-slate-400'
                        "
                    >
                        <label
                            for="all"
                            class="inline-block cursor-pointer px-4 py-2"
                            >Toutes</label
                        >
                        <input
                            type="radio"
                            id="all"
                            name="categories"
                            value="Toutes"
                            v-model="filtres.picked"
                        />
                    </div>
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        v-for="categorie in categories"
                        :key="categorie.id"
                        :class="
                            filtres.picked == categorie.nom
                                ? 'bg-slate-400 text-slate-800'
                                : 'bg-slate-900 text-slate-400'
                        "
                    >
                        <label
                            class="cursor-pointer px-4 py-2 inline-block"
                            :for="categorie.nom"
                            >{{ categorie.nom }}</label
                        >
                        <input
                            type="radio"
                            :id="categorie.nom"
                            :value="categorie.nom"
                            name="categories"
                            v-model="filtres.picked"
                        />
                    </div>
                </nav>
                <div class="w-full px-8 py-4 mt-12 relative flex flex-wrap">
                    <label for="car" class="font-bold">
                        Rechercher une voiture :</label
                    >
                    <input
                        type="text"
                        class="w-full"
                        name="car"
                        id="car"
                        v-model="filtres.car"
                    />
                </div>
                <div class="w-full px-8 py-8 relative flex flex-wrap">
                    <InputLabel
                        for="carburant"
                        value="Carburant"
                        class="w-full font-bold"
                    />
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="null"
                            v-model="filtres.diesel"
                            id="all"
                            name="carburant"
                        /><label for="all" class="mx-2">Toutes</label>
                    </div>
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="false"
                            v-model="filtres.diesel"
                            id="essence"
                            name="carburant"
                        /><label for="essence" class="mx-2">Essence</label>
                    </div>
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="true"
                            v-model="filtres.diesel"
                            id="gasoil"
                            name="carburant"
                        /><label for="gasoil" class="mx-2">Gasoil</label>
                    </div>
                </div>
                <div class="w-full px-8 py-4 relative flex flex-wrap">
                    <InputLabel
                        for="etat"
                        value="Etat"
                        class="w-full font-bold"
                    />
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="null"
                            v-model="filtres.neuf"
                            id="all"
                            name="etat"
                        /><label for="all" class="mx-2">Toutes</label>
                    </div>
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="true"
                            v-model="filtres.neuf"
                            id="neuf"
                            name="etat"
                        /><label for="neuf" class="mx-2">Neuf</label>
                    </div>
                    <div class="flex mx-3 my-2 items-center justify-center">
                        <input
                            type="radio"
                            :value="false"
                            v-model="filtres.neuf"
                            id="occasion"
                            name="etat"
                        /><label for="occasion" class="mx-2">Occasion</label>
                    </div>
                </div>
                <div class="w-full px-8 py-4 relative flex flex-wrap">
                    <InputLabel
                        for="puissance"
                        value="Puissance minimal"
                        class="w-full font-bold"
                    />
                    <div
                        class="flex flex-wrap mx-3 my-2 items-center justify-center"
                    >
                        <label for="puissance" class="mx-2 w-full"
                            >{{ filtres.puissance }}CV</label
                        >
                        <input
                            class="w-full"
                            type="range"
                            v-model="filtres.puissance"
                            id="puissance"
                            min="0"
                            max="700"
                            step="10"
                        />
                    </div>
                </div>
                <div class="w-full px-8 py-4 relative flex flex-wrap">
                    <InputLabel
                        for="prix"
                        value="Prix maximal"
                        class="w-full font-bold"
                    />
                    <div
                        class="flex flex-wrap mx-3 my-2 items-center justify-center"
                    >
                        <label for="prix" class="mx-2 w-full"
                            >{{ separator(filtres.prix) }} MGA</label
                        >
                        <input
                            class="w-full"
                            type="range"
                            v-model="filtres.prix"
                            id="prix"
                            min="0"
                            max="1000000000"
                            step="1000000"
                        />
                    </div>
                </div>
            </div>
            <div class="showroom">
                <nav class="flex flex-wrap justify-start fixed z-40">
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        :class="
                            filtres.picked == 'Toutes'
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
                            v-model="filtres.picked"
                        />
                    </div>
                    <div
                        class="categorie-button cursor-pointer font-thin text-xl hover:bg-slate-400 hover:text-slate-800"
                        v-for="categorie in categories"
                        :key="categorie.id"
                        :class="
                            filtres.picked == categorie.nom
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
                            v-model="filtres.picked"
                        />
                    </div>
                </nav>
                <div class="show">
                    <div class="car" v-for="car in filteredCars" :key="car.id">
                        <div class="car-info relative overflow-hidden">
                            <img
                                :src="`/storage/${car.cover}`"
                                :alt="car.marque.nom + ' ' + car.modele"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="name absolute w-full z-30 text-center text-slate-800 overflow-auto"
                                :class="details ? 'showDetails' : ''"
                            >
                                <h6
                                    class="uppercase font-thin px-4 py-2 w-full bg-white"
                                    @click="details != details"
                                >
                                    {{ car.marque.nom + " " + car.modele }}
                                </h6>
                                <ul class="px-6 text-left flex flex-wrap">
                                    <li class="w-full p-1">
                                        <p
                                            class="text-justify"
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
                                    <li class="w-1/2" v-if="car.puissance">
                                        <h6 class="p-1">
                                            <span class="font-bold"
                                                >Puissance :</span
                                            >
                                            {{ car.puissance }}CV
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-1">
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
                                            <span class="font-bold"
                                                >Etat :</span
                                            >
                                            {{ car.neuf ? "Neuf" : "Occasion" }}
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <h6 class="p-2">
                                            <span class="font-bold"
                                                >Prix :</span
                                            >
                                            {{ separator(car.prix) }} MGA
                                        </h6>
                                    </li>
                                    <li class="w-1/2">
                                        <Link
                                            class="px-3 py-1 button text-lg"
                                            :href="`/showroom/${car.id}`"
                                            >Voir</Link
                                        >
                                    </li>
                                </ul>
                            </div>
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
nav {
    background-color: #ffffff;
    backdrop-filter: blur(4px);
}
nav input {
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
.show .car .car-info .name ul li p, .show .car .car-info .name ul li h6{
        font-size: small;
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
    background-color: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(3px);
}
.button {
    display: inline-block;
    border: solid 2px #fff;
    text-transform: uppercase;
    transition: 500ms ease;
}
.button:hover {
    background-color: #fff;
    color: #000;
}

@media screen and (min-width: 1024px) {
    .show .car {
        height: 300px;
        width: calc(100% / 3);
    }
}
@media screen and (max-width: 992px) {
    .show {
        padding: 20px 10px;
        padding-top: 70px;
    }
    .show .car {
        height: 300px;
        width: calc(50%);
    }
    .showroom {
        width: 100%;
        height: auto;
    }
   
    .showroom nav {
        display: none;
    }
    .name.showDetails {
        transform: translateY(0);
    }
    .filter-container {
        width: 100%;
        height: 57px;
        overflow: hidden;
        position: fixed;
        background-color: #fff;
        transition: 500ms ease-in-out;
        z-index: 40;
    }
    .filter-container.active {
        height: calc(100vh - 100px);
        overflow: scroll;
    }
    .filter-container .activator {
        display: flex;
        border-radius: 50%;
    }
    .filter-container nav {
        display: flex;
        padding-top: 60px;
    }
}
@media screen and (max-width: 728px) {
    .show .car {
        width: calc(100%);
    }
}
</style>
