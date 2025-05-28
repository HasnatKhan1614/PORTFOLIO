<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Sale</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Sale
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
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
                        <div class="row">
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
                                    <label for="text" class="col-12 col-form-label">Customer</label>
                                    <div class="col-12">
                                        <input value="walk in customer" id="walk_in_customer" name="walk_in_customer" class="form-control here" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Payment Type</label>
                                    <div class="col-12">
                                        <select v-model="form.payment_type" name="payment_type" class="form-control here">
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6" >
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Transaction Id</label>
                                    <div class="col-12">
                                        <input id="transaction_id" v-model="form.transaction_id" name="transaction_id" class="form-control here" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div v-for="(inputGroup, index) in inputGroups" :key="index">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product</label>
                                        <select v-model="inputGroup.product_id" @change="selectProduct(inputGroup)" class="form-control">
                                            <option :value="null" disabled>Select Product</option>
                                            <option v-for="product in products" :key="product.id" :value="product.id">
                                                {{ product.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Price</label>
                                        <div class="col-12">
                                            <input v-model="inputGroup.price" :name="`inputGroups[${index}][price]`" class="form-control here" type="number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Quantity</label>
                                        <div class="col-12">
                                            <input v-model="inputGroup.quantity" :name="`inputGroups[${index}][quantity]`" class="form-control here" type="number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Total Price</label>
                                        <div class="col-12">
                                            <input  :value="(inputGroup.price * inputGroup.quantity).toFixed(2)" readonly class="form-control here" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 mt-3">
                                    <div class="form-group row">
                                    <div class="col-12">
                                        <button class="btn btn-primary mt-4" type="button" @click="removeInput(index)" v-if="inputGroups.length > 1">Remove</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button @click="submit()" class="btn btn-primary">Submit</button>
                                <button class="btn btn-primary mx-2" type="button" @click="appendInputs">Add Product</button>
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
import { computed } from 'vue';
import { ref, watch } from 'vue';

const props = defineProps({
    products: Object,
    sale: Object,
    sale_order_item: Object,
});

const form = {
  date: props.sale.date,
  payment_type: props.sale.payment_type,
  transaction_id: props.sale.transaction_id,
};

const inputGroups = ref(
  props.sale_order_item.map(item => ({
    product_id: item.product_id,
    quantity: item.quantity,
    price: item.price,
  }))
);

function appendInputs() {
  inputGroups.value.push({
    product_id: '',
    quantity: '',
    price: '',
  });
}

function removeInput(index) {
  inputGroups.value.splice(index, 1);
}

watch(inputGroups, (newInputGroups, oldInputGroups) => {
    newInputGroups.forEach((group, index) => {
        if (group.price && group.quantity) {
            group.total_price = (parseFloat(group.price) * parseFloat(group.quantity)).toFixed(2);
        } else {
            group.total_price = '';
        }
    });
});

function isProductSelected(productId, currentIndex) {
    return inputGroups.value.some((group, index) => index !== currentIndex && group.product_id === productId);
}

function selectProduct(inputGroup) {
    const currentIndex = inputGroups.value.indexOf(inputGroup);
    if (isProductSelected(inputGroup.product_id, currentIndex)) {
        inputGroup.product_id = null;
        toast.error('This product has already been selected in another input group.');
    }
}

const formData = useForm({
  date: form.date,
  payment_type: form.payment_type,
  transaction_id: form.transaction_id,
  product_id: inputGroups.value.map(group => group.product_id),
  quantity: inputGroups.value.map(group => group.quantity),
  price: inputGroups.value.map(group => group.price),
});

function submit() {
  // Update formData with the latest data from inputGroups
  formData.date = form.date;
  formData.payment_type = form.payment_type;
  formData.transaction_id = form.transaction_id;
  formData.product_id = inputGroups.value.map(group => group.product_id);
  formData.quantity = inputGroups.value.map(group => group.quantity);
  formData.price = inputGroups.value.map(group => group.price);

  formData.put('/sale/' + props.sale.id);
}

// Add a computed property to determine whether to hide the Card Number input
// const isCardPayment = computed(() => {
//     return form.payment_type === 'card';
// });

const appendedValues = ref([]);
</script>

