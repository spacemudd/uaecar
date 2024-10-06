<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BottomLayout from "@/Layouts/BottomLayout.vue";
import Navbar from "@/Components/Navbar.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="About" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="/bg-2.svg" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-left lg:col-span-1">
                        <a href="/">
                            <img id="background" class="max-w-[100px] lg:max-w-[200px]" src="/luxuria_logo_text_white.png" />
                        </a>
                    </div>

                    <navbar></navbar>


                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>
            </div>

            <div class="relative w-full bg-white">
                <div class="flex flex-col items-center justify-center text-white py-10"
                     style="background-image: url('/car_images/corvette.jpg');background-size: cover;background-position: center">
                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <h2 class="text-5xl my-10 text-center lg:text-left">About</h2>
                        <p class="mt-2 text-3xl text-center lg:text-left">Enjoy an exquisite experience with Luxuria Auto.</p>
                    </div>
                </div>
            </div>

            <div class="relative w-full bg-white py-10">
                <div class="flex flex-col items-center justify-center text-black">
                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
                            <div class="col-span-3 flex justify-center items-center">
                                <img src="/car_images/carscollection.png" alt="">
                            </div>
                            <div class="col-span-2">
                                <h2 class="text-5xl mt-10 text-center lg:text-left">Experience True, Experienced, Luxury</h2>
                                <p class="mt-10 text-center lg:text-left">
                                    From the pinnacle of German engineering to the elegance of Italian design, from the
                                    timeless tradition of English craftsmanship to the bold spirit of American classics,
                                    we present an unparalleled selection for the discerning automobile connoisseur.
                                    Experience the luxury of 24 exotic brands and an exquisite collection of 75 to 100
                                    cars, all under one roof, crafted to captivate your senses and ignite your passion.
                                </p>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mt-10">
                            <div class="col-span-2">
                                <h2 class="text-5xl mt-10 text-center lg:text-left">
                                    Highly professional and passionate team
                                </h2>
                                <p class="mt-10 text-center lg:text-left">
                                    At Luxuria Auto, we prioritise our clients' needs and interests, ensuring they receive unparalleled attention and service. Our team of professionals is dedicated to providing an exceptional experience. Our exquisite collection of exotic vehicles invites you to select something unique and distinctive, perfectly suited to your style. Discover a world of luxury and excitement with our prestigious automotive showcase, one of the finest in the industry. Embark on your journey with us today.
                                </p>
                            </div>
                            <div class="col-span-3 flex justify-center items-center">
                                <img src="/car_images/detailing.jpg" alt="">
                            </div>
                        </div>

                    </div>
                </div>
                <bottom-layout></bottom-layout>
            </div>



        </div>

    </div>
</template>
