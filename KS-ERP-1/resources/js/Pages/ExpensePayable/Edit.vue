<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Expense Payable</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Expense Payable
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
            </p>
        </div>
        <div>
            <Link :href="`/expense_payable`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div class="row">
                            
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Title</label>
                                    <div class="col-12">
                                        <select id="expense_payable_head_id" v-model="form.expense_payable_head_id" name="expense_payable_head_id" class="form-control">
                                            <option v-for="expense_payable_head in expense_payable_heads" :key="expense_payable_head.id" :value="expense_payable_head.id">{{ expense_payable_head.name }}</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Amount</label>
                                    <div class="col-12">
                                        <input id="amount" v-model="form.amount" name="amount" class="form-control here" type="number">
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
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios';

const props = defineProps({
    expense_payable:Object,
    expense_payable_heads:Object,
});

const form = useForm({
    id: props.expense_payable.id,
    expense_payable_head_id: props.expense_payable.expense_payable_head_id,
    amount: props.expense_payable.amount,
    date: props.expense_payable.date,
    remarks: props.expense_payable.remarks,

});

function submit() {
    form.put('/expense-payable/'+form.id);
}
</script>

