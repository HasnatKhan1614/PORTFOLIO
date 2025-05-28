<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Product</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Product
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
            </p>
        </div>
        <div>
            <Link :href="`/product`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Name</label>
                                    <div class="col-12">
                                        <input id="name" v-model="form.name" name="name" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Description</label>
                                    <div class="col-12">
                                        <input id="description" v-model="form.description" name="description" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Quantity</label>
                                    <div class="col-12">
                                        <input id="quantity" v-model="form.quantity" name="quantity" class="form-control here" type="number">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Buying Price</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                                        </div>
                                        <input id="buying_price" v-model="form.buying_price" name="buying_price" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Selling Price</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                                        </div>
                                        <input id="selling_price" v-model="form.selling_price" name="selling_price" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Car Model</label>
                                    <div class="col-12">
                                        <select id="car_model_id" v-model="form.car_model_id" name="car_model_id" class="form-control">
                                            <option v-for="car_model in car_models" :key="car_model.id" :value="car_model.id">{{car_model.make.name + ' ' +  car_model.name }}</option>


                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Year</label>
                                    <div class="col-12">
                                        <select id="year" v-model="form.year" name="year" class="form-control">
                                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Barcode</label>
                                    <div class="col-12">
                                        <input id="barcode" v-model="form.barcode" name="barcode" class="form-control here" type="text">
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Image</label>
                                    <div class="col-12">
                                        <input name="name" class="form-control here" type="file">
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
    product:Object,
    years:Object,
    car_models:Object,
});

const form = useForm({
    id:props.product.id,
    car_model_id:props.product.car_model_id,
    name:props.product.name,
    description:props.product.description,
    quantity:props.product.quantity,
    buying_price:props.product.buying_price,
    selling_price:props.product.selling_price,
    year:props.product.year,
    barcode:props.product.barcode,
});

function submit() {
    form.put('/product/'+form.id);
}
</script>

