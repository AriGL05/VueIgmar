<template>
    <h1 >Lista de Alumnos</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Carrera</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="alumno in alumnos" :key="alumno.id" scope="row">
                    <td class="h-100">
                        {{alumno.name}}
                    </td>
                    <td>
                        {{alumno.lastname}}
                    </td>
                    <td>
                        {{alumno.genero}}
                    </td>
                    <td>
                        {{alumno.carrera.name}}
                    </td>
                    <td>
                        <button type="button" class="btn pt-0 m-0 btn-lg" @click="editAlumno(alumno.id)">
                            Editar
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn p-0 m-0 me-3 btn-lg" @click="destroy(alumno.id)">
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
        name:"alumnos",

        data(){
            return {
                loading: false,
            }
        },
        props: {
            add : Function,
            alumnos: Array,
        },
        components: {
            Link,
        },
        methods: {
            editAlumno(id) {
                router.visit(route('alumnos.edit', { id: id }), {
                    replace: true
                });
            },
            destroy(id) {
                router.delete(route("alumnos.destroy", {id: id}))
            }
        }
    }
</script>