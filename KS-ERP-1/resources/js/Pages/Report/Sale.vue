<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Sale Report</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Sale Report
            </p>
        </div>
        <div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="product_id" class="">Product</label>
                            <select v-model="product_id" id="product_id" name="product_id" class="form-control">
                                <option v-for="item in props.products" :key="item.id" :value="item.id">{{item.name}}</option>
                            </select>

                        </div>
                        <div class="col-3">
                            <label for="from" class="">From</label>
                            <input v-model="from" id="from" name="from" class="form-control here" type="date">
                        </div>
                        <div class="col-3">
                            <label for="to" class="">To</label>
                            <input v-model="to" id="to" name="to" class="form-control here" type="date">
                        </div>
                            <div class="col-3 mt-5">
                                <button @click="searchData" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                </div>
            </div>
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
                                    <th>Product</th>
                                    <th>Discount Amount</th>
                                    <th>Discount Percent</th>
                                    <th>Payment Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.reportData" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.product }}</td>
                                    <td>{{ item.discount_amount }}</td>
                                    <td>{{ item.discount_percent }}</td>
                                    <td>{{ item.payment_type }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <td>{{ item.total }}</td>
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
import { ref, computed } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios';

const props = defineProps({
    products: Object,
    reportData: Object,
});

const searchData = async () => {
    try {
        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
        const product_id = document.getElementById('product_id').value;

        console.log('Searching for data...');

        const response = await axios.get('/sale-report-detail', {
            params: {
                from: from,
                to: to,
                product_id: product_id,
            },
        });

        // Update props.reportData from the response data
        props.reportData = response.data.reportData;
        console.log(props.reportData);
    } catch (error) {
        toast.error('Error fetching data');
    }
};
</script>


  

