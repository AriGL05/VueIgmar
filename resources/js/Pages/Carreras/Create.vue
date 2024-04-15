<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';


const form = useForm({
    name: '',
    enfoque: '',
});

const submit = async () => {
    form.post(route('carreras.store'));
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
                <InputLabel for="enfoque" value="Enfoque" />
                <TextInput type="text" name="enfoque" id="enfoque" v-model="form.enfoque" class="mt-1 block w-full" :class="{'is-invalid': usePage().props.errors.enfoque}" placeholder="Escribir Enfoque"/>
                <div class="invalid-feedback" v-if="form.errors.enfoque">
                    {{ form.errors.enfoque }}
                </div>
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