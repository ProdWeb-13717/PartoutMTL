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
	
	var contentString = '<div style="width: 94.2%; padding-left:10px; height: 25px;float: left;color: #FFF;background: #ed1e79;line-height: 25px;border-radius:5px 5px 0px 0px;"><strong><b>"You feild"</b></strong></div><div style="clear:both;height:0px;"><div style="float:left;width:90%;padding:5px 10px;border:1px solid #ccc;border-top:none;border-radius:0px 0px 5px 5px;"><div style="float:left;color:#666;font-size:18px;font-weight:bold;margin:5px 0px;"> <div style="padding: 0px;">]]..product_list[i].category..[[</div></div><div style="clear:both;height:0px;"></div><div style="float:left;line-height:18px;color:#666;font-size:13px;">"You feild"</div><div style="clear:both;height:0px;"></div><form action=\"navigat:"You feild"\"><input type=\"submit\"/ style=\"background:#7e7e7e;float:right;color:#FFF;padding:5px 7px;font-size:10px;font-weight:bold;border:none;margin:5px 0px; border-radius:0px !important;\" value=\"More Info\" ></form></div></div>';
	
	for (var i = 0, length = dataCarte.length; i < length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(dataCarte[i].latitude, dataCarte[i].longitude),
			map: map,
			icon: './images/marker.png'
		});
		
		

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				
				var infoContent = "<div class='infoCarteTitre'>"+dataCarte[i].titre+"</div>";
				if(dataCarte[i].dateFinProduction){infoContent+="<div class='infoCarte'>Année: "+dataCarte[i].dateFinProduction+"</div>";}
				if(dataCarte[i].materiaux){infoContent+="<div class='infoCarte'>Materiaux: "+dataCarte[i].materiaux+"</div>";}
				
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

