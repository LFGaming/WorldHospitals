
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include "php/block_header.php" ?>

    <body>
        <!-- Sidebar -->

        <?php include "php/sidebar.php" ?>
    
        <div id="mapid" class="sidebar-map"></div>

        <script>
//			var mymap = L.map('mapid', {layers: [tLayer, markerz]}).setView([52.07344, 5.13814], 13);
//					L.control.layers(baseLayers, overlays).addTo(mymap);
        
            var tLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibGZnYW1pbmciLCJhIjoiY2tkNmM1azJ2MDU4ZDJ5dGc2YzIxZTZvaSJ9.xL24tk-KhvpMokUWxhEPGA', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>, ' +
                    '<a href="https://github.com/LFGaming/WorldHospitals">Github</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }) //.addTo(mymap);
        
            /* L.marker([52.09744, 5.13334]).addTo(mymap)
                .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup(); */
        
        
            var popup = L.popup();
        
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
            }

			var heat = L.heatLayer(hospitalsheat, {radius: 15});

			var markers = new L.MarkerClusterGroup();

	var grayscale   = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibGZnYW1pbmciLCJhIjoiY2tkNmM1azJ2MDU4ZDJ5dGc2YzIxZTZvaSJ9.xL24tk-KhvpMokUWxhEPGA', {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1});
	var streets  = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibGZnYW1pbmciLCJhIjoiY2tkNmM1azJ2MDU4ZDJ5dGc2YzIxZTZvaSJ9.xL24tk-KhvpMokUWxhEPGA', {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1});

	var baseLayers = {
		"Grayscale": grayscale,
		"Streets": streets
	}; 

		var overlays = {
		"Hospitals": markers,
		"Heatmap": heat
		};

		var x,y;  
		for (i in hospitalscoords) {
			x = hospitalscoords[i][0];
			y = hospitalscoords[i][1];
			markers.addLayer(new L.Marker([x,y]));
		};

		var mymap = L.map('mapid', {layers: [tLayer, markers]}).setView([52.07344, 5.13814], 13);
				L.control.layers(baseLayers, overlays).addTo(mymap);

            mymap.on('click', onMapClick);
        
        var sidebar = L.control.sidebar('sidebar').addTo(mymap);
        </script>
    </body>
</html>