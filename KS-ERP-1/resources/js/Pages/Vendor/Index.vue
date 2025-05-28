<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Vendor</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Vendor
            </p>
        </div>
        <div>
            <Link :href="`vendorr/create`" class="btn btn-primary"> Add Vendor</Link>
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
                                    <!-- <th>Email</th> -->
                                    <th>Address</th>
                                    <!-- <th>Country</th> -->
                                    <th>City</th>
                                    <!-- <th>Telephone</th>
                                    <th>RES</th>
                                    <th>Fax</th>
                                    <th>S.man</th> -->
                                    <th>Mobile</th>
                                    <!-- <th>STRN</th>
                                    <th>NTN</th>
                                    <th>Date</th>
                                    <th>Balance Type</th> -->
                                    <th>Opening Balance</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.vendors" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <!-- <td>{{ item.email }}</td> -->
                                    <td>{{ item.address }}</td>
                                    <!-- <td>{{ item.country }}</td> -->
                                    <td>{{ item.city }}</td>
                                    <!-- <td>{{ item.telephone }}</td> -->
                                    <!-- <td>{{ item.res }}</td> -->
                                    <!-- <td>{{ item.fax }}</td> -->
                                    <!-- <td>{{ item.s_man }}</td> -->
                                    <td>{{ item.mobile }}</td>
                                    <!-- <td>{{ item.strn }}</td> -->
                                    <!-- <td>{{ item.ntn }}</td> -->
                                    <!-- <td>{{ item.date }}</td> -->
                                    <!-- <td>{{ item.balance_type }}</td> -->
                                    <td>{{ item.opening_balance }}</td>
                                    <td>
                                        <Link :href="`/vendorr/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link>
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
    vendors:Object,
});

function onDelete(id)
{   
    Inertia.delete('/vendorr/'+id);
}
</script>

