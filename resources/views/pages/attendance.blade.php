@extends('layouts.app')

@section('title', 'Attendance')
@section('desc', 'Page Attendance. ')

@section('content')
<!-- Tombol Absensi Datang -->
<div class="container">
  <div id="gpsReminder" class="alert alert-warning" style="display:none;">
    Harap nyalakan GPS Anda untuk dapat menggunakan fitur ini.
  </div>
  
  <div class="row d-flex justify-content-center">
    <div class="col-md-8">
      <!-- Attendance Datang Card -->
      <div class="card mt-3">
        <div class="card-body">
           <!-- Map Section -->
      <h2 class="text-center">Map Section</h2>
      <div id="map"></div>
      <hr>
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Waktu</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td id="time">-</td>
            <td id="latitude"></td>
            <td id="longitude"></td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-around">
        <!-- Attendance Button -->
        <form method="POST" action="/attendance">
          @csrf
          <input type="hidden" name="type" value="datang">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-fingerprint"></i> Absensi Datang
          </button>
        </form>
        <form method="PUT" action="/attendance">
          @csrf
          <input type="hidden" name="type" value="datang">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-fingerprint"></i> Absensi Pulang
          </button>
        </form>
      </div>

        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <!-- Tabel Attendance -->
      <div class="card mt-3">
        <div class="card-body">
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">Waktu</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>          
          
        </div>
      </div>
    </div>
  </div>
 
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, locationDenied, {enableHighAccuracy: true});
      } else {
          console.log("Geolocation is not supported by this browser.");
      }
  });

  function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      var time = new Date().toLocaleString();

      document.getElementById('latitude').textContent = latitude;
      document.getElementById('longitude').textContent = longitude;
      document.getElementById('time').textContent = time;

      // Inisialisasi peta
      var map = L.map('map').setView([latitude, longitude], 13);

      // Tambahkan layer peta OpenStreetMap
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      // Tambahkan marker untuk lokasi pengguna
      L.marker([latitude, longitude]).addTo(map)
          .bindPopup('Your location')
          .openPopup();
  }
  
      function locationDenied(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log("User denied the request for Geolocation.");
            alert("Please enable location services or GPS to use this feature.");
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.");
            alert("Please enable location services or GPS to use this feature.");
            break;
        case error.TIMEOUT:
            console.log("The request to get user location timed out.");
            alert("Error to get location services or GPS, please refresh your page.");
            break;
        case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.");
            alert("Error to get location services or GPS, please refresh your page.");
            break;
    }
  }
</script>
@endsection
