<template>

    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
        </div>
        <div>
            <Link :href="`/sale`" class="btn btn-primary">Back</Link>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-3 col-lg-3">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <h4>Add New POS</h4>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Date</label>
                                    <div class="col-12">
                                        <input id="date" v-model="form.date" name="date" class="form-control here"
                                            type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Payment Type</label>
                                    <div class="col-12">
                                        <select v-model="form.payment_type" name="payment_type"
                                            class="form-control here">
                                            <option value="cash" selected>Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Barcode</label>
                                    <div class="col-12">
                                        <!-- <input id="barcode" v-model="form.barcode" name="barcode" class="form-control here" type="text" autofocus="autofocus"> -->
                                        <input id="barcode" v-model="form.barcode" name="barcode"
                                            class="form-control here" type="text" autofocus="autofocus"
                                            @input="searchByBarcode">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Discount %</label>
                                    <div class="col-12">
                                        <!-- <input id="barcode" v-model="form.barcode" name="barcode" class="form-control here" type="text" autofocus="autofocus"> -->
                                        <input id="barcode" v-model="form.discount_percent" name="barcode"
                                            class="form-control here" type="number" autofocus="autofocus"
                                            @keydown="totalAfterDiscount">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Discount Amount</label>
                                    <div class="col-12">
                                        <!-- <input id="barcode" v-model="form.barcode" name="barcode" class="form-control here" type="text" autofocus="autofocus"> -->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                                            </div>
                                            <input id="barcode" v-model="form.discount_amount" name="barcode"
                                                class="form-control here" type="number" autofocus="autofocus"
                                                @keydown="totalAfterDiscount">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <!-- <button id="search" @click="searchByBarcode()" class="btn btn-primary mx-2" type="submit">Search</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div v-for="(inputGroup, index) in inputGroups" :key="index">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3" v-if="inputGroups.length > 0">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product</label>
                                        <select v-model="inputGroup.product_id" @change="selectProduct(inputGroup)"
                                            class="form-control" disabled>
                                            <option :value="null" disabled>Select Product</option>
                                            <option v-for="product in products" :key="product.id" :value="product.id">
                                                {{ product.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2" v-if="inputGroups.length > 0">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Price</label>
                                        <div class="col-12">
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                                                </div>
                                                <input v-model="inputGroup.price" :name="`inputGroups[${index}][price]`"
                                                    class="form-control here" type="number" aria-label="Small"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2" v-if="inputGroups.length > 0">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Quantity</label>
                                        <div class="col-12">
                                            <input v-model="inputGroup.quantity"
                                                :name="`inputGroups[${index}][quantity]`" class="form-control here"
                                                type="number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2" v-if="inputGroups.length > 0">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Total Price</label>
                                        <div class="col-12">
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">£</span>
                                                </div>
                                                <input :value="(inputGroup.price * inputGroup.quantity).toFixed(2)"
                                                    readonly class="form-control here" type="text" aria-label="Small"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 mt-3" v-if="inputGroups.length > 0">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <button class="btn btn-primary mt-4" type="button"
                                                @click="removeInput(index)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button id="submit-button" @click="submit()" class="btn btn-primary">Submit</button>
                                <button class="btn btn-primary mx-2" type="button" @click="appendInputs">Add
                                    Product</button>
                                <button id="submit-button" @click="printContentById()"
                                    class="btn btn-primary">Print</button>
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
                    <div class="col-xl-12 col-lg-12">
                        <h4 style="float: right;">Total Amount <b>£{{ totalAllItemsPrice.toFixed(2) }} </b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="invoice-POS" style="display: none;">

        <center id="top">
            <div class="info">
                <h2>HYDE ROAD MOTOR & SPARE</h2>
            </div>
        </center>

        <div id="mid">
            <div class="info">
                <h2>Details</h2>
                <p>Date : {{form.date}}</p>
                <p>Payment Type : {{form.payment_type}}</p>
                <p v-if="form.discount_amount">Discount : £{{form.discount_amount}}</p>
                <p v-if="form.discount_percent">Discount : £{{form.discount_percent}}%</p>
            </div>
        </div>

        <div id="bot">

            <div id="table">
                <table>
                    <tbody>

                        <tr class="tabletitle">
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>

                        <tr v-for="(inputGroup, index) in inputGroups" :key="index">
                            <td class="tableitem">
                                <p class="itemtext">{{ inputGroup.product_name }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ inputGroup.quantity }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">£{{ inputGroup.price }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">£{{inputGroup.price * inputGroup.quantity}}</p>
                            </td>
                        </tr>

                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>£{{ totalAllItemsPrice }}</h2>
                            </td>
                        </tr>
                    </tbody>


                </table>
            </div><!--End Table-->

            <div id="legalcopy">
                <p class="legal"><strong>Thank you for your business!</strong>
                </p>
            </div>

        </div><!--End InvoiceBot-->
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
});

// Function to get the current date in "YYYY-MM-DD" format
function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Print POS Receipt
function printContentById() {
  const divToPrint = document.getElementById('invoice-POS'); // Retrieve the DOM element
  if (divToPrint) {
    const originalDisplay = divToPrint.style.display;
    divToPrint.style.display = 'block'; // Change to a visible display property
    const printContents = divToPrint.outerHTML;

    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    // Set up an event listener for after the print job
    window.onafterprint = function () {
      document.body.innerHTML = originalContents;
      divToPrint.style.display = originalDisplay; // Restore the original display property

      // Remove the event listener to prevent it from being triggered again
      window.onafterprint = null;
    };

    // Trigger the print
    window.print();

    window.location.reload();
  }
}

const form = ref({
    date: getCurrentDate(),
    payment_type: 'cash',
    barcode: '',
    transaction_id: '',
    discount_percent: '',
    discount_amount: '',
});


const inputGroups = ref([]);
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

// Compute the total price for all input groups
const totalAllItemsPrice = computed(() => {
    const totalPriceBeforeDiscount = inputGroups.value.reduce((total, group) => total + (parseFloat(group.price) * parseFloat(group.quantity) || 0), 0);
    const discountAmount = parseFloat(form.value.discount_amount) || 0;
    const discountPercentage = parseFloat(form.value.discount_percent) || 0;

    // Calculate the total price after applying the discount
    const discountedPrice = totalPriceBeforeDiscount - discountAmount;
    const discountedPriceWithPercentage = discountedPrice - (totalPriceBeforeDiscount * (discountPercentage / 100));

    return discountedPriceWithPercentage;
});

function totalAfterDiscount() {
  // Compute the total price whenever a key is pressed
  totalAllItemsPrice.value = totalAllItemsPrice.value;
}



function isProductSelected(productId, currentIndex) {
    return inputGroups.value.some((group, index) => index !== currentIndex && group.product_id === productId);
}


// Function to fetch product details based on the barcode
async function searchByBarcode() {
    const barcode = form.value.barcode;
    console.log(form.value.barcode)

    if (!barcode) {
        toast.error('Please enter a barcode to search.');
        return;
    }

    // You can make an API request to fetch product details based on the barcode
    try {
        const response = await axios.get(`/get-product-by-barcode/${barcode}`); // Replace with your actual API endpoint
        const productData = response.data; // Assuming the API returns product data

        if (productData) {
            let productFound = false;

            // Check if the product already exists in inputGroups
            inputGroups.value.forEach((inputGroup) => {
                if (inputGroup.product_id === productData.id) {
                    inputGroup.quantity += 1; // Increment the quantity
                    productFound = true;
                }
            });

            if (!productFound) {
                // If the product is not found, add it to inputGroups
                inputGroups.value.push({
                    product_id: productData.id,
                    product_name: productData.name,
                    price: productData.selling_price,
                    quantity: 1,
                });
            }

            // Clear the barcode field
            form.value.barcode = '';

            toast.success('Product details retrieved.');
        } else {
            // toast.error('Product not found for the given barcode.');
        }
    } catch (error) {
        toast.error('An error occurred while fetching product details.');
    }
}

function submit() {
  // Prepare the form data
  const formData = {
    date: form.value.date,
    payment_type: form.value.payment_type,
    transaction_id: form.value.transaction_id,
    discount_percent: form.value.discount_percent,
    discount_amount: form.value.discount_amount,
    product_id: inputGroups.value.map(group => group.product_id),
    quantity: inputGroups.value.map(group => group.quantity),
    price: inputGroups.value.map(group => group.price),
  };

  // Make the Axios request to submit the form
    axios.post('/sale', formData)
    .then(response => {
 
      // Handle the successful response here
      // You can also use response.data to access the server response

      // Display a success toast message
    //   toast.success('Sale submitted successfully');

      // Clear the form fields
      form.value.date = '';
      form.value.payment_type = '';
      form.value.transaction_id = '';
      form.value.barcode = ''; // Clear any other form fields as needed

      inputGroups.value = [];

      printContentById();

      // Reload the page after a successful submission
      window.location.reload();

    })
    .catch(error => {
        if (error.response && error.response.status === 422) {
            // Validation error
            const errorMessage = error.response.data.error; // This should be 'Insufficient product quantity: Thaddeus Kidd'
            toast.error(errorMessage);
            // Handle the error or display the error message in your desired way
        }
    });
}


// Listen for Ctrl+Enter key press
window.addEventListener('keydown', (event) => {
    if (event.key === 'Tab') {
        event.preventDefault();
        const submitButton = document.getElementById('submit-button');
        if (submitButton) {
            submit();
        }
    }
});




</script>

<style scoped>
    #invoice-POS{
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    padding:2mm;
    margin: 0 auto;
    width: 44mm;
    background: #FFF;
    }
    
    ::selection {background: #f31544; color: #FFF;}
    ::moz-selection {background: #f31544; color: #FFF;}
    h1{
    font-size: 1.5em;
    color: #222;
    }
    h2{
        font-size: .7em;
        padding: 0px 0px 10px
    }
    h3{
    font-size: 1.2em;
    font-weight: 300;
    line-height: 2em;
    }
    p{
    font-size: 0.5em;
    color: #666;
    line-height: 1.8em;
    }
    
    #top, #mid,#bot{ /* Targets all id with 'col-' */
    border-bottom: 1px solid #EEE;
    }
    
    #top{min-height: 30px;}
    #mid{
        min-height: 60px;
        padding: 15px 0px;
    }
    #bot{ min-height: 50px;}
    
    .clientlogo{
    float: left;
    height: 60px;
    width: 60px;
    background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
    background-size: 60px 60px;
    border-radius: 50px;
    }
    .info{
    display: block;
    margin-left: 0;
    }
    .title{
    float: right;
    }
    .title p{text-align: right;}
    table{
    width: 100%;
    border-collapse: collapse;
    }
    .tabletitle{
    font-size: .5em;
    background: #EEE;
    }
    .service{border-bottom: 1px solid #EEE;}
    .item{width: 24mm;}
    .itemtext{font-size: .5em;}
    
    #legalcopy{
    margin-top: 5mm;
    }
</style>