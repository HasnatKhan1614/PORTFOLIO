@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

      <!-- Basic Bootstrap Table -->
      <div class="card">
        <h5 class="card-header">Order Details</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>sku</td>
                    <td>name</td>
                    <td>price</td>
                    <td>quantity</td>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order->sku }}</td>
                    <td>{{ $order->name }}</td>
                    <td>${{ round($order->price,0) }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>                
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Basic Bootstrap Table -->

    <div class="content-backdrop fade"></div>
  </div>
@endsection

@section('script')

@endsection

