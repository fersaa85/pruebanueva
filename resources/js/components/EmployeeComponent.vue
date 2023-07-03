<template>
    <div>
        <h1>Empleados registrados</h1>

        <template v-if="items.length">
            <b-table striped hover :items="items">
                <template v-slot:cell(email)="data">
                    <!-- `data.value` is the value after formatted by the Formatter -->
                    <a v-on:click="onDetail(data.value)" href="#">{{ data.value }}</a>
                </template>

            </b-table>
        </template>
    </div>
</template>

<script>

    export default {
        mounted(){
            axios.get('http://127.0.0.1:8000/api/employees', {
            }).then(response => {
                (this.items = [].concat(response.data.data));
            })
        },
        methods: {
            onDetail(value) {

                this.$router.push({ path: '/empleado/'+value.toString().toLowerCase()})
            }
        },

        data() {
            return {
                files: [
                    {key: 'id' },
                    {key: 'name'},
                    {key: 'email'}
                ],
                items: [
                ]
            }
        }
    }
</script>