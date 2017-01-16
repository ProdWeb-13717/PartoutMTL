<script>
function initMap() {
	
	var dataCarte = <?php echo json_encode($data);?>;
	console.log(dataCarte[1].latitude);
	console.log(dataCarte[1].longitude);
	
    var myLatLng = {lat: 45.5017, lng: -73.5673};

	var map = new google.maps.Map(document.getElementById('carte'), {
	zoom: 12,
	center: myLatLng
	});
	
	var infowindow = new google.maps.InfoWindow();

    var marker, i;
	
	for (var i = 0, length = dataCarte.length; i < length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(dataCarte[i].latitude, dataCarte[i].longitude),
			map: map,
			icon: './images/marker.png'
		});
		
		

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				
				var url = window.location.toString(); //prendre URL  
				if (url.indexOf("?") > 0) {
					var url = url.substring(0, url.indexOf("?"));
					console.log(url);
				}
	
				var infoContent = "<a class='infoCarteA' href='"+url+"?requete=afficheOeuvre&idOeuvre="+dataCarte[i].idOeuvre+"'><div class='infoCarteTitre' >"+dataCarte[i].titre+"</div>";
				if(dataCarte[i].dateFinProduction){infoContent+="<div class='infoCarte'>Année: "+dataCarte[i].dateFinProduction+"</div>";}
				if(dataCarte[i].materiaux){infoContent+="<div class='infoCarte'>Materiaux: "+dataCarte[i].materiaux+"</div>";}
				infoContent+="</a>";
				
				infowindow.setContent(infoContent);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
}
</script>
<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNHto2PiYu47E4pxifVRwCnRgJc_ZS22w&signed_in=true&callback=initMap"></script>
		
<div id="carte" style="height:600px;" >
	<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d89491.89664322723!2d-73.6876911!3d45.4975608!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sca!4v1483937934903" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" style="border:0" allowfullscreen></iframe>
</div>

