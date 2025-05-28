<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Inventory</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Inventory
                <span><i class="mdi mdi-chevron-right"></i></span>Create
            </p>
        </div>
        <div>
            <Link :href="`/vendorr`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Add New Inventory</h4>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Date</label>
                                    <div class="col-12">
                                        <input id="date" v-model="form.date" name="date" class="form-control here" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Product</label>
                                    <select id="product_id" v-model="form.product_id" name="product_id" class="form-control" @change="updateBarcode">
                                        <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Barcode</label>
                                    <input id="barcode" v-model="form.barcode" name="barcode" class="form-control here" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Quantity</label>
                                    <input id="quantity" v-model="form.quantity" name="quantity" class="form-control here" type="number">
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
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue'; // Import computed
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

const props = defineProps({
    products: Object,
});

const form = useForm({
    id: '',
    date: '',
    product_id: '',
    quantity: '',
});

function submit() {
    form.post('/inventory');
}

function updateBarcode() {
    const selectedProductId = form.product_id;
    
    const selectedProduct = props.products.find(product => product.id === selectedProductId);
    if (selectedProduct) {
        form.barcode = selectedProduct.barcode;
    } else {
        form.barcode = '';
    }
}
</script>

