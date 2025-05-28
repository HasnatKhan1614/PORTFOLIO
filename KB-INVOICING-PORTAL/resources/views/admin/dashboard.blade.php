@extends('admin.layouts.app')

@section('content')
    <div class="row">
        {{-- <div class="col-lg-12 col-xl-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body position-relative">
            <div>
                <h5 class="mb-1 fw-bold">Welcome Jonathan Deo</h5>
                <p class="fs-3 mb-3 pb-1">Check all the statastics</p>
                <button class="btn btn-primary rounded-pill" type="button">
                Visit Now
                </button>
            </div>
            <div class="school-img d-none d-sm-block">
                <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="">
            </div>

            <div class="d-sm-none d-block text-center">
                <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="">
            </div>
            </div>
        </div>
        </div> --}}


                {{-- <div class="col-sm-3 d-flex align-items-strech">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                            <div class="mb-7">
                                <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                            </div>
                            <h5 class="text-white fw-bold fs-14 text-nowrap">
                                {{ \App\Models\User::get()->count() }}
                            </h5>
                            <p class="opacity-50 mb-0 ">Users</p>
                        </div>
                    </div>
                </div>
 

                <div class="col-sm-3 d-flex align-items-strech">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                            <div class="mb-7">
                                <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                            </div>
                            <h5 class="text-white fw-bold fs-14 text-nowrap">
                                {{ \App\Models\Server::get()->count() }}
                            </h5>
                            <p class="opacity-50 mb-0 ">Servers</p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3 d-flex align-items-strech">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                            <div class="mb-7">
                                <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                            </div>
                            <h5 class="text-white fw-bold fs-14 text-nowrap">
                                {{ \App\Models\Product::get()->count() }}
                            </h5>
                            <p class="opacity-50 mb-0 ">Products</p>
                        </div>
                    </div>
                </div>
 


                <div class="col-sm-3 d-flex align-items-strech">
                    <div class="card warning-card overflow-hidden text-bg-primary w-100">
                        <div class="card-body p-4">
                            <div class="mb-7">
                                <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
                            </div>
                            <h5 class="text-white fw-bold fs-14 text-nowrap">
                                {{ \App\Models\Order::get()->count() }}
                            </h5>
                            <p class="opacity-50 mb-0 ">Orders</p>
                        </div>
                    </div>
                </div> --}}

    </div>

    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body border-bottom position-relative">
                    <h5 class="card-title fs-6 mb-1">Dashboard</h5>
                    <p class="mb-0">You have done 38% more sales</p>
                    <div class="mt-6">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-9">
                                <div
                                    class="bg-success-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:cart-5-line-duotone" class="fs-7 text-success"></iconify-icon>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4">{{ \App\Models\Order::get()->count() }}</h6>
                                    <p class="mb-0">Orders</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-9">
                                <div
                                    class="bg-warning-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:pause-line-duotone" class="fs-6 text-warning"></iconify-icon>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4">{{ \App\Models\User::get()->count() }}</h6>
                                    <p class="mb-0">Users</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-9">
                                <div
                                    class="bg-indigo-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:bicycling-round-bold-duotone"
                                        class="fs-7 text-indigo"></iconify-icon>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4">{{ \App\Models\Server::get()->count() }}</h6>
                                    <p class="mb-0">Servers</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div
                                    class="bg-indigo-subtle p-6 me-3 rounded-circle d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:bicycling-round-bold-duotone"
                                        class="fs-7 text-indigo"></iconify-icon>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4">{{ \App\Models\Product::get()->count() }}</h6>
                                    <p class="mb-0">Products</p>
                                </div>
                            </li>
                        </ul>
                        <div class="man-working-on-laptop">
                            <img src="{{ env('ASSET_URL') }}/dashboard/assets/images/backgrounds/man-working-on-laptop.png"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                {{-- <div class="card-body pb-2">
                    <div class="d-flex align-items-baseline justify-content-between">
                        <div>
                            <h5 class="card-title fs-6 mb-1">{{ \App\Models\Product::get()->count() }}</h5>
                            <p class="mb-0">Products</p>
                        </div>
                        <select class="form-select fw-bold w-auto shadow-none">
                            <option value="1">This Week</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>
                    <div id="netsells"></div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title mb-1">Payments</h5>
                                    <p class="mb-0">Last 7 days</p>
                                </div>
                                <div>
                                    <h5 class="card-title mb-1 text-end">{{$totalPayments}}</h5>
                                    <span class="badge rounded-pill bg-warning-subtle text-warning border-warning border text-end">-3.8%</span>
                                </div>
                            </div>
                            {{-- <div id="total-orders" class="total-orders-chart my-1"></div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-circle text-primary fs-4 me-2"></i>
                                    <p class="mb-0">Paypal</p>
                                </div>
                                <p class="mb-0">52%</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-circle text-light fs-4 me-2"></i>
                                    <p class="mb-0">Credit Card</p>
                                </div>
                                <p class="mb-0">48%</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title mb-1">Products</h5>
                                    <p class="mb-0">Last 7 days</p>
                                </div>
                                <div>
                                    <h5 class="card-title mb-1 text-end">432</h5>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success border-success border text-end">+26.5%</span>
                                </div>
                            </div>
                            <div id="products" class="my-8"></div>
                            <p class="mb-0 text-center">$18k Profit more than last month</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title mb-1">Latest Deal</h5>
                                    <p class="mb-0">Last 7 days</p>
                                </div>
                                <div>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success border-success border text-end">86.5%</span>
                                </div>
                            </div>
                            <div class="my-6 py-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">$98,500</h5>
                                    <h6 class="mb-0">$1,22,900</h6>
                                </div>
                                <div class="progress bg-light-subtle w-100 my-2">
                                    <div class="progress-bar text-bg-primary" role="progressbar"
                                        aria-label="Example 8px high" style="width: 80%;" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <p class="mb-0">Coupons used: 18/22</p>
                            </div>
                            <h6 class="mb-7">Recent Purchasers</h6>
                            <ul class="hstack mb-0">
                                <li class="ms-n2">
                                    <a href="javascript:void(0)" class="">
                                        <img src="{{ env('ASSET_URL') }}/dashboard/assets/images/profile/user-2.jpg"
                                            class="rounded-circle border border-2 border-white" width="40"
                                            height="40" alt="">
                                    </a>
                                </li>
                                <li class="ms-n2">
                                    <a href="javascript:void(0)" class="">
                                        <img src="{{ env('ASSET_URL') }}/dashboard/assets/images/profile/user-3.jpg"
                                            class="rounded-circle border border-2 border-white" width="40"
                                            height="40" alt="">
                                    </a>
                                </li>
                                <li class="ms-n2">
                                    <a href="javascript:void(0)" class="">
                                        <img src="{{ env('ASSET_URL') }}/dashboard/assets/images/profile/user-4.jpg"
                                            class="rounded-circle border border-2 border-white" width="40"
                                            height="40" alt="">
                                    </a>
                                </li>
                                <li class="ms-n2">
                                    <a href="javascript:void(0)" class="">
                                        <img src="{{ env('ASSET_URL') }}/dashboard/assets/images/profile/user-5.jpg"
                                            class="rounded-circle border border-2 border-white" width="40"
                                            height="40" alt="">
                                    </a>
                                </li>
                                <li class="ms-n2">
                                    <a href="javascript:void(0)"
                                        class="bg-primary-subtle rounded-circle border border-2 border-white d-flex align-items-center justify-content-center round-40">
                                        +8
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title mb-1">Customers</h5>
                                    <p class="mb-0">Last 7 days</p>
                                </div>
                                <div>
                                    <h5 class="card-title mb-1 text-end">{{$newUsersCount}}</h5>
                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success border-success border text-end">+26.5%</span>
                                </div>
                            </div>
                            {{-- <div id="customers" class="my-5"></div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0">April 07 - April 14</p>
                                <p class="mb-0">6,380</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Last Week</p>
                                <p class="mb-0">4,298</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
