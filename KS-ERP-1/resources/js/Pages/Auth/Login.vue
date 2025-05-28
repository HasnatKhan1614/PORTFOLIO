<template>

    <div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px"
        style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="ec-brand">
                            <a href="#" title="In Reach" style="border-bottom: none;">
                                <img class="ec-brand-icon" src="/assets/img/logo/logo-white.png" alt=""
                                    style="max-width: 200px;margin-left: 0px;" />
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5">Sign In</h4>

                        <div class="row">

                            <div class="form-group col-md-12 mb-4">
                                <input type="email" v-model="form.email" class="form-control" id="email"
                                    placeholder="Username">

                                <span v-if="form.errors.email" class="fw-bold text-danger">
                                    {{ form.errors.email }}
                                </span>
                            </div>

                            <div class="form-group col-md-12 ">
                                <input type="password" v-model="form.password" class="form-control" id="password"
                                    placeholder="Password">

                                <span v-if="form.errors.password" class="fw-bold text-danger">
                                    {{ form.errors.password }}
                                </span>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" id="submit-button" @click="onSubmit()"
                                    class="btn btn-primary btn-block mb-4">Sign In</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    layout: null
}
</script>

<script setup>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    password: ''
});

async function onSubmit() {
    const response = await form.post('/check');

    if (response.data.success) {
        // Display a success toast message
        toast.success('Authentication successful');

        // Redirect to the 'pos' route
        window.location.href = response.data.redirect;
    } else {
        // Handle authentication failure
        console.error(response.data.message);
    }
}

// Listen for Ctrl+Enter key press
document.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        const submitButton = document.getElementById('submit-button');
        if (submitButton) {
            submitButton.click();
        }
    }
});
</script>
