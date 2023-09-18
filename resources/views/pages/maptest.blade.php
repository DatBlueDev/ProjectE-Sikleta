<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #osm_map {
            position: absolute;
            width: 90%;
            height: 90%;
        }
        #mouse-position{
            position: absolute;
            right:0;
            bottom:0;
        }
        #getRouteButton{
            position: absolute;
            left:0;
            bottom:0;
        }
        #getReverseGeolocationButton{
            position: absolute;
            left:20%;
            bottom:0;
        }
        .ol-popup {
        position: absolute;
        background-color: white;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 280px;
      }
      .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
      }
      .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
      }
      .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
      }
      .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
      }
      .ol-popup-closer:after {
        content: "✖";
      }
    </style>

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/map.js'])
</head>
<body>
    <div id="popup" class="ol-popup">
        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
        <div id="popup-content"></div>
      </div>
    <div id="app">
        <div id="osm_map" onclick="getCoordsFromMouseCoords(); definePopupContents();"></div>
    </div>
    <div id="mouse-position"></div>
    <button class="button button-primary" id="getRouteButton" onclick = "createNewRoutingRequest();">Calculate Route</button>
    <button class="button button-primary" id="getReverseGeolocationButton" onclick = "reverseGeocode();">Reverse Geocalc</button>

    <script type="module">
        let emu = new my_map.display();
    </script>

</body>
</html>