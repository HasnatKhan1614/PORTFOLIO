@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

      <!-- Basic Bootstrap Table -->
      <div class="card">
        <h5 class="card-header">Orders</h5>
        <div class="table-responsive text-nowrap">
          <table id="table" class="datatables-basic table border-top">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Order Number</td>
                    <td>Order Items</td>
                    <td>first_name/last_name</td>
                    <td>company_name</td>
                    <td>country</td>
                    <td>street_address</td>
                    <td>apartment</td>
                    <td>city</td>
                    <td>state</td>
                    <td>zip_code</td>
                    <td>phone</td>
                    <td>email</td>
                    <td>subtotal</td>
                    <td>date/time</td>
                    <td>payment status</td>
                    <td>current_status</td>
                    <td>status</td>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($orders as $key => $order)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ url('/admin/order-detail',$order->id) }}">{{ $order->orderId }}</a></td>
                    <td>{{ count($order->orderDetails()) }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->company_name }}</td>
                    <td>{{ $order->country }}</td>
                    <td>{{ $order->street_address }}</td>
                    <td>{{ $order->apartment }}</td>
                    <td>{{ $order->city }}</td>
                    <td>{{ $order->state }}</td>
                    <td>{{ $order->zip_code }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>${{ round($order->subtotal,0) }}</td>
                    <td>{{ $order->created_at->format('d-M-Y h:i A') }}</td>
                    <td><span class="{{ $order->payment_status == 'paid' ? 'badge bg-success' : 'badge bg-danger' }}">{{ $order->payment_status }}</span></td>
                    <td>
                        @php
                            $badgeClass = '';
                            switch($order->status) {
                                case 'pending':
                                    $badgeClass = 'bg-primary';
                                    break;
                                case 'processing':
                                    $badgeClass = 'bg-info';
                                    break;
                                case 'shipped':
                                    $badgeClass = 'bg-success';
                                    break;
                                case 'delivered':
                                    $badgeClass = 'bg-success';
                                    break;
                                case 'canceled':
                                    $badgeClass = 'bg-danger';
                                    break;
                                case 'refunded':
                                    $badgeClass = 'bg-warning';
                                    break;
                                default:
                                    $badgeClass = 'bg-secondary';
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $order->status }}</span>
                    </td>   
                    <td>
                        <div class="input-group">
                            <select class="form-select" name="status" onchange="updateOrderStatus(this, {{ $order->id }})">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                    </td>                    
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
<script>
    function updateOrderStatus(selectElement, orderId) {
        var newStatus = selectElement.value;

        // Send AJAX request
        $.ajax({
            url: '{{ route("order-status.update", ["orderId" => ":orderId"]) }}'.replace(':orderId', orderId),
            type: 'PUT',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Handle successful logout response
                toastr.success(response.message);
                
                // Reload the page after a delay
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
</script>


@endsection

