<template>

    <div>
        <h1>Detalle empleado</h1>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">Nombre</th>
                <td>{{ item.name }}</td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td>{{ item.email }}</td>
            </tr>
            <tr>
                <th scope="row">Puesto</th>
                <td>{{ item.job }}</td>

            </tr>
            <tr>
                <th scope="row">Direccion</th>
                <td>{{ item.address }}</td>

            </tr>
            <tr>
                <th scope="row">Skills</th>
                <td>
                    <ul>
                        <div v-for="(skill, index) in item.skills">
                            <li>{{ skill.name }} experiencia {{  skill.value }}</li>
                        </div>
                    </ul>
                </td>

            </tr>
            </tbody>
        </table>

        <div>
            <GmapMap id="mapRef"
                     :center="center"
                     :zoom="13"
                     map-type-id="terrain"
                     style="width: 500px; height: 300px"
            >
                <GmapMarker
                        v-for="(m, index) in markers"
                        :key="index"
                        :position="m.position"
                />
            </GmapMap>
        </div>
    </div>



</template>

<script>

    export default {
        data() {
            return {
                item : {},
                center: {
                    lat: 10.0,
                    lng: 10.0
                },
                markers: []
            }
        },
        mounted(){
            axios.get("http://127.0.0.1:8000/api/employees/"+ this.$route.params.email, {
            }).then(response => {
                this.item = response.data.data;
                this.center.lat  = this.item.l

                this.center.lat = parseFloat(this.item.lat);
                this.center.lng = parseFloat(this.item.lng);
                console.log( this.center)

                this.markers = [{
                    position: {
                        lat: this.center.lat,
                        lng: this.center.lng
                    }
                }]
            })
        },

        methods: {

        }
    }
</script>