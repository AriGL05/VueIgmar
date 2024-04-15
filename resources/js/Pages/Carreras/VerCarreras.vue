<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CarreraTable from '@/Components/CarreraTable.vue';
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <Head title="Agregar Carreras" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Agregar Carreras</h2>
                <div>
                    <Link :href="route('carreras.create')" class="btn btn-primary">+</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <CarreraTable :carreras="carreras"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>

export default {
    components: {
        CarreraTable
    },
    props: {
        carreras: Array 
    }
}
</script>