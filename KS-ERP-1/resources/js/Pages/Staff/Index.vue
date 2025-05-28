<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Staff</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Staff
            </p>
        </div>
        <div>
            <Link :href="`staff/create`" class="btn btn-primary"> Add Staff</Link>
        </div>
    </div>

    <form @submit.prevent="generatePayroll" >    
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <h4>Generate Payroll</h4>
                            <div class="row">
                                
                                <div class="col-xl-5 col-lg-5">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Month</label>
                                        <div class="col-12">
                                            <input id="month" v-model="form.month" name="month" class="form-control here" type="month">
                                        </div>
                                    </div>                            
                                </div>
                                <div class="col-xl-5 col-lg-5">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Year</label>
                                        <div class="col-12">
                                                <select id="year" v-model="form.year" name="year" class="form-control">
                                                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                                </select>
                                        </div>
                                    </div>                            
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label invisible">`</label>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit"> Generate Payroll</button>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Identity Number</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.staff" :key="index">
                                    <td><input type="checkbox" :value="item.id" v-model="staff_ids"></td>
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.identity_number }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.contact }}</td>
                                    <td>{{ item.address }}</td>
                                    <td>{{ item.salary }}</td>
                                    <td>
                                        <Link :href="`/staff/`+item.id+`/edit`" class="edit-icon"><i class="mdi mdi-circle-edit-outline"></i></Link>
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
import { ref, watch, onMounted } from 'vue'; 

const props = defineProps({
  years: Object,
  staff: Object,
});

const form = useForm({
    month: '',
    year: '', // Initialize year with an empty string
});

const staff_ids = ref([]); // Initialize an array to store checked IDs

// Set the current year when the component is mounted


function onDelete(id) {   
  Inertia.delete('/staff/' + id);
}

async function generatePayroll() {
  try {
    const payload = {
      staff_ids: staff_ids.value,
      month: form.month,
      year: form.year,
    };
    
    const response = await axios.post('/staff-payroll', payload);
    
    if (response.status == 200) {
      toast("Payroll generated successfully!", { autoClose: 3000 });
    } else {
      // Handle any server-side errors here
    }
  } catch (error) {
    console.error('Error sending data:', error);
    // Handle the error here
  }
}


onMounted(() => {
  form.year = new Date().getFullYear().toString();
});
</script>

