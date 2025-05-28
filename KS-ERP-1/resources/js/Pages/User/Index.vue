<template>

    <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
            <h1>Main User</h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Main User</p>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Add New User</h4>

                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Name</label>
                                <div class="col-12">
                                    <input id="name" v-model="form.name" name="name" class="form-control here" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Email</label>
                                <div class="col-12">
                                    <input id="email" v-model="form.email" name="email" class="form-control here" type="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Password</label>
                                <div class="col-12">
                                    <input id="password" v-model="form.password" name="password" class="form-control here" type="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button @click="submit()" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.users" :key="index">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" 
                                            data-bs-toggle="modal" 
                                            class="btn btn-outline-success">Info
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static">
                                                <span class="sr-only">Info</span>
                                            </button>

                                            <div class="dropdown-menu">
                                                <Link
                                                    :data-bs-toggle="'modal'"
                                                    :data-bs-target="'#modal-add-contact-' + user.id"
                                                    class="dropdown-item"
                                                    @click="editUser(item.id)"
                                                    >Edit
                                                    <!-- :href="`/user/` + item.id + `/edit`" -->
                                                </Link>
                                                <Link class="dropdown-item" href="#" @click="onDelete(item.id)">Delete</Link>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Contact Button  -->
    <div class="modal fade modal-add-contact" :id="'modal-add-contact-' + user.id" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <form>
                <div class="modal-header px-4">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
                </div>

                <div class="modal-body px-4">
                <div class="row mb-2">
                    <div class="form-group row">
                        <label for="text" class="col-12 col-form-label">Name</label>
                        <div class="col-12">
                            <input id="name" v-model="user.name" name="name" class="form-control here" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-12 col-form-label">Email</label>
                        <div class="col-12">
                            <input id="email" v-model="user.email" name="email" class="form-control here" type="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-12 col-form-label">Password</label>
                        <div class="col-12">
                            <input id="password" v-model="user.password" name="password" class="form-control here" type="password">
                        </div>
                    </div>
                </div>
                </div>

                <div class="modal-footer px-4">
                <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-pill" @click="onCreate()">Edit</button>
                </div>
            </form>
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
    users:Object,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
});

function submit() {
    form.post('/user')
};

const user = useForm({
      id: '',
      name: '',
      email: '',
      password: '',
});

const editUser = async (id) => {
    try {
        const response = await axios.get('/user/' + id + '/edit');
        user.id = response.data.id;
        user.name = response.data.name;
        user.email = response.data.email;
    } catch (error) {
        console.error('Error sending data:', error);
    }
};

function onCreate() {
    user.put('/user/'+user.id);
}

function onDelete(id)
{   
    Inertia.delete('/user/'+id);
}
</script>

