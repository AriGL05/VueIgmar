<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import MaestroTable from '@/Components/MaestroTable.vue';
import { Link } from '@inertiajs/vue3'

</script>

<template>
    <Head title="Maestros" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Agregar Maestros</h2>
                <div>
                    <Link :href="route('maestros.create')" class="btn btn-primary">+</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <MaestroTable :maestros="maestros"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>

export default {
    components: {
        MaestroTable
    },
    props: {
        maestros: Array 
    }
}
</script>