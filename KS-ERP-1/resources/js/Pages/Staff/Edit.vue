<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Staff</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Staff
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
            </p>
        </div>
        <div>
            <Link :href="`/staff`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div class="row">
                            
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Identity Number</label>
                                    <div class="col-12">
                                        <input id="identity_number" v-model="form.identity_number" name="identity_number" class="form-control here" type="number">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Name</label>
                                    <div class="col-12">
                                        <input id="name" v-model="form.name" name="name" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Contact</label>
                                    <div class="col-12">
                                        <input id="contact" v-model="form.contact" name="contact" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Address</label>
                                    <div class="col-12">
                                        <input id="address" v-model="form.address" name="address" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Salary</label>
                                    <div class="col-12">
                                        <input id="salary" v-model="form.salary" name="salary" class="form-control here" type="number">
                                    </div>
                                </div>                            
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button @click="submit()" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios';

const props = defineProps({
    staff:Object,
});

const form = useForm({
    id: props.staff.id,
    identity_number: props.staff.identity_number,
    name: props.staff.name,
    contact: props.staff.contact,
    address: props.staff.address,
    salary: props.staff.salary,

});

function submit() {
    form.put('/staff/'+form.id);
}
</script>

