@extends('layouts.app')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h3 class="page-title">Create Building</h3>
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
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Form</h4>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="editBuildingForm" class="form-Form-element">
                            <input type="hidden" id="building_id" value="{{ $building->id }}">

                            <div class="box-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Company</label>
                                @role('superadmin')

                                    <div class="col-sm-10">
                                        <select name="company_id" class="form-control" id="company_id">
                                            @foreach (\App\Models\Company::get() as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $building->company_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                                                @endrole

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Building Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name"
                                            value="{{ $building->name }}" placeholder="Building Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Tax Number</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tax_number"
                                            value="{{ $building->tax_number }}" placeholder="Tax Number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-label">Address</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address"
                                            value="{{ $building->address }}" placeholder="Address" required>
                                    </div>
                                </div>
                                <!-- Google Map Container -->

                                <div class="form-group row">
                                    <label for="locationSearch" class="col-sm-2 form-label">Search Location</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="locationSearch" class="form-control"
                                            placeholder="Enter a location">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="latitude" class="col-sm-2 form-label">Latitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="latitude" value="{{ $building->latitude ?? '' }}"
                                            class="form-control" name="latitude" placeholder="Enter latitude">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="longitude" class="col-sm-2 form-label">Longitude</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="longitude" value="{{ $building->longitude ?? '' }}"
                                            class="form-control" name="longitude" placeholder="Enter longitude">
                                    </div>
                                </div>



                                <div id="map" style="height: 400px; width: 100%;"></div>



                            </div>
                            <div class="box-footer">
                                <a href="/buildings" class="btn btn-danger me-1">Cancel</a>

                                <button type="submit" class="btn btn-warning ">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>



        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <script>
    $(document).ready(function () {
        $("#editBuildingForm").submit(function (e) {
            e.preventDefault();

            let id = $("#building_id").val();

            $.ajax({
                url: `/buildings/update/${id}`,
                type: 'POST',
                data: {
                    company_id: $("#company_id").val(),
                    name: $("#name").val(),
                    tax_number: $("#tax_number").val(),
                    address: $("#address").val(),
                    longitude: $("#longitude").val(),
                    latitude: $("#latitude").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });

                    setTimeout(() => {
                        window.location.href = "/buildings";
                    }, 1500);
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';

                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + '<br>';
                    });

                    $.toast({
                        heading: 'Error',
                        text: errorMsg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
            });
        });
    });
</script>

    <script>
        let map;
        let marker;
        let autocomplete;

        function initMap() {
            // Get latitude and longitude from input fields
            let lat = parseFloat($("#latitude").val());
            let lng = parseFloat($("#longitude").val());

            // Validate the coordinates; fallback to default if not valid
            let isValidLatLng = !isNaN(lat) && !isNaN(lng);
            let defaultLocation = isValidLatLng ? {
                lat,
                lng
            } : {
                lat: 25.276987,
                lng: 55.296249
            }; // Dubai default

            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 12,
            });

            // Initialize marker
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            // Initialize autocomplete
            autocomplete = new google.maps.places.Autocomplete(document.getElementById("locationSearch"));

            autocomplete.addListener("place_changed", function() {
                let place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                let newLat = place.geometry.location.lat();
                let newLng = place.geometry.location.lng();

                $("#latitude").val(newLat);
                $("#longitude").val(newLng);

                marker.setPosition({
                    lat: newLat,
                    lng: newLng
                });
                map.setCenter({
                    lat: newLat,
                    lng: newLng
                });
            });

            // Update inputs when marker is dragged
            google.maps.event.addListener(marker, "dragend", function() {
                let pos = marker.getPosition();
                $("#latitude").val(pos.lat());
                $("#longitude").val(pos.lng());
            });

            console.log("Lat:", $("#latitude").val());
            console.log("Lng:", $("#longitude").val());
        }
    </script>

    <!-- Load Google Maps API -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places&callback=initMap"
        async defer></script>

@endsection
