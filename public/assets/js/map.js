var map;

$(window).bind("load", function initMap() {
	'use strict';
	map = new google.maps.Map(document.getElementById('map'), {
		// Zoom range level
		zoom: 17,
		center: new google.maps.LatLng(41.8902576, 12.4912968),
		mapTypeId: 'roadmap',
		// Style the map
		styles: [
            {elementType: 'geometry', stylers: [{color: '#f7f7f7'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#ffffff'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#4a4a4a'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#DBE4D3'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#DAD1B5'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#ffffff'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#AB9D6B'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#AFDCE9'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#4a4a4a'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#ffffff'}]
            }
          ]
	});

	var icons = {
		icon: {
			icon: 'images/location.png'
		}
	};

	var features = [{
		position: new google.maps.LatLng(41.8902000, 12.4922304),
		type: 'icon'
	}];

	// Create markers.
	features.forEach(function (feature) {
		var marker = new google.maps.Marker({
			position: feature.position,
			icon: icons[feature.type].icon,
			map: map
		});
	});
}
);