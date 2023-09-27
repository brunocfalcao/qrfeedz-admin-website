<template>
    <div>
        <input id="pac-input" type="text" placeholder="Enter a location">
        <div id="map" style="height: 400px;"></div>
        <input type="hidden" :name="field.attribute" :value="address">
    </div>
</template>

<script>
export default {
    props: ['field', 'resourceName', 'resourceId'],

    data: () => ({
        address: null,
    }),

  mounted() {
      const googleMapsScript = document.createElement('script');
      googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyD6nqxNAUlbJR8-N3GHqaBNbMANgjFMSXk&libraries=places&callback=initMap`;
      googleMapsScript.async = true;
      document.head.appendChild(googleMapsScript);

      googleMapsScript.onload = () => {
          const map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: -33.8688, lng: 151.2195 },
              zoom: 13,
              mapTypeId: "roadmap",
          });

          const input = document.getElementById("pac-input");
          const searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          map.addListener("bounds_changed", () => {
              searchBox.setBounds(map.getBounds());
          });

          let markers = [];

          searchBox.addListener("places_changed", () => {
              const places = searchBox.getPlaces();
              if (places.length === 0) return;

              markers.forEach((marker) => {
                  marker.setMap(null);
              });
              markers = [];

              const bounds = new google.maps.LatLngBounds();
              places.forEach((place) => {
                  if (!place.geometry || !place.geometry.location) {
                      console.log("Returned place contains no geometry");
                      return;
                  }

                  const icon = {
                      url: place.icon,
                      size: new google.maps.Size(71, 71),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25),
                  };

                  markers.push(new google.maps.Marker({
                      map,
                      icon,
                      title: place.name,
                      position: place.geometry.location,
                  }));

                  if (place.geometry.viewport) {
                      bounds.union(place.geometry.viewport);
                  } else {
                      bounds.extend(place.geometry.location);
                  }

                  this.address = place.formatted_address;
              });

              map.fitBounds(bounds);
          });
      };
  }
};
</script>

<style>
/* Your custom styles */
</style>
