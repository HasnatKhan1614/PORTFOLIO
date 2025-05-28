<template>
	<!-- <div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
        <h1>Main Product</h1>
        <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Main Product</p>
    </div> -->
	<!-- Top Statistics -->
	<div class="row">
		<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
			<div class="card card-mini dash-card card-1">
				<div class="card-body">
					<h2 class="mb-1">{{ sale }}</h2>
					<p>Total Sales</p>
					<span class="mdi mdi-account-arrow-left"></span>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
			<div class="card card-mini dash-card card-2">
				<div class="card-body">
					<h2 class="mb-1">{{ purchase }}</h2>
					<p>Total Purchase</p>
					<span class="mdi mdi-account-clock"></span>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
			<div class="card card-mini dash-card card-3">
				<div class="card-body">
					<h2 class="mb-1">{{ expense }}</h2>
					<p>Total Expense</p>
					<span class="mdi mdi-package-variant"></span>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
			<div class="card card-mini dash-card card-4">
				<div class="card-body">
					<h2 class="mb-1">${{ total }}</h2>
					<p>Total Profit</p>
					<span class="mdi mdi-currency-usd"></span>
				</div>
			</div>
		</div>
	</div>

	<!-- Datatable -->
	<div class="row">
		<div class="col-12">
			<div class="ec-vendor-list card card-default">
				<div class="card-body">
					<div class="table-responsive">
						<table id="responsive-data-table" class="table">
							<thead>
								<tr>
									<th>Profile</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Total Buy</th>
									<th>Status</th>
									<th>Join On</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u1.jpg" alt="user profile" />
									</td>
									<td>Marlee Rena</td>
									<td>marleerena@gmail.com</td>
									<td>+1-256-325-8652</td>
									<td>2161</td>
									<td>ACTIVE</td>
									<td>2021-10-30</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u2.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u3.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u4.jpg" alt="user profile" />
									</td>
									<td>Mohini Marlo</td>
									<td>mohinimarlo@gmail.com</td>
									<td>+91-154-325-8652</td>
									<td>1561</td>
									<td>ACTIVE</td>
									<td>2021-10-21</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u5.jpg" alt="user profile" />
									</td>
									<td>Nitilo Kathilo</td>
									<td>nitilokathilo@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>1061</td>
									<td>ACTIVE</td>
									<td>2021-10-18</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u6.jpg" alt="user profile" />
									</td>
									<td>Hardi Sandhu</td>
									<td>hardisandhu@gmail.com</td>
									<td>+1-789-325-6589</td>
									<td>10061</td>
									<td>ACTIVE</td>
									<td>2021-10-14</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u7.jpg" alt="user profile" />
									</td>
									<td>Bhavlo Malvia</td>
									<td>bhavlomalvia@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>3061</td>
									<td>ACTIVE</td>
									<td>2021-10-05</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u8.jpg" alt="user profile" />
									</td>
									<td>Jeni Dusuja</td>
									<td>jenidusuja@gmail.com</td>
									<td>+1-967-325-1122</td>
									<td>6061</td>
									<td>ACTIVE</td>
									<td>2021-10-01</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u1.jpg" alt="user profile" />
									</td>
									<td>Marlee Rena</td>
									<td>marleerena@gmail.com</td>
									<td>+1-256-325-8652</td>
									<td>2161</td>
									<td>ACTIVE</td>
									<td>2021-10-30</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u2.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u3.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u4.jpg" alt="user profile" />
									</td>
									<td>Mohini Marlo</td>
									<td>mohinimarlo@gmail.com</td>
									<td>+91-154-325-8652</td>
									<td>1561</td>
									<td>ACTIVE</td>
									<td>2021-10-21</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u5.jpg" alt="user profile" />
									</td>
									<td>Nitilo Kathilo</td>
									<td>nitilokathilo@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>1061</td>
									<td>ACTIVE</td>
									<td>2021-10-18</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u6.jpg" alt="user profile" />
									</td>
									<td>Hardi Sandhu</td>
									<td>hardisandhu@gmail.com</td>
									<td>+1-789-325-6589</td>
									<td>10061</td>
									<td>ACTIVE</td>
									<td>2021-10-14</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u7.jpg" alt="user profile" />
									</td>
									<td>Bhavlo Malvia</td>
									<td>bhavlomalvia@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>3061</td>
									<td>ACTIVE</td>
									<td>2021-10-05</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u8.jpg" alt="user profile" />
									</td>
									<td>Jeni Dusuja</td>
									<td>jenidusuja@gmail.com</td>
									<td>+1-967-325-1122</td>
									<td>6061</td>
									<td>ACTIVE</td>
									<td>2021-10-01</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u1.jpg" alt="user profile" />
									</td>
									<td>Marlee Rena</td>
									<td>marleerena@gmail.com</td>
									<td>+1-256-325-8652</td>
									<td>2161</td>
									<td>ACTIVE</td>
									<td>2021-10-30</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u2.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u3.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u4.jpg" alt="user profile" />
									</td>
									<td>Mohini Marlo</td>
									<td>mohinimarlo@gmail.com</td>
									<td>+91-154-325-8652</td>
									<td>1561</td>
									<td>ACTIVE</td>
									<td>2021-10-21</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u5.jpg" alt="user profile" />
									</td>
									<td>Nitilo Kathilo</td>
									<td>nitilokathilo@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>1061</td>
									<td>ACTIVE</td>
									<td>2021-10-18</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u6.jpg" alt="user profile" />
									</td>
									<td>Hardi Sandhu</td>
									<td>hardisandhu@gmail.com</td>
									<td>+1-789-325-6589</td>
									<td>10061</td>
									<td>ACTIVE</td>
									<td>2021-10-14</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u7.jpg" alt="user profile" />
									</td>
									<td>Bhavlo Malvia</td>
									<td>bhavlomalvia@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>3061</td>
									<td>ACTIVE</td>
									<td>2021-10-05</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u8.jpg" alt="user profile" />
									</td>
									<td>Jeni Dusuja</td>
									<td>jenidusuja@gmail.com</td>
									<td>+1-967-325-1122</td>
									<td>6061</td>
									<td>ACTIVE</td>
									<td>2021-10-01</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u1.jpg" alt="user profile" />
									</td>
									<td>Marlee Rena</td>
									<td>marleerena@gmail.com</td>
									<td>+1-256-325-8652</td>
									<td>2161</td>
									<td>ACTIVE</td>
									<td>2021-10-30</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u2.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u3.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u4.jpg" alt="user profile" />
									</td>
									<td>Mohini Marlo</td>
									<td>mohinimarlo@gmail.com</td>
									<td>+91-154-325-8652</td>
									<td>1561</td>
									<td>ACTIVE</td>
									<td>2021-10-21</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u5.jpg" alt="user profile" />
									</td>
									<td>Nitilo Kathilo</td>
									<td>nitilokathilo@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>1061</td>
									<td>ACTIVE</td>
									<td>2021-10-18</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u6.jpg" alt="user profile" />
									</td>
									<td>Hardi Sandhu</td>
									<td>hardisandhu@gmail.com</td>
									<td>+1-789-325-6589</td>
									<td>10061</td>
									<td>ACTIVE</td>
									<td>2021-10-14</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u7.jpg" alt="user profile" />
									</td>
									<td>Bhavlo Malvia</td>
									<td>bhavlomalvia@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>3061</td>
									<td>ACTIVE</td>
									<td>2021-10-05</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u8.jpg" alt="user profile" />
									</td>
									<td>Jeni Dusuja</td>
									<td>jenidusuja@gmail.com</td>
									<td>+1-967-325-1122</td>
									<td>6061</td>
									<td>ACTIVE</td>
									<td>2021-10-01</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u1.jpg" alt="user profile" />
									</td>
									<td>Marlee Rena</td>
									<td>marleerena@gmail.com</td>
									<td>+1-256-325-8652</td>
									<td>2161</td>
									<td>ACTIVE</td>
									<td>2021-10-30</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u2.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u3.jpg" alt="user profile" />
									</td>
									<td>Johnee Bolbi</td>
									<td>johneebolbi@gmail.com</td>
									<td>+5-256-325-8652</td>
									<td>5161</td>
									<td>ACTIVE</td>
									<td>2021-10-25</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u4.jpg" alt="user profile" />
									</td>
									<td>Mohini Marlo</td>
									<td>mohinimarlo@gmail.com</td>
									<td>+91-154-325-8652</td>
									<td>1561</td>
									<td>ACTIVE</td>
									<td>2021-10-21</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
									</td>

								</tr>
								<tr>
									<td><img class="vendor-thumb" src="/assets/img/vendor/u5.jpg" alt="user profile" />
									</td>
									<td>Nitilo Kathilo</td>
									<td>nitilokathilo@gmail.com</td>
									<td>+91-989-325-8652</td>
									<td>1061</td>
									<td>ACTIVE</td>
									<td>2021-10-18</td>
									<td>
										<a class="edit-icon" href="#"><i class="mdi mdi-circle-edit-outline"></i></a>
										<a class="delete-icon" href="#"><i class="mdi mdi-delete-circle"></i></a>
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
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

const props = defineProps({
	sale: Object,
	purchase: Object,
	expense: Object,
	total: Object,
});
</script>