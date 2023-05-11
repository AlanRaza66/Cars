<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
const activeBurger = ref(false);
</script>
<template>
    <nav
        class="fixed top-0 left-0 w-full flex items-center justify-between px-36"
    >
        <div class="logo">
            <Link :href="route('home')" class="text-white text-4xl">Cars</Link>
        </div>
        <div class="items flex items-center justify-center font-thin uppercase">
            <Link
                :href="route('home')"
                :class="`text-white text-lg ml-5  ${
                    $page.url == '/' ? 'active' : ''
                }`"
                >Accueil</Link
            >
            <Link
                :href="route('showroom.index')"
                :class="`text-white text-lg ml-5  ${
                    $page.url.startsWith('/showroom') ? 'active' : ''
                }`"
                >Showroom</Link
            >
        </div>
        <div
            class="burger"
            :class="activeBurger ? 'active' : ''"
            @click="activeBurger = !activeBurger"
        >
            <div></div>
        </div>
        <div
            class="mobile items-center justify-center flex-col"
            :class="activeBurger ? 'active' : ''"
        >
            <Link
                :href="route('home')"
                :class="` text-2xl  mt-8 font-thin uppercase ${
                    $page.url == '/' ? 'active' : ''
                }`"
                @click="activeBurger = false"
                >Accueil</Link
            >
            <Link
                :href="route('showroom.index')"
                :class="`text-2xl mt-8 font-thin uppercase ${
                    $page.url.startsWith('/showroom') ? 'active' : ''
                }`"
                @click="activeBurger = false"
                >Showroom</Link
            >
        </div>
    </nav>
</template>
<style scoped>
.mobile {
    display: none;
}
.burger {
    height: 50px;
    width: 50px;
    display: none;
}
nav {
    height: 100px;
    background-color: #000;
    z-index: 50;
}
.active {
    position: relative;
}
.items a {
    position: relative;
}
.items a::before {
    background-color: #fff;
    content: "";
    width: 0;
    height: 2px;
    position: absolute;
    bottom: -2px;
    left: 0;
    transition: 500ms;
}
.items a:hover::before {
    width: 100%;
}
a.active::before {
    width: 100%;
}
@media screen and (max-width: 992px) {
    .mobile {
        display: flex !important;
        z-index: 30;
        background-color: #000000aa;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        backdrop-filter: blur(4px);

        position: fixed;
        transform: translateX(100%);
        transition: 500ms ease-in;
    }
    .mobile.active {
        transform: translateX(0);
    }
    .mobile a{
        color: #ebebeb86;
    }
    .mobile a.active{
        color: #fff;
    }
    nav {
        padding: 0 20px!important;
    }
    nav .logo a {
        font-size: 2.25rem;
        z-index: 40 !important;
    }
    nav .items {
        display: none;
    }
    nav .burger {
        display: block;
        position: relative;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 40;
    }
    nav .burger div {
        position: absolute;
        background-color: #fff;
        height: 3px;
        width: 28px;
        transition: 500ms ease;
    }
    nav .burger div::after,
    nav .burger div::before {
        content: "";
        background-color: #fff;
        position: absolute;
        left: 0;
        height: 3px;
        width: 100%;
    }
    nav .burger div::before {
        top: -8px;
        animation: desactiveBurger 500ms forwards;
    }
    nav .burger div::after {
        bottom: -8px;
        animation: desactiveBurger2 500ms forwards;
    }
    nav .burger.active div {
        background-color: transparent;
    }
    @keyframes activeBurger {
        from {
            transform: rotate(0);
        }
        to {
            top: 0;
            transform: rotate(45deg);
        }
    }
    @keyframes activeBurger2 {
        from {
            transform: rotate(0);
        }
        to {
            bottom: 0;
            transform: rotate(-45deg);
        }
    }
    @keyframes desactiveBurger {
        from {
            top: 0;
            transform: rotate(45deg);
        }
        to {
            transform: rotate(0);
            top: -8px;
        }
    }
    @keyframes desactiveBurger2 {
        from {
            bottom: 0;
            transform: rotate(-45deg);
        }
        to {
            transform: rotate(0);
            bottom: -8px;
        }
    }
    nav .burger.active div::before {
        animation: activeBurger 500ms forwards;
    }
    nav .burger.active div::after {
        animation: activeBurger2 500ms forwards;
    }
}
</style>
