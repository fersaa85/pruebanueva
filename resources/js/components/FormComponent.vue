<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Registro de empleados</h1>
        </div>
    </div>

        <div class="row">
            <div class="col">
                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                    <b-form-group id="input-group-2" label="Nombre" label-for="input-2">
                        <b-form-input
                                id="input-2"
                                type="text"
                                :state="validation.name"
                                v-model="form.name"
                                placeholder="El nombre es obligatorio."
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                            El nombre es obligatorio.
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group id="input-group-7" label="Puesto" label-for="input-2">
                        <b-form-input
                                id="input-2"
                                type="text"
                                :state="validation.job"
                                v-model="form.job"
                                placeholder="El puesto es obligatorio."
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                            El puesto es obligatorio.
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                            id="input-group-1"
                            label="Email address:"
                            label-for="input-1"
                            description=""
                    >
                        <b-form-input
                                id="input-1"
                                :state="validation.email"
                                v-model="form.email"
                                type="email"
                                placeholder="Ingrese su email"
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                            El correo electrónico es obligatorio y en un formato valido
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group
                            id="input-group-5"
                            label="Fecha de nacimiento"
                            label-for="input-3">
                        <b-form-input
                                id="input-5"
                                :state="validation.date"
                                v-model="form.date"
                                type="date"
                                placeholder="Ingrese su fehca de nacimiento"
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                            La fecha de nacimiento es obligatoria.
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group id="input-group-6" label="Domicilio" label-for="input-6">
                        <b-form-input
                                id="input-2"
                                type="text"
                                :state="validation.address"
                                v-model="form.address"
                                placeholder="Ingrese su domicilio"
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                            El domicilio es obligatorio
                        </b-form-invalid-feedback>
                    </b-form-group>


                    <b-form-group id="input-group-4">
                        <b-form-checkbox-group v-model="form.skills" :state="validation.checked" id="checkboxes-4">
                            <template v-if="skills.length">
                                <div v-for="(skill, index) in skills">
                                    <b-form-checkbox :value="skill.name "> {{ skill.name }}</b-form-checkbox>
                                    <b-form-input
                                            type="number"
                                            v-model="skillsValue[skill.name]"
                                            min="1"
                                            max="5">
                                    </b-form-input>

                                </div>
                            </template>

                            <b-form-invalid-feedback :state="validation.checked">Por favor selecione al menos una opcion</b-form-invalid-feedback>
                            <b-form-valid-feedback :state="validation.checked"></b-form-valid-feedback>

                        </b-form-checkbox-group>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Submit</b-button>
                    <b-button type="reset" variant="danger">Reset</b-button>
                </b-form>

                <br>

                <employee-component></employee-component>
            </div>

        </div>

</div>
</template>

<script>


    export default {
        data() {
            return {
                items: [],
                validation: {
                    name: null,
                    email: null,
                    date: null,
                    address: null,
                    skills: null,
                    job: null
                },
                form: {
                    email: '',
                    name: '',
                    date: '',
                    address: '',
                    job: '',
                    skills: []
                },
                show: true,
                skills: [],
                skillsValue: {}
            }
        },
        mounted(){
            axios.get('http://127.0.0.1:8000/api/skills', {
            }).then(response => {
                this.skills = [].concat(response.data.data);


                response.data.data.forEach( (currentvalue) => {
                    this.skillsValue[currentvalue.name] = '';
                });

                console.log(' this.skillsValue',  this.skillsValue);
            })
        },
        methods: {

            onSubmit(evt) {
                this.onCheckForm();

                let format = this.form.date.split('-');
                let formatDate = `${format[2]}/${format[1]}/${format[0]}`;
                axios.post('http://127.0.0.1:8000/api/employees', {
                    name: this.form.name,
                    email: this.form.email,
                    date: formatDate,
                    skills: this.form.skills,
                    address: this.form.address,
                    job: this.form.job,
                    skillsValues: this.skillsValue
                }).then(response => {
                    (this.items = response.data)
                })
                this.onReset();
                alert(JSON.stringify(this.form))
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.email = ''
                this.form.name = ''
                this.form.date = ''
                this.form.address = ''
                this.form.job = ''
                this.form.skills = []
                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            },
            onCheckForm: function (e) {
                this.validation.name = this.form.name.length > 0 ? true : false;
                this.validation.email = this.form.email.length > 0 ? this.validEmail(this.form.email) : false;
                this.validation.date = this.form.date.length > 0 ? true : false;
                this.validation.address = this.form.address.length > 0 ? true : false;
                this.validation.job = this.form.job.length > 0 ? true : false;
                this.validation.skills = this.form.skills.length > 0 ? true : false;

            },
            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }

    }
</script>
