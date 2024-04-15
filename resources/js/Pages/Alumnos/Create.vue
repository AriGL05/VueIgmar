<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';


const form = useForm({
    name: '',
    lastname: '',
    genero: 'M',
    carrera_id: '',
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
    form.post(route('alumnos.store'));
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
                        Register
                    </PrimaryButton>
                </div>
            </div>

        </form>
    </FormLayout>
</template>