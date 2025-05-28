@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Create Maintenance Request</h3>
                    {{-- <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Tables</li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                                </ol>
                            </nav>
                        </div> --}}
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Maintenance Request Details</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Building:</strong> {{ $maintenanceRequest->building->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Company:</strong> {{ $maintenanceRequest->company->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Urgency:</strong> <span class="badge bg-primary">{{ ucfirst($maintenanceRequest->urgency ?? 'N/A') }}</span></li>
                <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($maintenanceRequest->status) }}</span></li>
                <li class="list-group-item"><strong>Accounting Status:</strong> <span class="badge bg-warning">{{ ucfirst($maintenanceRequest->accounting_status) }}</span></li>
                <li class="list-group-item"><strong>Description:</strong> {{ $maintenanceRequest->description }}</li>
                <li class="list-group-item"><strong>Latitude:</strong> {{ $maintenanceRequest->building->latitude ?? 'Not Set' }}</li>
                <li class="list-group-item"><strong>Longitude:</strong> {{ $maintenanceRequest->building->longitude ?? 'Not Set' }}</li>
            </ul>
        </div>
    </div>

    <!-- Map Display -->
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>Location on Map</h5>
            </div>
            <div class="card-body">
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>




        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
<!-- Google Maps Script -->
<script>
    function initMap() {
        let latitude = {{ $maintenanceRequest->building->latitude ?? 0 }};
        let longitude = {{ $maintenanceRequest->building->longitude ?? 0 }};

        if(latitude === 0 && longitude === 0) {
            alert("No valid location found!");
            return;
        }

        let map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: latitude, lng: longitude },
            zoom: 15
        });

        let marker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: map,
            title: "Maintenance Location"
        });
    }
</script>

<!-- Google Maps API (Replace YOUR_API_KEY) -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5lcKtfYmf8QsaiJv6yB8By5bHtuS23QQ&callback=initMap">
</script>
@endsection
