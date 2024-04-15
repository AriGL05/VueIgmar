<template>
    <h1 >Lista de materias</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Carrera</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="materia in materias" :key="materia.id" scope="row">
                    <td class="h-100">
                        {{materia.name}}
                    </td>
                    <td>
                        {{materia.unidades}}
                    </td>
                    <td>
                        {{materia.carrera.name}}
                    </td>
                    <td>
                        <button type="button" class="btn pt-0 m-0 btn-lg" @click="editMateria(materia.id)">
                            Editar
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn p-0 m-0 me-3 btn-lg" @click="destroy(materia.id)">
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
        name:"materias",

        data(){
            return {
                loading: false,
            }
        },
        props: {
            add : Function,
            materias: Array,
        },
        components: {
            Link,
        },
        methods: {
            editMateria(id) {
                router.visit(route('materias.edit', { id: id }), {
                    replace: true
                });
            },
            destroy(id) {
                router.delete(route("materias.destroy", {id: id}))
            }
        }
    }
</script>