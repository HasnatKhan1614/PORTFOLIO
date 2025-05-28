<template>
	<!--  WRAPPER  -->

	<div class="wrapper">

		<!-- LEFT MAIN SIDEBAR -->
		<div class="ec-left-sidebar ec-bg-sidebar">
			<div id="sidebar" class="sidebar ec-sidebar-footer">

				<div class="ec-brand">
					<a href="/" title="Ekka">
						<img class="ec-brand-icon" src="/assets/img/logo/logo.png" alt="" />
						<!-- <span class="ec-brand-name text-truncate">In Reach</span> -->
					</a>
				</div>

				<!-- begin sidebar scrollbar -->
				<div class="ec-navigation" data-simplebar>
					<!-- sidebar menu -->
					<ul class="nav sidebar-inner" id="sidebar-menu">
						<!-- Dashboard -->
						<li :class="$page.component.split('/')[0] === 'Home' ? 'active' : ''">
							<Link class="sidenav-item-link" href="/">
							<i class="mdi mdi-view-dashboard-outline"></i><span class="nav-text">Dashboard</span>
							</Link>
							<hr>
						</li>

						<!-- <li>
								<Link class="sidenav-item-link" :href="`/user`">
<i class="mdi mdi-account-multiple"></i><span class="nav-text">User</span>
								</Link>
							</li> -->

						<li>
							<Link class="sidenav-item-link" :href="`/make`">
							<i class="mdi mdi-label-outline"></i><span class="nav-text">Brands</span>
							</Link>
						</li>

						<li>
							<Link class="sidenav-item-link" :href="`/car-model`">
							<i class="mdi mdi-car"></i><span class="nav-text">Car Models</span>
							</Link>
						</li>

						<li>
							<Link class="sidenav-item-link" :href="`/product`">
							<i class="mdi mdi-cube-outline"></i><span class="nav-text">Products</span>
							</Link>
						</li>

						<li>
							<Link class="sidenav-item-link" :href="`/vendorr`">
							<i class="mdi mdi-store"></i><span class="nav-text">Vendors</span>
							</Link>
						</li>

						<li>
							<Link class="sidenav-item-link" :href="`/purchase`">
							<i class="mdi mdi-cart-arrow-down"></i><span class="nav-text">Purchase</span>
							</Link>
						</li>

						<!-- Vendors -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-cart-arrow-up"></i><span class="nav-text">Sales</span><b
									class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="inventory" data-parent="#sidebar-menu">
									<li class="">
										<Link class="sidenav-item-link" :href="`/sale`">
										<span class="nav-text">Sale</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/pos`">
										<span class="nav-text">POS</span>
										</Link>
									</li>
								</ul>
							</div>
						</li>



						<!-- <li>
								<Link class="sidenav-item-link" :href="`/inventory`">
									<i class="mdi mdi-account-group-outline"></i>
									<span class="nav-text">Inventory</span>
								</Link>
							</li> -->



						<!-- Vendors -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-chart-line"></i><span class="nav-text">Reports</span><b
									class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="inventory" data-parent="#sidebar-menu">
									<li class="">
										<Link class="sidenav-item-link" :href="`/inventory-report`">
										<span class="nav-text">Inventories</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/vendor-ledger`">
										<span class="nav-text">Vendor Ledger</span>
										</Link>
									</li>

									<li class="">
										<Link class="sidenav-item-link" :href="`/purchase-report`">
										<span class="nav-text">Purchase</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/expense-payable-head-report`">
										<span class="nav-text">Expense Payable</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/staff-payroll-report`">
										<span class="nav-text">Staff Payroll</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/sale-report`">
										<span class="nav-text">Sale</span>
										</Link>
									</li>
								</ul>
							</div>
						</li>

						<!-- Accounts -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-bank"></i><span class="nav-text">Accounts</span><b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="vendor-payable" data-parent="#sidebar-menu">
									<li class="">
										<Link class="sidenav-item-link" :href="`/vendor-payable`">
										<span class="nav-text">Vendor Payables</span>
										</Link>
									</li>
								</ul>
							</div>
						</li>

						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-cash-multiple"></i><span class="nav-text">Expenses</span><b
									class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="expense-payable-head" data-parent="#sidebar-menu">
									<li class="">
										<Link class="sidenav-item-link" :href="`/expense-payable-head`">
										<span class="nav-text">Create Head</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/expense-payable`">
										<span class="nav-text">Create Payables</span>
										</Link>
									</li>
								</ul>
							</div>
						</li>

						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-account-tie"></i><span class="nav-text">Staff</span><b
									class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="staff" data-parent="#sidebar-menu">
									<li class="">
										<Link class="sidenav-item-link" :href="`/staff`">
										<span class="nav-text">Create Staff</span>
										</Link>
									</li>
									<li class="">
										<Link class="sidenav-item-link" :href="`/staff-payroll`">
										<span class="nav-text">Payrolls</span>
										</Link>
									</li>
								</ul>
							</div>
						</li>

					</ul>
				</div>
			</div>
		</div>

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<header class="ec-main-header" id="header">
				<nav class="navbar navbar-static-top navbar-expand-lg">
					<!-- Sidebar toggle button -->
					<button id="sidebar-toggler" class="sidebar-toggle"></button>
					<!-- search form -->
					<div class="search-form d-lg-inline-block">
						<!-- <div class="input-group">
								<input type="text" name="query" id="search-input" class="form-control"
									placeholder="search.." autofocus autocomplete="off" />
								<button type="button" name="search" id="search-btn" class="btn btn-flat">
									<i class="mdi mdi-magnify"></i>
								</button>
							</div> -->
						<div id="search-results-container">
							<ul id="search-results"></ul>
						</div>
					</div>

					<!-- navbar right -->
					<div style="margin-right: 66rem;">
						<ul class="nav navbar-nav">
							<!-- User Account -->
							<li class="nav-item">
								<a class="nav-link text-white" :href="`/`">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-white" :href="`/pos`">POS</a>
							</li>
						</ul>
					</div>
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							<!-- User Account -->
							<li class="dropdown user-menu">
								<button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown"
									aria-expanded="false">
									<img src="/assets/img/user/user.png" class="user-image" alt="User Image" />
								</button>
								<ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
									<!-- User image -->
									<!-- <li class="dropdown-header">
											<img src="assets/img/user/user.png" class="img-circle" alt="User Image" />
											<div class="d-inline-block">
												<small class="pt-1">john.example@gmail.com</small>
											</div>
										</li> -->
									<li class="right-sidebar-in">
										<a href="javascript:0"> <i class="mdi mdi-settings-outline"></i> Setting </a>
									</li>
									<li class="dropdown-footer">
										<a href="/logout"> <i class="mdi mdi-logout"></i> Log Out </a>
									</li>
								</ul>
							</li>

							<li class="right-sidebar-in right-sidebar-2-menu">
								<i class="mdi mdi-settings-outline mdi-spin"></i>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<!-- CONTENT WRAPPER -->
			<div class="container">
				<div class="ec-content-wrapper">
					<div class="content">
						<slot />

					</div> <!-- End Content -->
				</div> <!-- End Content Wrapper -->
			</div>
			<!-- Footer -->
			<footer class="footer mt-auto">
				<div class="copyright bg-white">
					<p>
						Copyright &copy; <span>2023</span><a class="text-primary" href="/" target="_blank"> HYDE ROAD
							MOTOR & SPARE </a>. All Rights Reserved.
					</p>
				</div>
			</footer>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->



</template>
