@extends('backend.layouts.master')
@section('title')
Factory
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


@endsection

@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <!-- basic form start -->
        <div class="container">
            <h4 class="header-title">
                {{ __('Factories in out real') }} 
                <span style="margin-left:20px;">
                    <select id="factorySelector" onchange="handleFactoryChange(this)" style="font-size: 18px; weight:4px">
                        <option value="all">All Factories</option>
                        @foreach($factories as $factory)
                            <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                        @endforeach
                    </select>
                </span>
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                </div>
            </div>
             <!-- Factory information section -->
            <div id="factory-info" class="mt-4">
                <h5>Vehicle Information</h5>
                <p id="factory-details">Click on a marker to view Vehicle Details.</p>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBk62BtiALfyv92AFuktl8II23CsAzxTj8&libraries=places&v=3.45.8&callback=initMap" async defer></script>

<script>
  let map;
let markers = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 26.8993656, lng: 80.9281426 }, // Default center
        zoom: 8
    });

    // Initial rendering of all markers
    renderMarkers('all');
}

function renderMarkers(factoryId) {
    // Remove existing markers from the map
    markers.forEach(marker => marker.setMap(null));
    markers = [];

    // Fetching factory data from Blade template
    const factoryInOutData = @json($factory_in_out_data);

    const uniqueLocations = new Set(); // To track duplicate coordinates

    let bounds = new google.maps.LatLngBounds(); // To adjust the map bounds
    let totalLat = 0;
    let totalLng = 0;
    let markerCount = 0; // To calculate the middle point

    factoryInOutData.forEach(function (log) {
        if (factoryId === 'all' || log.factory_id == factoryId) {
            let latitude = parseFloat(log.latitude);
            let longitude = parseFloat(log.longitude);
            let inTime = log.in_time; 
            console.log(inTime);

            // Ensure latitude and longitude are valid
            if (!isNaN(latitude) && !isNaN(longitude)) {
                const locationKey = latitude + ',' + longitude;

                // Check for duplicates and slightly offset duplicates
                if (uniqueLocations.has(locationKey)) {
                    latitude += (Math.random() * 0.0001); // Offset slightly
                    longitude += (Math.random() * 0.0001);
                }

                uniqueLocations.add(locationKey);

                const marker = new google.maps.Marker({
                    position: { lat: latitude, lng: longitude },
                    map: map,
                    title: `Factory Name: ${log.name}\nGate Number: ${log.gate_nu}` // Include in_time in the marker title
                });

                // Add click event listener to the marker
                google.maps.event.addListener(marker, 'click', function () {
                    showFactoryDetails(log);
                });

                markers.push(marker); // Add marker to the array

                // Accumulate lat and lng for midpoint calculation
                totalLat += latitude;
                totalLng += longitude;
                markerCount++;

                // Extend the bounds to include this marker's location
                bounds.extend(marker.position);
            } else {
                console.error('Invalid coordinates for Factory ID: ' + log.factory_id);
            }
        }
    });

    // If filtering for a single factory, zoom in closer to the marker
    if (factoryId !== 'all' && markers.length > 0) {
        map.setCenter(markers[0].getPosition()); // Center the map on the marker
        map.setZoom(18); // Zoom in closer to the marker
    } else if (factoryId === 'all' && markerCount > 0) {
        // If all factories are selected and markers exist, calculate the midpoint
        const midLat = totalLat / markerCount;
        const midLng = totalLng / markerCount;

        // Set the map's center to the midpoint and zoom in
        map.setCenter({ lat: midLat, lng: midLng });
        map.setZoom(15); // Adjust zoom level for the midpoint (can change as needed)
    } else {
        // If no factories are available or selected, reset to default
        map.fitBounds(bounds);
        map.setZoom(15); // Default zoom level
    }
}

{{-- function showFactoryDetails(log) {
    // Construct vehicle number from state_code, district_code, serial_code, and unique_code
    const vehicleNumber = `${log.state_code}-${log.district_code}-${log.serial_code}-${log.unique_code}`;

    // Fetch the div and set its content with factory data
    const factoryDetailsDiv = document.getElementById('factory-details');
    factoryDetailsDiv.innerHTML = `
        <strong>Factory Name:</strong> ${log.name} <br>
        <strong>Factory ID:</strong> ${log.factory_id} <br>
        <strong>Gate Number:</strong> ${log.gate_nu} <br>
        <strong>Entry Driver Name:</strong> ${log.entry_driver_name} <br>
        <strong>Entry User Name:</strong> ${log.entry_user_name} <br>
        <strong>Latitude:</strong> ${log.latitude} <br>
        <strong>Longitude:</strong> ${log.longitude} <br>
        <strong>Entry Date/Time:</strong> ${log.in_time} <br>
        <strong>Vehicle Number:</strong> ${vehicleNumber} <br>
    `;
} --}}
function showFactoryDetails(log) {
    // Construct vehicle number from state_code, district_code, serial_code, and unique_code
    //const vehicleNumber = `${log.state_code}-${log.district_code}-${log.serial_code}-${log.unique_code}`;
    const vehicleNumber = `${log.rc_number}`;
    

    // Fetch the div and set its content with factory data in a horizontal table format
    const factoryDetailsDiv = document.getElementById('factory-details');
    factoryDetailsDiv.innerHTML = `
        <div class="table-wrap table-responsive">
            <table class="table table-default" id="factory_details_table">
                <thead>
                    <tr>
                        <th>Factory</th>
                        <th>Entry Gate</th>
                        <th>Entry Staff</th>
                        <th>Vehicle Number</th>
                        <th>Entry Driver Name</th>
                        <th>In Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>${log.name}</td>
                        <td>${log.gate_nu}</td>
                        <td>${log.entry_user_name}</td>
                        <td>${vehicleNumber}</td>
                        <td>${log.entry_driver_name}</td>
                        <td>${log.in_time}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;
}

function handleFactoryChange(selectElement) {
    const factoryId = selectElement.value;
    renderMarkers(factoryId);
}

window.initMap = initMap;
</script>
@endsection
