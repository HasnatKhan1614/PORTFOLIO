<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Vendor</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Vendor
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
                        <h4>Add New Vendor</h4>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Name</label>
                                <div class="col-12">
                                    <input id="name" v-model="form.name" name="name" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Email</label>
                                <div class="col-12">
                                    <input id="email" v-model="form.email" name="email" class="form-control here" type="text">
                                </div>
                            </div>
                            </div> -->
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Address</label>
                                <div class="col-12">
                                    <input id="address" v-model="form.address" name="address" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Country</label>
                                <div class="col-12">
                                    <input id="country" v-model="form.country" name="country" class="form-control here" type="text">
                                </div>
                            </div>
                            </div> -->
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">City</label>
                                <div class="col-12">
                                    <input id="city" v-model="form.city" name="city" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Telephone</label>
                                <div class="col-12">
                                    <input id="telephone" v-model="form.telephone" name="telephone" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">RES</label>
                                <div class="col-12">
                                    <input id="res" v-model="form.res" name="res" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Fax</label>
                                <div class="col-12">
                                    <input id="fax" v-model="form.fax" name="fax" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">S.man</label>
                                <div class="col-12">
                                    <input id="s_man" v-model="form.s_man" name="s_man" class="form-control here" type="text">
                                </div>
                            </div>
                            </div> -->
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Mobile</label>
                                <div class="col-12">
                                    <input id="mobile" v-model="form.mobile" name="mobile" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">STRN</label>
                                <div class="col-12">
                                    <input id="strn" v-model="form.strn" name="strn" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">NTN</label>
                                <div class="col-12">
                                    <input id="ntn" v-model="form.ntn" name="ntn" class="form-control here" type="text">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Date</label>
                                <div class="col-12">
                                    <input id="date" v-model="form.date" name="date" class="form-control here" type="date">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Balance Type</label>
                                <div class="col-12">
                                    <select id="balance_type" v-model="form.balance_type" name="balance_type" class="form-control here">
                                        <option value="debit">debit</option>
                                        <option value="credit">credit</option>
                                    </select>
                                </div>
                            </div>
                            </div> -->
                            <div class="col-xl-6 col-lg-6">

                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Opening Balance</label>
                                <div class="col-12">
                                    <input id="opening_balance" v-model="form.opening_balance" name="opening_balance" class="form-control here" type="number">
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

const form = useForm({
    id: '',
    name: '',
    // email: '',
    address: '',
    // country: '',
    city: '',
    // telephone: '',
    // res: '',
    // fax: '',
    // s_man: '',
    mobile: '',
    // strn: '',
    // ntn: '',
    // date: '',
    // balance_type: '',
    opening_balance: '',
});

function submit() {
    form.post('/vendorr')
};
</script>

