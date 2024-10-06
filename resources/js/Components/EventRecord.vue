<script>
export default {
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
    },
    props: [
        'title',
        'description',
        'month',
        'day',
        'link',
    ]
}
</script>

<style lang="css">

</style>

<template>
    <div>
        <a :href="link" target="_blank">
            <div class="flex gap-5">
                <div>
                    <div class="mt-1 bg-yellow-400 px-2 rounded-t text-center">{{ month }}</div>
                    <div class="bg-gray-200 rounded-b text-center">{{ day }}</div>
                </div>
                <div>
                    <h2 class="text-2xl">{{ title }}</h2>
                    <p class="text-gray-700 mb-2">{{ description }}</p>
                    <a :href="link" target="_blank" class="text-sm bg-gray-200 rounded px-2 hover:bg-gray-300">Click here for details</a>
                </div>
            </div>
        </a>
    </div>
</template>
