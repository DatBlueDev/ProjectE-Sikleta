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
    </style>

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/map.js'])
</head>
<body>

<div id="app">
    <div id="osm_map" onclick="getCoordsFromMouseCoords()"></div>
</div>
<div id="mouse-position"></div>

<script type="module">
    let emu = new my_map.display();
</script>

</body>
</html>