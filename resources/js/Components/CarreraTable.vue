<template>
    <h1 >Lista de Carreras</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Enfoque</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="carrera in carreras" :key="carrera.id" scope="row">
                    <td class="h-100">
                        {{carrera.name}}
                    </td>
                    <td>
                        {{carrera.enfoque}}
                    </td>
                    <td>
                        <button type="button" class="btn pt-0 m-0 btn-lg" @click="editCarrera(carrera.id)">
                            Editar
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn p-0 m-0 me-3 btn-lg" @click="destroy(carrera.id)">
                            Borrar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    import { Link } from '@inertiajs/vue3';
    import { router } from '@inertiajs/vue3';
    import 'bootstrap/dist/css/bootstrap.min.css';


    export default {
        name:"carreras",

        data(){
            return {
                loading: false,
            }
        },
        props: {
            add : Function,
            carreras: Array,
        },
        components: {
            Link,
        },
        methods: {
            editCarrera(id) {
                router.visit(route('carreras.edit', { id: id }), {
                    replace: true
                });
            },
            destroy(id) {
                router.delete(route("carreras.destroy", {id: id}))
            }
        }
    }
</script>