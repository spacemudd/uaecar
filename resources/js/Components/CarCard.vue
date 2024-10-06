<script>
export default {
    props: [
        'id',
        'car',
        'description',
        'description2',
        'price',
        'year',
        'engine',
    ]
}
</script>

<template>
    <div class="border border-yellow-600 p-5 rounded bg-white text-black">
        <template v-if="car.at_data">
            <template v-if="car.at_data.data">
                <p>{{ year }}</p>
                <h2 class="text-3xl text-black"><b>{{ car.at_data.data.vehicle.make }} {{ car.at_data.data.vehicle.model }}</b></h2>
                <p class="text-3xl text-black">{{ car.at_data.data.adverts.retailAdverts.attentionGrabber }}</p>
            </template>
        </template>
        <!--<h2 class="text-3xl text-black" :id="car.id">{{ description }}</h2>-->
        <!--<p>{{ description2 }}</p>-->
        <!--<img class="mt-2 border-2 border-black"-->
        <!--     v-if="car.media.length"-->
        <!--     :src="route('media.show', car.media[0].id)"-->
        <!--     alt="" />-->

        <template v-if="car.media">
            <img class="mt-2 border-2 border-black"
                 v-if="car.media.length"
                 :src="route('media.show', car.media[0].id)"
                 alt="" />
            <!--<img class="mt-2 border-2 border-black"-->
            <!-- v-if="car.at_data.media.images.length"-->
            <!-- :src="car.at_data.media.images[0]['href']"-->
            <!-- alt="" />-->
        </template>
        <template v-else>
            <img class="mt-2 border-2 border-black w-full"
                 src="/not_available.svg"
                 alt="" />
        </template>


        <p class="text-right">{{ price }}</p>
        <hr>
        <table class="w-full">
            <tbody>
            <tr>
                <td>Year</td>
                <td class="text-right">{{ year }}</td>
            </tr>
            <tr>
                <td>Engine</td>
                <td class="text-right">{{ engine }}</td>
            </tr>
            </tbody>
        </table>
        <div class="mt-2 flex justify-between">
            <a class="border px-2 hover:bg-blue-800 hover:text-white border-blue-800 text-blue-800" :href="route('cars.show', car.id)">
                More Information
            </a>
            <a class="border px-2 hover:bg-blue-800 hover:text-white border-blue-800 text-blue-800" :href="route('appointments.create')">
                Book an appointment
            </a>
        </div>
    </div>
</template>
