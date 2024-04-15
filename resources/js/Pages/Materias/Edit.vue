<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { computed } from 'vue';

const props = defineProps(['materia'])

const form = useForm({
    name: props.materia.name,
    unidades: props.materia.unidades,
    carrera_id: props.materia.carrera_id,
});
const carreras = ref([]);

axios.get('/api/carreras')
  .then(response => {
    carreras.value = response.data;
  })
  .catch(error => {
    console.error('Error fetching Carreras:', error);
  });


const submit = async () => {
    form.put(route('materias.update', {id: props.materia.id}))
}

</script>

<template>
    <FormLayout>
        <form @submit.prevent ="submit">
            <div class="mt-4">
                <InputLabel for="name" value="Nombre" />
                <TextInput type="text" name="name" id="name" v-model="form.name" class="mt-1 block w-full" :class="{'is-invalid': usePage().props.errors.name}" placeholder="Escribir Nombre"/>
                <div class="invalid-feedback" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mt-4">
                <InputLabel for="unidades" value="Unidades" />
                <TextInput type="text" name="unidades" id="unidades" v-model="form.unidades" class="mt-1 block w-full" :class="{'is-invalid': usePage().props.errors.unidades}" placeholder="Escribir Unidades"/>
                <div class="invalid-feedback" v-if="form.errors.unidades">
                    {{ form.errors.unidades }}
                </div>
            </div>
            <br />
            <select name="carrera" id="carrera" v-model="form.carrera_id" class="mt-1 block w-full" :class="{'is-invalid': form.errors.carrera}">
                <option value=""disabled selected>Select Carrera</option>
                <option v-for="carrera in carreras" :key="carrera.id" :value="carrera.id">{{ carrera.name }}</option>
            </select>
            <div class="invalid-feedback" v-if="form.errors.carrera_id">
                {{ form.errors.carrera_id }}
            </div>
            <br />
            <div class="row justify-content-center">
                <div class="col-auto">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Editar
                    </PrimaryButton>
                </div>
            </div>

        </form>
    </FormLayout>
</template>