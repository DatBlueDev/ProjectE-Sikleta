// Imports from OpenLayer
import 'ol/ol.css';
import {Map, View} from 'ol';
import MousePosition from 'ol/control/MousePosition.js';
import {createStringXY} from 'ol/coordinate.js';
import {defaults as defaultControls} from 'ol/control.js';
import TileLayer from 'ol/layer/Tile';
import VectorA from 'ol/source/Vector';
import OSM from 'ol/source/OSM';
import VectorB from 'ol/layer/Vector';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import LineString from 'ol/geom/LineString';
import {fromLonLat, toLonLat, transform} from 'ol/proj.js';

// Bing Maps API Key
var bingKey = "AkyOWwVpt39J044vGm7Rl0MiNiV2_Jgz2pZ83LXC9VaESrR2N2bXdYoVj1CkMurT";

const mousePositionControl = new MousePosition({
    coordinateFormat: createStringXY(4),
    projection: 'EPSG:4326', 
    className: 'custom-mouse-position',
    target: document.getElementById('mouse-position'),
}); // Function to get Coordinates from the map via mouse position, and sets it as the value for "mouse-position"


var marker = new VectorB({ // Placeholder function that draws a circle on a specified coordinate
    source: new VectorA({
        features: [
            new Feature({
                geometry: new Point(fromLonLat([121, 13]))
            })
        ]
    })  
});

var map; // Initializes map 
var my_map = {    
    display: function () { // Defines and Displays the Map
        map = new Map({
            controls: defaultControls().extend([mousePositionControl]),

            target: 'osm_map',
            layers: [
                new TileLayer({
                    source: new OSM()
                }), marker
            ],
            view: new View({
                center: [0, 0],
                zoom: 0
            })
        });

    }
};
window.my_map = my_map; // Makes the map global. (might try to find a better way to call it outside the script)

// Temporary coordinate values (SM CLARK, CLC CAMPUS)
var coordinates = [[13422929.525037082, 1708535.058458561],[13417864.062636271, 1711385.850227809]]; 

// Converts coordinates to prefered format to put in the url for the API request
var start = transform(coordinates[0], 'EPSG:3857', 'EPSG:4326').reverse().toString(); 
var end = transform(coordinates[1], 'EPSG:3857', 'EPSG:4326').reverse().toString();

var url = "https://dev.virtualearth.net/REST/v1/Routes?wp.0=" + start + "&wp.1=" + end +
          "&routeAttributes=routePath&key=" + bingKey;

var xhr = new XMLHttpRequest(); // sets up bing api request
xhr.onreadystatechange = function() {
    // Calls Routing function
    Routing();
}
var Routing = function(){ 
    // Checks if you are able to connect
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected!");
        // Calculates routing, then displays the route calculated.
        var lineString = calculateRouting();
        displayRouting(lineString);
    }
    else{
        console.log("Not ready...")
    }
}

// HELPER FUNCTIONS
var calculateRouting = function(){
    // Calculates routing from the request and the API does all the work
    var linestring = JSON.parse(xhr.responseText).resourceSets[0].resources[0].routePath.line.coordinates;
    for (var i=0; i<linestring.length; i++) {
        linestring[i].reverse();
    }
    return linestring; // returns line string to be used by the other helper function
}
var displayRouting = function(linestring){
    // OpenLayer function that gets the linestring from the calculate routing function and displays it on top of the map
    var layerLines = new VectorB({ 
        source: new VectorA({
            features: [new Feature({
            geometry: new LineString(linestring).transform('EPSG:4326', 'EPSG:3857'),
            name: 'Line'
            })]
        }),
    });
    map.addLayer(layerLines);   
}

// Runs on click on map, gets coordinate values (EPSG 4326), stores them into array as double
var getCoordsFromMouseCoords = function(){
    // Gets values in string form, then turns the array into a string
    var Coords = (document.getElementById('mouse-position').innerText.split(", ")).toString(); 
    // Converts stringified array into array with double values of coordinates
    Coords = Coords.match(/\d+(?:\.\d+)?/g).map(Number)
    console.log(Coords);
}
window.getCoordsFromMouseCoords = getCoordsFromMouseCoords;

// Requests API thingies 
xhr.onerror = function(e) { console.log("error"); }
xhr.ontimeout = function(e) { console.log("timeout"); }
xhr.open("GET", url, true);
xhr.timeout = 3000;
xhr.send();