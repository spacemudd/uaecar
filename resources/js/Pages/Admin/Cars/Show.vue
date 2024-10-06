<script>
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        useForm,
        PrimaryButton,
        AppLayout,
    },
    data() {
        return {
            formData: new FormData(),
        }
    },
    mounted() {
        //
    },
    methods: {
        importFileChanged(e, filename) {
            this.attachedFile = e.target.files[0];
            this.formData.append('car_image', this.attachedFile);
        },
        uploadPhoto() {
            axios.post(route('admin.cars.upload', this.car.id), this.formData)
                .then(response => {
                    window.location.reload();
                }).catch(error => {
                throw error;
            });
        },
        deleteCar() {
            axios.delete(route('admin.cars.delete', this.car.id))
                .then(response => {
                    window.location.href = route('admin.cars.index');
                }).catch(error => {
                throw error;
            });
        },
    },
    props: ['car'],
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cars
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p>{{ car.id }}</p>
                    <p>{{ car.description }}</p>
                    <p>{{ car.description2 }}</p>
                    <br/>
                    <br/>
                    <p v-for="image in car.media">
                        {{ image.file_name }}
                        <img :src="route('media.show', image.id)" alt="image" width="100">
                    </p>
                </div>
            </div>
        </div>

        <div class="py-12">
            <!-- form to upload images -->
            <form @submit.prevent="uploadPhoto" method="post" enctype="multipart/form-data">
                <input type="file"
                       name="attached_file"
                       ref="attached_file"
                       required
                       @change="importFileChanged">
                <PrimaryButton>
                    Save
                </PrimaryButton>
            </form>
        </div>


        <PrimaryButton @click="deleteCar">Delete</PrimaryButton>
    </AppLayout>
</template>
