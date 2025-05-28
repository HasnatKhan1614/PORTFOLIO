<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Purchase</h1>
            <p class="breadcrumbs"><span><a href="/">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Purchase
                <span><i class="mdi mdi-chevron-right"></i></span>Edit
            </p>
        </div>
        <div>
            <Link :href="`/purchase`" class="btn btn-primary">Back</Link>
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
                    <label for="text" class="col-12 col-form-label">Vendor</label>
                    <div class="col-12">
                        <select id="vendor_id" v-model="form.vendor_id" name="vendor_id" class="form-control">
                        <option value="">Vendor</option>
                        <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.name }}</option>
                        </select>
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
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                            </div>
                            <input v-model="inputGroup.price" :name="`inputGroups[${index}][price]`" class="form-control here" type="number">
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
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                            </div>
                            <input  :value="(inputGroup.price * inputGroup.quantity).toFixed(2)" readonly class="form-control here" type="text">
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
                    <button @click="onUpdate" class="btn btn-primary">Submit</button>
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
import { ref , watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    products: Object,
    vendors: Object,
    purchase: Object,
    purchase_order_item: Object,
});

const form = {
  date: props.purchase.date,
  vendor_id: props.purchase.vendor_id,
};

const inputGroups = ref(
  props.purchase_order_item.map(item => ({
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
    vendor_id: form.vendor_id,
    purchaseItems: inputGroups.value.map((group) => ({
        product_id: group.product_id,
        quantity: group.quantity,
        price: group.price,
    })),
});

function onUpdate() {
  // Update formData with the latest data from inputGroups
  formData.date = form.date;
  formData.vendor_id = form.vendor_id;
  formData.product_id = inputGroups.value.map(group => group.product_id);
  formData.quantity = inputGroups.value.map(group => group.quantity);
  formData.price = inputGroups.value.map(group => group.price);

  formData.put('/purchase/' + props.purchase.id);
}

const appendedValues = ref([]);
</script>

