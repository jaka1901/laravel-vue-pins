<template>
    <main>
        <div class="columns-3 break-inside-avoid min-h-screen">
            <div v-for="pin, pinIndex in data" :key="pinIndex" class="w-full mb-6 border border-gray-400 p-3 inline-block bg-white rounded-md">
                <contenteditable data-placeholder="Title" tag="div" class="font-bold p-2" :contenteditable="true" v-model="editable[pinIndex].title" :no-nl="true" :no-html="true" @returned="submit(pinIndex)" />
                <contenteditable data-placeholder="Description" tag="p" class="p-2" :contenteditable="true" v-model="editable[pinIndex].description" :no-nl="true" :no-html="true" @returned="submit(pinIndex)" />
                <button v-if="pin.hasOwnProperty('id')" class="text-red-800 hover:text-red-300 p-2 rounded text-xs" @click="remove(pinIndex)">Delete</button>
            </div>
        </div>
    </main>
</template>

<script>
import { ref } from 'vue';
import contenteditable from 'vue-contenteditable';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    setup(props, {emit}){
        const editable = ref(props.data)

        const submit = (index) => {
            const formData = editable.value[index]
            const form = useForm({
                ...formData
            })
            const isNew = !!!formData.hasOwnProperty('id')

            if(isNew){
                const onCheckNew = formData.title.length && formData.description.length

                if(!!onCheckNew){
                    form.post(route('pins.store'), {
                        preserveScroll: true,
                        onSuccess: (res) => {
                            const updatedData = res.props.pins
                            emit('done', updatedData)
                            editable.value = updatedData
                        }
                    })
                }
            }else{
                form.put(route('pins.update', {id: form.id}), {
                    preserveScroll: true,
                })
            }
        }

        const remove = (index) => {
            const id = editable.value[index].id
            const form = useForm()

            form.delete(route('pins.destroy', {id: id}), {
                preserveScroll: true,
                onSuccess: (res) => {
                    const updatedData = res.props.pins
                    emit('done', updatedData)
                    editable.value = updatedData
                }
            })
        }

        return {
            editable,
            submit,
            remove
        }
    },
    props: {
        data: Array
    },
    components: {
        contenteditable
    }
}
</script>

<style scoped>
    [contenteditable=true]:empty:not(:focus):before{
    content:attr(data-placeholder);
    color:grey;
    font-style:italic;
    }
</style>
