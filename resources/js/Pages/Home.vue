<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Header/HeaderHome.vue";
import LearnMoreButton from "@/Components/LearnMoreButton.vue";
import gsap from "gsap";
const props = defineProps({
    cars: {
        type: Object,
    },
    car: {
        type: Object,
    },
    categories: {
        type: Object,
    },
});
const activeSlide = ref(props.cars[0]);
const prevSlide = ref(null);
const changeSlide = (slide, y) => {
    prevSlide.value = activeSlide.value;
    props.cars.push(activeSlide.value);
    props.cars.splice(y, 1);
    activeSlide.value = slide;
};
const enter = (el) => {
    gsap.fromTo(el, { opacity: 0 }, { opacity: 1, duration: 1.5 });
};
</script>

<template>
    <Head title="CARS" />

    <Header />
    <main class="w-full overflow-x-hidden">
        <div class="w-full h-screen relative overflow-hidden hero">
            <transition appear @enter="enter">
                <div class="slide-active">
                    <div
                        class="w-full h-screen absolute top-0 left-0 mask z-10"
                    ></div>

                    <img
                        class="w-full h-full object-cover object-center absolute top-0 left-0"
                        :src="`/storage/${activeSlide.cover}`"
                        :alt="activeSlide.marque + ' ' + activeSlide.modele"
                    />
                    <div class="text-white absolute z-20 info">
                        <h1 class="text-6xl font-extrabold uppercase">
                            {{ activeSlide.marque + " " + activeSlide.modele }}
                        </h1>
                        <p class="text-xl">
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Sequi itaque blanditiis illo voluptas alias id
                            in dolorem, ut odit deleniti aut ad tenetur debitis,
                            quisquam nihil fugit.
                        </p>
                        <LearnMoreButton
                            :label="`Découvrir ${
                                activeSlide.marque + ' ' + activeSlide.modele
                            }`"
                            :link="`/showroom/${activeSlide.id}`"
                        />
                    </div></div
            ></transition>
            <div class="slider absolute flex gap-x-8">
                <div
                    v-for="(slide, y) in props.cars"
                    :key="slide.id"
                    class="slide overflow-hidden relative"
                    :style="y == 0 ? 'display: none;' : ''"
                    @click="changeSlide(slide, y)"
                >
                    <img
                        class="h-full object-cover"
                        :src="`/storage/${slide.cover}`"
                        :alt="slide.marque + ' ' + slide.modele"
                    />
                    <div
                        class="mask2 z-10 w-full h-full absolute top-0 left-0"
                    ></div>
                    <div
                        class="text-slide z-20 text-white absolute bottom-3 left-3"
                    >
                        <h1 class="text-xl font-extrabold uppercase">
                            {{ slide.marque + " " + slide.modele }}
                        </h1>
                        <p class="">
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit...
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-mobile h-screen w-full slider-1">
            <div class="slider-container h-full w-full">
                <div
                    class="slide-mobile relative"
                    v-for="(slide, y) in props.cars"
                    :key="slide.id"
                >
                    <div
                        class="mask z-20 w-full h-full absolute top-0 left-0"
                    ></div>
                    <img
                        class="h-full w-full object-cover"
                        :src="`/storage/${slide.cover}`"
                        :alt="slide.marque + ' ' + slide.modele"
                    />
                    <div class="text-slide-mobile">
                        <h1 class="text-4xl font-extrabold uppercase">
                            {{ slide.marque + " " + slide.modele }}
                        </h1>
                        <p class="text-xl">
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Sequi itaque blanditiis illo voluptas alias id
                            in dolorem, ut odit deleniti aut ad tenetur debitis,
                            quisquam nihil fugit.
                        </p>
                        <LearnMoreButton
                            :label="`Découvrir ${
                                slide.marque + ' ' + slide.modele
                            }`"
                            :link="`/showroom/${slide.id}`"
                        />
                    </div>
                </div>
                <div class="slide-mobile relative">
                    <div
                        class="mask z-20 w-full h-full absolute top-0 left-0"
                    ></div>
                    <img
                        class="h-full w-full object-cover"
                        :src="`/storage/${props.cars[0].cover}`"
                        :alt="props.cars[0].marque + ' ' + props.cars[0].modele"
                    />
                    <div class="text-slide-mobile">
                        <h1 class="text-4xl font-extrabold uppercase">
                            {{
                                props.cars[0].marque +
                                " " +
                                props.cars[0].modele
                            }}
                        </h1>
                        <p class="text-xl">
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Sequi itaque blanditiis illo voluptas alias id
                            in dolorem, ut odit deleniti aut ad tenetur debitis,
                            quisquam nihil fugit.
                        </p>
                        <LearnMoreButton
                            :label="`Découvrir ${
                                props.cars[0].marque +
                                ' ' +
                                props.cars[0].modele
                            }`"
                            :link="`/showroom/${props.cars[0].id}`"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div
            class="landing bg-white w-full relative flex items-center justify-center flex-wrap z-20"
        >
            <div class="custom-shape-divider-top-1683226320">
                <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                >
                    <path
                        d="M598.97 114.72L0 0 0 120 1200 120 1200 0 598.97 114.72z"
                        class="shape-fill"
                    ></path>
                </svg>
            </div>
            <div class="custom-shape-divider-bottom-1683274075">
                <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                >
                    <path
                        d="M1200 0L0 0 598.97 114.72 1200 0z"
                        class="shape-fill"
                    ></path>
                </svg>
            </div>
            <h2 class="w-full text-center text-6xl">
                Trouvez le véhicule de vos rêves
            </h2>
            <div class="flex px-5 gap-5 flex-wrap justify-center items-center">
                <div
                    class="categorie relative overflow-hidden"
                    v-for="cat in props.categories"
                    :key="cat.id"
                >
                    <img
                        class="h-full object-cover"
                        :src="`/storage/${cat.cover}`"
                        :alt="cat.nom"
                    />
                    <div
                        class="mask2 z-10 w-full h-full absolute top-0 left-0"
                    ></div>
                    <div
                        class="text-slide z-20 text-white absolute top-0 left-0 w-full h-full"
                    >
                        <h3 class="absolute text-3xl">{{ cat.nom }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="h-screen w-full show relative"
            :style="`background-image:url('/storage/${props.car[0].cover}')`"
        >
            <div class="w-full h-full absolute top-0 left-0 mask z-10"></div>
            <div class="text-white absolute z-20 info">
                <h3 class="text-6xl font-extrabold uppercase">
                    {{ car[0].marque + " " + car[0].modele }}
                </h3>
                <p class="text-xl">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Sequi itaque blanditiis illo voluptas alias id in dolorem,
                    ut odit deleniti aut ad tenetur debitis, quisquam nihil
                    fugit.
                </p>
                <LearnMoreButton
                    :label="`Découvrir ${car[0].marque + ' ' + car[0].modele}`"
                    :link="`/showroom/${car[0].id}`"
                />
            </div>
        </div>
        <div class="flex flex-wrap w-full relative shower">
            <div
                class="car relative"
                :style="`background-image:url('/storage/${props.car[1].cover}')`"
            >
                <div
                    class="w-full h-full absolute top-0 left-0 mask z-10"
                ></div>
                <div
                    class="text-white absolute z-20 info2 text-left left-10"
                    id="first"
                >
                    <h3 class="text-4xl font-extrabold uppercase">
                        {{ car[1].marque + " " + car[1].modele }}
                    </h3>
                    <p class="text-xl">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Sequi itaque blanditiis illo voluptas alias id in
                        dolorem, ut odit deleniti aut ad tenetur debitis,
                        quisquam nihil fugit.
                    </p>
                    <LearnMoreButton
                        :label="`Découvrir ${
                            car[1].marque + ' ' + car[1].modele
                        }`"
                        :link="`/showroom/${car[1].id}`"
                    />
                </div>
            </div>
            <div
                class="car relative"
                :style="`background-image:url('/storage/${props.car[2].cover}')`"
            >
                <div
                    class="w-full h-full absolute top-0 left-0 mask z-10"
                ></div>
                <div
                    class="text-white absolute z-20 info2 text-right right-10"
                    id="second"
                >
                    <h3 class="text-4xl font-extrabold uppercase">
                        {{ car[2].marque + " " + car[2].modele }}
                    </h3>
                    <p class="text-xl">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Sequi itaque blanditiis illo voluptas alias id in
                        dolorem, ut odit deleniti aut ad tenetur debitis,
                        quisquam nihil fugit.
                    </p>
                    <LearnMoreButton
                        :label="`Découvrir ${
                            car[2].marque + ' ' + car[2].modele
                        }`"
                        :link="`/showroom/${car[2].id}`"
                    />
                </div>
            </div>
        </div>
        <div
            class="h-screen w-full show relative"
            :style="`background-image:url('/storage/${props.car[3].cover}')`"
        >
            <div class="w-full h-full absolute top-0 left-0 mask z-10"></div>
            <div class="text-white absolute z-20 info">
                <h3 class="text-6xl font-extrabold uppercase">
                    {{ car[3].marque + " " + car[3].modele }}
                </h3>
                <p class="text-xl">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Sequi itaque blanditiis illo voluptas alias id in dolorem,
                    ut odit deleniti aut ad tenetur debitis, quisquam nihil
                    fugit.
                </p>
                <LearnMoreButton
                    :label="`Découvrir ${car[3].marque + ' ' + car[3].modele}`"
                    :link="`/showroom/${car[3].id}`"
                />
            </div>
        </div>
    </main>
</template>

<style scoped>
.slider {
    bottom: 75px;
    right: 0;
    z-index: 20;
}
.slide {
    width: 200px;
    height: 300px;
    flex-basis: auto;
    cursor: pointer;
}
.slide-active img {
    transition: 500ms ease;
}
.mask {
    background-color: #0000007d;
}
.mask2 {
    background-color: #00000034;
}

.info {
    top: 200px;
    left: 150px;
    width: 50%;
}

.landing {
    padding: 50px;
}
.landing h2 {
    margin-bottom: 10px;
}
.custom-shape-divider-top-1683226320 {
    z-index: 30;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    transform: translateY(-95%) !important;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-top-1683226320 svg {
    position: relative;
    display: block;
    width: calc(211% + 1.3px);
    height: 125px;
}

.custom-shape-divider-top-1683226320 .shape-fill {
    fill: #ffffff;
}
.custom-shape-divider-bottom-1683274075 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    transform: translateY(99%) !important;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-bottom-1683274075 svg {
    position: relative;
    display: block;
    width: calc(300% + 1.3px);
    height: 125px;
}

.custom-shape-divider-bottom-1683274075 .shape-fill {
    fill: #ffffff;
}
.categorie {
    height: 250px;
    width: 250px;
    border-radius: 24px;
    background: #000;
    cursor: pointer;
    transition: 500ms ease;
}
.categorie:hover {
    transform: scale(1.01);
}
.categorie h3 {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bolder;
}
.show,
.car {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
.slider-mobile {
    display: none;
}

.car {
    width: 50%;
    height: 100vh;
}
.car .info2 {
    top: 50%;
    transform: translateY(-50%);
}
@media screen and (max-width: 1024px) {
    .slide {
    width: 200px;
    height: 225px;
}
}
@media screen and (max-width: 992px) {
    .hero {
        display: none !important;
    }
    .slider-mobile {
        width: 100vw;
        height: 100vh;
        display: flex;
        overflow: hidden;
    }
    .slider-container {
        animation: slider-1 15s infinite ease-in-out;
        display: flex;
    }
    .slide-mobile {
        width: 100vw;
        height: 100vh;
        flex-grow: 0;
        flex-shrink: 0;
    }
    .text-slide-mobile {
        position: absolute;
        width: 100%;
        padding: 50px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #fff;
        text-align: center;
        z-index: 25;
    }
    .landing h2 {
        font-size: 2.25rem;
    }
    .landing .categorie {
        height: 200px;
        width: 200px;
    }
    .info {
        width: 100%;
        left: 0;
        padding-left: 50px;
        padding-right: 50px;
        text-align: center;
    }
    .info h3 {
        font-size: 2.25rem;
    }
    .car {
        width: 100%;
    }
    .car #first {
        width: 100%;
        left: 0;
        padding: 0 50px !important;
        text-align: right !important;
    }
    .car #second {
        width: 100%;
        right: 0;
        padding: 0 50px !important;
        text-align: left !important;
    }
}
@keyframes slider-1 {
    0%,
    20% {
        transform: translateX(0);
    }
    25%,
    45% {
        transform: translateX(-100%);
    }
    50%,
    70% {
        transform: translateX(-200%);
    }
    75%,
    95% {
        transform: translateX(-300%);
    }
    100% {
        transform: translateX(-400%);
    }
}
@media screen and (max-width: 728px) {
}
</style>
