<script>
import EventRecord from "@/Components/EventRecord.vue";
import {useForm} from "@inertiajs/vue3";
export default {
    components: {
        EventRecord,
    },
    data() {
        return {
            form: new useForm({
                name: '',
                email: '',
                message: ''
            })
        }
    },
    mounted() {
        //
    },
    methods: {
        submitForm() {
            window.location.reload();
        }
    }
}
</script>

<template>
    <div class="relative w-full bg-white py-10 mt-20">
        <div class="flex flex-col items-center justify-center text-black">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <h2 class="text-5xl mt-10 text-center lg:text-left">Upcoming Events ~</h2>

                <div class="mt-5 opacity-25">
                    <event-record day="17"
                                  month="Aug"
                                  title="Showroom Grand Opening 2024"
                                  description="Join us for the grand opening of our new showroom. We will be showcasing the latest and rarest supercars in the world."
                                  link="https://www.instagram.com/p/C9j4a77MC8Y/"
                    >
                    </event-record>
                </div>
            </div>
        </div>
    </div>

    <div class="relative w-full bg-white py-10">
        <div class="flex flex-col items-center justify-center text-white py-10"
             style="background-image: url('/car_images/corvette.jpg');background-size: cover;background-position: center">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <h2 class="text-5xl mt-10 text-center lg:text-left">Gallery</h2>
                <p class="mt-2 text-3xl text-center lg:text-left">Enjoy a carefully handpicked collection of photos and merch from Luxuria World.</p>
                <div class="mt-5 flex-row lg:flex gap-10 justify-center">
                    <a href="#">
                        <div class="bg-white text-black flex justify-center items-center align-bottom my-5"
                             style="background-image:url('/car_images/garage.jpg');background-size: cover;background-position: center"
                        >
                            <div class="p-20">
                                <h2 class="bg-black text-white px-2">Wallpapers</h2>
                            </div>
                        </div>
                    </a>

                    <div class="relative bg-black rounded-lg overflow-hidden">
                        <a href="#">
                            <video
                                src="/car_images/ghost.mp4"
                                autoplay
                                loop
                                muted
                                playsinline
                                class="absolute inset-0 object-cover transition duration-300 opacity-75"
                            />
                            <div class="w-full h-full align-items-center justify-center items-center flex text-center">
                                <h2 class="w-[400px] mt-10 lg:mt-0" style="min-height: 150px;">
                                    Videos
                                </h2>
                            </div>
                        </a>
                    </div>
                    <a href="#">
                        <div class="bg-white text-black flex justify-center items-center align-bottom my-5"
                             style="background-image:url('/car_images/range.png');background-size: cover;background-position: center"
                        >
                            <div class="p-20">
                                <h2 class="bg-black text-white px-2">Showroom</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="relative w-full bg-white py-10">
        <div class="flex flex-col items-center justify-center text-black">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <h2 class="text-5xl mt-10 text-center lg:text-left">Contact Us</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div>
                        <form @submit.prevent="submitForm">
                            <div class="mt-5">
                                <label for="name" class="block">Name</label>
                                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div class="mt-5">
                                <label for="email" class="block">Email</label>
                                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div class="mt-5">
                                <label for="message" class="block">Message</label>
                                <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="bg-black text-white p-2 rounded-lg">Send</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <p class="mt-10" style="font-family: 'Times New Roman', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'">
                            Unit 5a Keer Park, Carnforth, Lancashire<br/>
                            +44 1524 488800<br/>
                            info@luxuria-auto.co.uk
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="p-10 lg:p-20 text-xs text-black" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'">
        <!--<div class="grid grid-cols-1 lg:grid-cols-5">-->
        <div class="flex gap-20 justify-center">
            <div>
                <h3 class="font-bold">Navigation</h3>
                <ul class="list-disc">
                    <li class="ml-3 mt-1"><a :href="route('home')">Home</a></li>
                    <li class="ml-3 mt-1"><a :href="route('cars.index')">Cars</a></li>
                    <li class="ml-3 mt-1"><a :href="route('sell-your-car.index')">Sell Your Car</a></li>
                    <li class="ml-3 mt-1"><a :href="route('about.index')">About</a></li>
                    <li class="ml-3 mt-1"><a :href="route('testimonials.index')">Testimonials</a></li>
                    <li class="ml-3 mt-1"><a :href="route('financing.index')">Financing</a></li>
                    <li class="ml-3 mt-1"><a :href="route('appointments.create')">Appointment</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold">Headquarter</h3>
                <p>Unit 5a Keer Park, Carnforth, Lancashire</p>
                <p>+44 1524 488800</p>
                <p>info@luxuria-auto.co.uk</p>
            </div>
        </div>
        <p class="mt-10 text-center">Copyright © Luxuria 2024.</p>
    </footer>
</template>
