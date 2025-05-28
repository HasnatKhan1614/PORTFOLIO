<template>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15"><span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">POINT OF SALE</h2>
                        </div>
                        <!-- <div class="text-muted">
                            <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> xyz@987.com</p>
                            <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                        </div> -->
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <!-- <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">Preston Miller</h5>
                                <p class="mb-1">4068 Post Avenue Newfolden, MN 56738</p>
                                <p class="mb-1">PrestonMiller@armyspy.com</p>
                                <p>001-234-5678</p> -->
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Date:</h5>
                                    <p>{{props.data.sale.date}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Transaction Id:</h5>
                                    <p>#{{props.data.sale.transaction_id}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Discount %:</h5>
                                    <p v-if="props.data.sale.discount_percent">{{props.data.sale.discount_percent}}%</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Discount Amount:</h5>
                                    <p v-if="props.data.sale.discount_amount">{{props.data.sale.discount_amount }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th class="text-end" style="width: 120px;">Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr v-for="(item, index) in props.data.saleOrderItem" :key="index">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ item.product_id }}</td>
                                        <td>{{ item.quantity }}</td>
                                        <td>{{ item.price }}</td>
                                        <td>{{ item.quantity * item.price }}</td>
                                        <td class="text-end"> {{ item.quantity * item.price }}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Total</th>
                                        <td class="text-end">{{total}}</td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <!-- <th scope="row" colspan="4" class="border-0 text-end">
                                            Discount :</th>
                                        <td class="border-0 text-end">- 25.50</td> -->
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <!-- <th scope="row" colspan="4" class="border-0 text-end">
                                            Shipping Charge :</th>
                                        <td class="border-0 text-end">20.00</td> -->
                                    </tr>
                                    <!-- end tr -->
                                    <!-- <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Tax</th>
                                        <td class="border-0 text-end">12.00</td>
                                    </tr> -->
                                    <!-- end tr -->
                                    <tr>
                                        <!-- <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold">{{total}}</h4></td> -->
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <!-- <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a> -->
                                <!-- <a href="#" class="btn btn-primary w-md">Send</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>
</template>

<script setup>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import { ref, watch } from 'vue';

// Define a reactive variable for the total
const total = ref(0);

const props = defineProps({
    data: Object,
});

// Watch for changes in props.data.saleOrderItem and update the total
watch(() => {
    total.value = calculateTotal(props.data.saleOrderItem);
});

// Function to calculate the total
function calculateTotal(saleOrderItems) {
    return saleOrderItems.reduce((acc, item) => {
        return acc + item.quantity * item.price;
    }, 0);
}
</script>


<style scoped>
body{margin-top:20px;
background-color:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
</style>


