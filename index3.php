
<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Places Autocomplete</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

    <style>
      body {
        font-family: sans-serif;
        font-size: 14px;
      }
      #map_canvas {
        height: 400px;
        width: 600px;
        margin-top: 0.6em;
      }
      input {
        border: 1px solid  rgba(0, 0, 0, 0.5);
      }
      input.notfound {
        border: 2px solid  rgba(255, 0, 0, 0.4);
      }
    </style>

    <script>
      function initialize() {
      var options = {
 	types: ['establishment'],
  componentRestrictions: {country: 'pk'}
};
     
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input,options);

     
       
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        

            }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div>
      <input id="searchTextField" type="text" size="50">
        </div>
    <div id="map_canvas"></div>
  </body>
</html>
