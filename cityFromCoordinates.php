<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>AgriTech</title>
  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="jquery.datetimepicker.css">
<style>
	body{
    font-size: 1em;
	}
	.contact-form-area {
    font-size: 1.5em;
	}
	.form-control{
		font-size: 1em;
	}
.tableFixHead { border: 1px solid #000; border-left: 0; border-right: 0; }
.tableFixHead th, td { border: 1px solid #000; border-top: 0; }
.tableFixHead tbody tr:last-child td { border-bottom: 0; }
.tableFixHead thead th { box-shadow: 1px 1px 0 #000; }
</style>
  <script src="js/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl-N13dPLykJG9rBZKUBjpeyY_i5dWoc0&libraries=geometry"></script>
</head>


<body onload="getCityName(30.033591,72.357555)" >
<script>
// Demo: http://jsfiddle.net/xuyp8qb5/
// Note: You need Google Map API Key to run demo; bit.ly/2pBgToW
function getCityName(Lat, Lng){
	var latlng;
latlng = new google.maps.LatLng(31.016618, 71.082739); // New York, US
//latlng = new google.maps.LatLng(37.990849233935194, 23.738339349999933); // Athens, GR
//latlng = new google.maps.LatLng(48.8567, 2.3508); // Paris, FR
//latlng = new google.maps.LatLng(47.98247572667902, -102.49018710000001); // New Town, US
//latlng = new google.maps.LatLng(35.44448406385493, 50.99001635390618); // Parand, Tehran, IR
//latlng = new google.maps.LatLng(34.66431108560504, 50.89113940078118); // Saveh, Markazi, IR

new google.maps.Geocoder().geocode({'latLng' : latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
            var country = null, countryCode = null, city = null, cityAlt = null;
            var c, lc, component;
            for (var r = 0, rl = results.length; r < rl; r += 1) {
                var result = results[r];

                if (!city && result.types[0] === 'locality') {
                    for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                        component = result.address_components[c];

                        if (component.types[0] === 'locality') {
                            city = component.long_name;
                            break;
                        }
                    }
                }
                else if (!city && !cityAlt && result.types[0] === 'administrative_area_level_1') {
                    for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                        component = result.address_components[c];

                        if (component.types[0] === 'administrative_area_level_1') {
                            cityAlt = component.long_name;
                            break;
                        }
                    }
                } else if (!country && result.types[0] === 'country') {
                    country = result.address_components[0].long_name;
                    countryCode = result.address_components[0].short_name;
                }

                if (city && country) {
                    break;
                }
            }

            console.log("City: " + city + ", City2: " + cityAlt + ", Country: " + country + ", Country Code: " + countryCode);
        }
    }
});
}

function getCity(latlng) {
    var def = $.Deferred();
console.log("DDDDD");
    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?latlng=12.9715987,77.5945627').done(function(data){
        var location;
        if( data.results && data.results.length ) {
            var components = data.results[0].address_components;

            for(var i = 0; i < components.length; i++) {
                if( ~components[i].types.indexOf('locality') ) {
                    location = components[i].long_name;
                    break;
                }
            }

            if(location) return def.resolve(location);
        }

        return def.reject();
    })
    .fail(function(){
        def.reject();
    });

    return def.promise();
}

$(document).ready(function(){
			getCity('12.9715987,77.5945627').done(function(cityName){
				$elem.val( cityName )
			});
		});
</script>

</body>

</html>