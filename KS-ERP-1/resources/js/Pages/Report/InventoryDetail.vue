<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Inventory Report</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Inventory Report
            </p>
        </div>
        <div>
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
                                    <th>Stock In</th>
                                    <th>Stock Out</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.inventories" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.stock_in }}</td>
                                    <td>{{ item.stock_out }}</td>
                                    <td>{{ item.stock }}</td>
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
    inventories:Object,
});
</script>

