<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

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

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});

const submitForm = () => {
    form.post(route('appointments.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};


function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Appointment success" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="/bg-2.svg" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-left lg:col-span-2">
                        <a href="/">
                            <img id="background" class="max-w-[100px] lg:max-w-[200px]" src="/luxuria_logo_text_white.png" />
                        </a>
                    </div>

                    <nav class="-mx-3 flex flex-1 justify-end">
                        <Link

                            :href="route('home')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Home
                        </Link>
                        <Link

                            :href="route('cars.index')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Cars
                        </Link>
                    </nav>


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


                <main>
                    <div class="relative bg-black rounded-lg overflow-hidden mt-10 p-10">
                        <h2 class="text-5xl text-white font-bold lg:text-left">
                            Thank you.<br/>
                            We will be in touch as soon as possible.
                            <br/>
                        </h2>
                        <p>In the mean time, you can browse our finest collection of supercars.</p>
                        <div class="mt-5">
                            <p>- Luxuria Auto</p>
                        </div>


                    </div>
                </main>

            </div>
        </div>

        <div class="relative w-full bg-white py-10 mt-20">
            <div class="flex flex-col items-center justify-center text-black">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <h2 class="text-5xl mt-10 text-center lg:text-left">Events</h2>

                    <div>
                        <div>
                            <div>Aug</div>
                            <div>17</div>
                        </div>
                    </div>
                    <!--<p class="mt-10 text-center lg:text-left">-->
                    <!--    <i>No upcoming events are available as of now.</i>-->
                    <!--</p>-->

                    <hr class="mt-10">
                    <h2 class="text-5xl mt-10 text-center lg:text-left">Contact Us</h2>
                    <p class="mt-10 text-center lg:text-left">
                        Unit 5a Keer Park, Carnforth, Lancashire<br/>
                        +44 1524 488800<br/>
                        info@luxuria-auto.co.uk
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
