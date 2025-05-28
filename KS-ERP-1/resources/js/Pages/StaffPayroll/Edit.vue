<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Staff Payroll</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Staff Payroll
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
            </p>
        </div>
        <div>
            <Link :href="`/staff-payroll`" class="btn btn-primary">Back</Link>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div class="row">
                            
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Staff</label>
                                    <div class="col-12">
                                        <select id="staff_id" v-model="form.staff_id" name="staff_id" class="form-control">
                                            <option v-for="person in staff" :key="person.id" :value="person.id">{{ person.name }}</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Month</label>
                                    <div class="col-12">
                                        <select id="month" v-model="form.month" name="month" class="form-control here">
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Year</label>
                                    <div class="col-12">
                                        <select id="year" v-model="form.year" name="year" class="form-control">
                                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                        </select>
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
import { ref, watch, onMounted } from 'vue';


const props = defineProps({
    years:Object,
    staff:Object,
    staff_payroll:Object,
});

const form = useForm({
    id:props.staff_payroll.id,
    staff_id:props.staff_payroll.staff_id,
    month:props.staff_payroll.month,
    year:props.staff_payroll.year,

});

function submit() {
    form.put('/staff-payroll/'+form.id);
}

onMounted(() => {
  form.year = new Date().getFullYear().toString();
});
</script>

