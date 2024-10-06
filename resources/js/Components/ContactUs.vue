<script>
import {useForm} from "@inertiajs/vue3";
export default {
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
                        <iframe class="hidden lg:block" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d161.1832633315402!2d-2.7700579155145335!3d54.131742451529064!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487c9ca48a8140bd%3A0x6293c1df4c6e6bbd!2sKeer%20Park!5e0!3m2!1sen!2ssa!4v1728211474421!5m2!1sen!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <iframe class="block lg:hidden" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d161.1832633315402!2d-2.7700579155145335!3d54.131742451529064!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487c9ca48a8140bd%3A0x6293c1df4c6e6bbd!2sKeer%20Park!5e0!3m2!1sen!2ssa!4v1728211474421!5m2!1sen!2ssa" width="380" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
