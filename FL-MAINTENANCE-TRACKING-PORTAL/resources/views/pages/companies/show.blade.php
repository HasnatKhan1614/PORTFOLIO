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
    <!-- Company Details -->
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Company Details</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> {{ $company->name }}</li>
                <li class="list-group-item"><strong>Tax Number:</strong> {{ $company->tax_number }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $company->email }}</li>
                <li class="list-group-item"><strong>Address:</strong> {{ $company->address }}</li>
            </ul>
        </div>
    </div>

    <!-- Buildings List -->
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>Buildings</h5>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($buildings as $building)
                    <li class="list-group-item">
                        <strong>{{ $building->name }}</strong> - {{ $building->address }}
                    </li>
                @empty
                    <li class="list-group-item">No buildings available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Maintenance Requests List -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Maintenance Requests</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Building</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th>Accounting Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenanceRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->building->name ?? 'N/A' }}</td>
                                <td><span class="badge bg-primary">{{ ucfirst($request->urgency ?? 'N/A') }}</span></td>
                                <td><span class="badge bg-info">{{ ucfirst($request->status) }}</span></td>
                                <td><span class="badge bg-warning">{{ ucfirst($request->accounting_status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No maintenance requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
@if($mapData->isNotEmpty())
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Building Locations on Map</h5>
            </div>
            <div class="card-body">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function initMap() {
        let map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 24.8504, lng: 67.0613 }, // Default center
            zoom: 12
        });

        let bounds = new google.maps.LatLngBounds();
        let hasValidLocations = false;

        // Convert received object into an array
        let locations = Object.values(@json($mapData ?? []));
        console.log("Locations:", locations);

        if (Array.isArray(locations) && locations.length > 0) {
            locations.forEach((location) => {
                if (location.latitude && location.longitude) {
                    let marker = new google.maps.Marker({
                        position: { 
                            lat: parseFloat(location.latitude), 
                            lng: parseFloat(location.longitude) 
                        },
                        map: map,
                        title: location.building
                    });

                    bounds.extend(marker.position);
                    hasValidLocations = true;
                }
            });

            if (hasValidLocations) {
                map.fitBounds(bounds);
            } else {
                alert("No valid maintenance locations available.");
            }
        } else {
            console.warn("No maintenance locations found.");
        }
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap"></script>
@endif

        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')

@endsection
