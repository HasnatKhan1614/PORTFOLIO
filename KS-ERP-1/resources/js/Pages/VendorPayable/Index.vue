<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Vendor Payables</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Vendor Payables
            </p>
        </div>
        <div>
            <Link :href="`vendor-payable/create`" class="btn btn-primary"> Add Vendor Payables</Link>
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
                                    <th>Vendor</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.vendor_payables" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.vendor.name }}</td>
                                    <td>{{ item.amount }}</td>
                                    <td>{{ item.payment_type }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.remarks }}</td>
                                    <td>
                                        <Link :href="`/vendor-payable/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link>
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
    vendor_payables:Object,
});

function onDelete(id)
{   
    Inertia.delete('/vendor-payable/'+id);
}
</script>

