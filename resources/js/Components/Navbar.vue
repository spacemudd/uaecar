<script>
import {Link} from "@inertiajs/vue3";
export default {
    components: {
        Link,
    },
    data() {
        return {
            //
        }
    },
    mounted() {
        //
    },
    methods: {
        //
    }
}
</script>

<template>
    <nav class="-mx-3 flex flex-col text-right lg:flex-row lg:text-left lg:flex-1 lg:col-span-2 justify-end">
                        <Link

                            :href="route('home')"
                            class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"
                        >
                            Home
                        </Link>
                        <!--<Link-->

                        <!--    :href="route('cars.index')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    Cars-->
                        <!--</Link>-->
                        <!--<Link-->
                        <!--    :href="route('sell-your-car.index')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    Sell Your Car-->
                        <!--</Link>-->
                        <!--<Link-->
                        <!--    :href="route('about.index')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    About-->
                        <!--</Link>-->
                        <!--<Link-->
                        <!--    :href="route('testimonials.index')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    Testimonials-->
                        <!--</Link>-->
                        <!--<Link-->
                        <!--    :href="route('financing.index')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    Financing-->
                        <!--</Link>-->
                        <!--<Link-->
                        <!--    :href="route('appointments.create')"-->
                        <!--    class="rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] text-white hover:text-white/80 focus-visible:ring-white"-->
                        <!--&gt;-->
                        <!--    Appointment-->
                        <!--</Link>-->
                    </nav>
</template>
