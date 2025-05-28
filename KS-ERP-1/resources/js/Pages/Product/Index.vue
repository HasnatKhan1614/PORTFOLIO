<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Product</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Product
            </p>
        </div>
        <div>
            <Link :href="`product/create`" class="btn btn-primary"> Add Product</Link>
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Buying</th>
                                    <th>Selling</th>
                                    <th>Car Model</th>
                                    <th>Year</th>
                                    <th>Barcode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.products" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <td>£{{ item.buying_price }}</td>
                                    <td>£{{ item.selling_price }}</td>
                                    <td>{{ item.car_model.name + ' <'+ item.car_model.make.name +'>' }}</td>
                                    <td>{{ item.year }}</td>
                                    <td>{{ item.barcode }}</td>
                                    <td>
                                        <Link :href="`/product/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link>
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
    products:Object,
});

function onDelete(id)
{   
    Inertia.delete('/product/'+id);
}
</script>

