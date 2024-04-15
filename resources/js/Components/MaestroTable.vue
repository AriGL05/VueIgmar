<template>
    <h1 >Lista de Maestros</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Materia</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="maestro in maestros" :key="maestro.id" scope="row">
                    <td class="h-100">
                        {{maestro.name}}
                    </td>
                    <td>
                        {{maestro.lastname}}
                    </td>
                    <td>
                        {{maestro.email}}
                    </td>
                    <td>
                        {{maestro.genero}}
                    </td>
                    <td>
                        {{maestro.materia.name}}
                    </td>
                    <td>
                        <button type="button" class="btn pt-0 m-0 btn-lg" @click="editCarrera(maestro.id)">
                            Editar
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn p-0 m-0 me-3 btn-lg" @click="destroy(maestro.id)">
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
        name:"maestros",

        data(){
            return {
                loading: false,
            }
        },
        props: {
            add : Function,
            maestros: Array,
        },
        components: {
            Link,
        },
        methods: {
            editCarrera(id) {
                router.visit(route('maestros.edit', { id: id }), {
                    replace: true
                });
            },
            destroy(id) {
                router.delete(route("maestros.destroy", {id: id}))
            }
        }
    }
</script>