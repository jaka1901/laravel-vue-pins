<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Your Pins
                </h2>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="newPin">New</button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-if="fetchPins.length">
                    <Card :data="fetchPins" @done="childDone"/>
                </template>
                <div v-else>
                    No data
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import { ref, reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Card from './Components/Card.vue'

export default {
    setup(props) {
        const modalShow = ref(false)
        const newStatus = ref(false)
        const fetchPins = ref(props.pins)

        const initData = {
            title: '',
            description: ''
        }
        const childDone = (data) => {
            fetchPins.value = data
            initData.title = ''
            initData.description = ''
            newStatus.value = false
        }

        const newPin = () => {
            if(!newStatus.value){
                newStatus.value = true
                fetchPins.value.unshift(initData)
            }
        }

        return {
            fetchPins,
            newPin,
            childDone
        }
    },
    components: {
        AppLayout,
        Card,
    },
    props: {
        pins: Array
    }
}
</script>
