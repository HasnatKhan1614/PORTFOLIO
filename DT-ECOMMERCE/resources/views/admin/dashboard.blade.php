@extends('admin.layouts.app')
@section('content')


<h1>Admin Dashboard</h1>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
          <div class="row">
            @foreach ($counts as $count)
                @php
                    $bgColor = '';
                    switch ($count->status) {
                        case 'pending':
                            $bgColor = 'bg-primary';
                            break;
                        case 'processing':
                            $bgColor = 'bg-info';
                            break;
                        case 'shipped':
                            $bgColor = 'bg-success';
                            break;
                        case 'delivered':
                            $bgColor = 'bg-success';
                            break;
                        case 'canceled':
                            $bgColor = 'bg-danger';
                            break;
                        case 'refunded':
                            $bgColor = 'bg-warning';
                            break;
                        default:
                            $bgColor = 'bg-secondary';
                    }
                @endphp
                <div class="col-lg-2 col-md-6 col-2 mb-4">
                    <div class="card">
                        <div class="card-body {{$bgColor}}">
                            <h4 class="text-white">{{ ucfirst($count->status) }}</h4>
                            <h3 class="card-title mb-2 text-white">{{ $count->count }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        
        
          </div>
        </div>
      </div>
    </div>
</div>



@endsection

@section('script')

@endsection

