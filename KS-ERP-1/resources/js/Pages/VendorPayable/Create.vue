<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Vendor Payable</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Vendor Payable
                <span><i class="mdi mdi-chevron-right"></i></span>Create
            </p>
        </div>
        <div>
            <Link :href="`/vendor-payable`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Add New Vendor Payable</h4>
                        <div class="row">
                            
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Vendor</label>
                                    <div class="col-12">
                                        <select id="vendor_id" v-model="form.vendor_id" @change="fetchVendorBalance()" name="vendor_id" class="form-control">
                                            <option value="" disabled selected>Select Vendor</option>
                                            <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.name }}</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Vendor Balance</label>
                                    <div class="col-12">
                                    <input id="vendor_balance" v-model="form.vendor_balance" name="vendor_balance" class="form-control here" type="number" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Amount</label>
                                    <div class="col-12">
                                        <input id="amount" v-model="form.amount" name="amount" @change="calculateNewBalance()" class="form-control here" type="number">
                                    </div>
                                </div>                            
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Payment Type</label>
                                    <div class="col-12">
                                        <select id="payment_type" v-model="form.payment_type" name="payment_type" class="form-control">
                                            <option value="cash">Cash</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="online_transfer">Online Transfer</option>
                                        </select>

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
                                    <label for="text" class="col-12 col-form-label">New Balance</label>
                                    <div class="col-12">
                                        
                                        <input id="new_balance" :value="(form.vendor_balance - form.amount).toFixed(2)" name="new_balance" class="form-control here" type="number">
                                    </div>
                                </div>                            
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Remarks</label>
                                    <div class="col-12">
                                        <input id="remarks" v-model="form.remarks" name="remarks" class="form-control here" type="text">

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
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

const props = defineProps({
    vendors: Object,
});

const form = useForm({
    vendor_id: '',
    amount: '',
    payment_type: '',
    date: '',
    vendor_balance: '', // Include vendor_balance in the form data
    new_balance: '',
    remarks: '',
});

// Add a ref to store the selected vendor's balance
const vendorBalance = ref('');

// Function to fetch the vendor's balance
async function fetchVendorBalance() {
    if (form.vendor_id) {
        try {
            const response = await axios.get(`/get-vendor-balance/${form.vendor_id}`);
            if (response.data.balance !== undefined) {
                vendorBalance.value = response.data.balance; // Update vendor_balance using the ref
                form.vendor_balance = response.data.balance; // Update the form field with the balance
            }
        } catch (error) {
            console.error('Error fetching vendor balance:', error);
        }
    }
}

// Function to calculate the new balance based on vendor_balance and amount
function calculateNewBalance() {
    const newBalance = form.vendor_balance - form.amount;
    form.new_balance = newBalance;
}

// Event listener for changes in the vendor_id field using 'keyup'
watch(form.vendor_id, fetchVendorBalance);

// Event listener for changes in the amount field using 'input'
watch(form.amount, calculateNewBalance);

function submit() {
    form.post('/vendor-payable');
}
</script>









