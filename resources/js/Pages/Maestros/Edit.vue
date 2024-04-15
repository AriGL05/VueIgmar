<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { watch, computed } from 'vue';

const props = defineProps(['maestro'])

const form = useForm({
    name: props.maestro.name,
    lastname: props.maestro.lastname,
    email: props.maestro.email,
    genero: props.maestro.genero,
    materia_id: props.maestro.materia.id,
    carrera_id: props.maestro.materia.carrera_id,
});
const carreras = ref([]);
const materias = ref([]);

axios.get('/api/carreras')
  .then(response => {
    carreras.value = response.data;
  })
  .catch(error => {
    console.error('Error fetching Carreras:', error);
  });

axios.get('/api/materias')
  .then(response => {
    materias.value = response.data;
  })
  .catch(error => {
    console.error('Error fetching Materias:', error);
  });

watch(() => form.carrera_id, (newValue, oldValue) => {
    form.materia_id = null; // Reset materia_id on Carrera change
});

const filteredMaterias = computed(() => {
    return form.carrera_id ? materias.value.filter(materia => materia.carrera_id === form.carrera_id) : [];
});

const submit = async () => {
    form.put(route('maestros.update', {id: props.maestro.id}))
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
                <InputLabel for="lastname" value="Apellido" />
                <TextInput type="text" name="lastname" id="lastname" v-model="form.lastname" class="mt-1 block w-full" :class="{'is-invalid': usePage().props.errors.lastname}" placeholder="Escribir Apellidos"/>
                <div class="invalid-feedback" v-if="form.errors.lastname">
                    {{ form.errors.lastname }}
                </div>
            </div>
            <div class="mt-4">
                <InputLabel for="email" value="Correo" />
                <TextInput type="email" name="email" id="email" v-model="form.email" class="mt-1 block w-full" :class="{'is-invalid': usePage().props.errors.email}" placeholder="Escribir Correo"/>
                <div class="invalid-feedback" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <InputLabel value="Género" />
                <div>
                    <input type="radio" id="male" name="gender" value="M" v-model="form.genero">
                    <label for="male"class="mx-2">Masculino</label>
                    <input type="radio" id="female" name="gender" value="F" v-model="form.genero">
                    <label for="female"class="mx-2">Femenino</label>
                    <input type="radio" id="other" name="gender" value="O" v-model="form.genero">
                    <label for="other"class="mx-2">Otro</label>
                </div>
            </div>
            <select name="carrera" id="carrera" v-model="form.carrera_id" class="mt-1 block w-full" :class="{'is-invalid': form.errors.carrera}">
                <option value=""disabled selected>Select Carrera</option>
                <option v-for="carrera in carreras" :key="carrera.id" :value="carrera.id">{{ carrera.name }}</option>
            </select>

            <select name="materia" id="materia" v-model="form.materia_id" class="mt-1 block w-full" :class="{'is-invalid': form.errors.materia}">
                <option value=""disabled selected>Select Materia</option>
                <option v-for="materia in filteredMaterias" :key="materia.id" :value="materia.id">{{ materia.name }}</option>
            </select>
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