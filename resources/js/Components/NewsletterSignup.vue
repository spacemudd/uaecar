<script>
import { useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            form: useForm({
                email: '',
            }),
            completedSignup: false,
        }
    },
    mounted() {
        //
    },
    methods: {
        signup() {
            this.form.post(route('newsletter.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                    this.completedSignup = true;
                },
            });
        },
    }
}
</script>

<template>
    <form @submit.prevent="signup" class="flex flex-col items-center justify-center">
        <template v-if="completedSignup">
            <span class="text-sm mt-2 text-white">Sign up completed. Welcome to our monthly newsletter.</span>
        </template>
        <template v-else>
            <input type="email" v-model="form.email" name="_replyto" placeholder="Enter your email" class="text-center p-2 rounded-lg border border-black text-black w-full" required>
            <button type="submit" class="mt-2 bg-black text-white p-2 rounded border border-yellow-500 w-full hover:bg-yellow-500 hover:text-black transition">Sign up</button>
            <span class="text-sm mt-2 text-white">* We usually send an email once per month.</span>
        </template>
    </form>
</template>
