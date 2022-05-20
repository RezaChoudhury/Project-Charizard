<?php
$lat = $row['lat'];
$long = $row['lng'];
?>
<script>   
function initMap() {
const uluru = { lat: <?php echo $lat; ?>, lng: <?php echo $long; ?> };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: uluru,
    disableDefaultUI: true,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}
  </script>