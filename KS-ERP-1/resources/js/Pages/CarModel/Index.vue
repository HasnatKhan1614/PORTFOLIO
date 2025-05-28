<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Car Model</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Car Model
            </p>
        </div>
        <div>
            <Link :href="`car-model/create`" class="btn btn-primary"> Add Car Model</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.car_models" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.make.name }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        <Link :href="`/car-model/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link>
                                        <Link @click="onDelete(item.id)" class="delete-icon"><i class="mdi mdi-delete-circle"></i></Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    car_models:Object,
});

function onDelete(id)
{   
    Inertia.delete('/car-model/'+id);
}
</script>

