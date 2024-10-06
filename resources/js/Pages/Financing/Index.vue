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
    <Head title="Financing" />
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
                        <h2 class="text-5xl my-10 text-center lg:text-left">Financing</h2>
                        <p class="mt-2 text-3xl text-center lg:text-left">All you need to know about financing with us.</p>
                    </div>
                </div>
            </div>

            <div class="relative w-full bg-white py-10">
                <div class="flex flex-col items-center justify-center text-black">
                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <h2 class="font-bold">Financing cars</h2>
                        <p class="mt-2">We offer financing for all our cars. We have a range of options available to suit your needs. We can offer finance for all credit types, so don't hesitate to get in touch.</p>

                        <hr>

                        <h2 class="mt-5 font-bold">Am I eligible for financing?</h2>
                        <p>
                            To be eligible for financing, you must be over 18 years old and have a valid UK driving license.
                            You must also be able to provide proof of income and address. If you meet these requirements, you are eligible for financing with us.
                        </p>

                        <h2 class="mt-5 font-bold">
                            How do I apply for financing?
                        </h2>
                        <p>
                            To apply for financing, simply fill out our online application form. We will review your application and get back to you as soon as possible.
                        </p>

                        <h2 class="mt-5 font-bold">
                            What are the interest rates?
                        </h2>
                        <p>
                            Our interest rates vary depending on the amount and the length of the term. We offer competitive rates to suit your needs.
                        </p>

                        <p class="mt-10 mb-2 font-bold">For more in-depth inquiry:</p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="border border-2 p-2 text-center">
                                <h2 class="font-bold">Phone</h2>
                                <p>Call us on +44 1524 488800</p>
                                <p>Happy to assist.</p>
                            </div>
                            <div class="border border-2 p-2 text-center">
                                <h2 class="font-bold">Email</h2>
                                <p>info@luxuria-auto.co.uk</p>
                                <p>For detailed and complete answers.</p>
                            </div>
                        </div>


                        <hr class="mt-10">
                    </div>
                </div>



                <bottom-layout/>
            </div>


        </div>

    </div>
</template>
