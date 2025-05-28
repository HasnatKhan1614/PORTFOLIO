<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Sale</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Sale
            </p>
        </div>
        <div>
            <Link :href="`sale/create`" class="btn btn-primary"> Add Sale</Link>
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
                                    <th>Date</th>
                                    <th>Payment Type</th>
                                    <th>Transaction Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.sales" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.payment_type }}</td>
                                    <td>{{ item.transaction_id }}</td>
                                    <td>
                                        <!-- <Link :href="`/sale/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link> -->
                                        <Link :href="`/sale-view/`+item.id" class="edit-icon"><i class="mdi mdi-eye-circle"></i></Link>
                                        <Link @click="onDelete(item.id)" class="delete-icon"><i class="mdi mdi mdi-delete-circle"></i></Link>
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
    sales:Object,
});

function onDelete(id)
{   
    Inertia.delete('/sale/'+id);
}
</script>

