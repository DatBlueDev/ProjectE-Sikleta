// Imports from OpenLayer
import 'ol/ol.css';
import {Map, View} from 'ol';
import MousePosition from 'ol/control/MousePosition.js';
import {createStringXY} from 'ol/coordinate.js';
import {defaults as defaultControls} from 'ol/control.js';
import TileLayer from 'ol/layer/Tile';
import VectorSource from 'ol/source/Vector';
import OSM from 'ol/source/OSM';
import VectorLayer from 'ol/layer/Vector';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import LineString from 'ol/geom/LineString';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
import Stroke from 'ol/style/Stroke';
import Overlay from 'ol/Overlay';

import {Modify, defaults} from 'ol/interaction.js';

import {fromLonLat, toLonLat, transform} from 'ol/proj.js';

// Bing Maps API Key
const bingKey = "AkyOWwVpt39J044vGm7Rl0MiNiV2_Jgz2pZ83LXC9VaESrR2N2bXdYoVj1CkMurT";

const mousePositionControl = new MousePosition({
    coordinateFormat: createStringXY(4),
    projection: 'EPSG:4326', 
    className: 'custom-mouse-position',
    target: document.getElementById('mouse-position'),
}); // Function to get Coordinates from the map via mouse position, and sets it as the value for "mouse-position"
const mapElement = document.getElementById('osm_map');
let sourceA = new VectorSource({
    features: [
        new Feature({
            geometry: new Point(fromLonLat([120.5828, 15.1387]))
            
        })
    ]
})

let pointA = new VectorLayer({ // Placeholder function that draws a circle on a specified coordinate
    source: sourceA,
    style: new Style({
        image: new Icon({
        anchor: [0.5, 1],
        src: '/assets/map_marker2.png',
        scale: 0.05,
        color:"#ff3300"
        })
    }) 
});
let sourceB = new VectorSource({
    features: [
        new Feature({
            geometry: new Point(fromLonLat([120.6009, 15.1387]))
            
        })
    ]
})
let pointB = new VectorLayer({ // Placeholder function that draws a circle on a specified coordinate
    source: sourceB,
    style: new Style({
        image: new Icon({
        anchor: [0.5, 1],
        src: '/assets/map_marker.png',
        scale: 0.05
        })
    }) 
});
const createWaypoint = function(layerVector, sourceVector){

    const modify = new Modify({
        hitDetection: layerVector,
        source: sourceVector,
    });
    modify.on(['modifystart', 'modifyend'], function (evt) {
        mapElement.style.cursor = evt.type === 'modifystart' ? 'grabbing' : 'pointer';
    });
    const overlaySource = modify.getOverlay().getSource();
    overlaySource.on(['addfeature', 'removefeature'], function (evt) {
        mapElement.style.cursor = evt.type === 'addfeature' ? 'pointer' : '';
    });
    return modify;
}
let map; // Initializes map 
let my_map = {    
    display: function () { // Defines and Displays the Map
        map = new Map({
            controls: defaultControls().extend([mousePositionControl]),

            target: 'osm_map',
            layers: [
                new TileLayer({
                    source: new OSM()
                }), pointA, pointB
            ],
            view: new View({
                center: [13423815.894427149, 1705190.0197271176],
                zoom: 15
            }), interactions: defaults().extend([
                createWaypoint(pointA, sourceA), createWaypoint(pointB, sourceB)
            ]), overlays: [overlay],
        });

    }
};
window.my_map = my_map; // Makes the map global. (might try to find a better way to call it outside the script)


let start;
let end;
let url;
let layerLines;
const createNewRoutingRequest = function(){
    map.removeLayer(layerLines);
    let coordinates = [sourceA.getFeatures()[0].getGeometry().getCoordinates(),sourceB.getFeatures()[0].getGeometry().getCoordinates()]; 

    start = transform(coordinates[0], 'EPSG:3857', 'EPSG:4326').reverse().toString(); 
    end = transform(coordinates[1], 'EPSG:3857', 'EPSG:4326').reverse().toString();
    
    url = "https://dev.virtualearth.net/REST/v1/Routes?wp.0=" + start + "&wp.1=" + end +
              "&routeAttributes=routePath&key=" + bingKey;
    
    let xhr = new XMLHttpRequest(); // sets up bing api request
    console.log("Request made:" + xhr.readyState);
    xhr.onreadystatechange = function() {
        Routing(xhr);
    }
    xhr.onerror = function(e) { console.log("routing error"); }
    xhr.ontimeout = function(e) { console.log("routing timeout"); }
    xhr.open("GET", url, true);
    xhr.timeout = 3000;
    xhr.send();
}
const createReverseGeocodingRequest = function(coordinates){
    url = "http://dev.virtualearth.net/REST/v1/Locations/" + coordinates[1] + "," + coordinates[0] + "?o=xml&key="+bingKey;
    let xhr = new XMLHttpRequest(); // sets up bing api request
    console.log("Request made:" + xhr.readyState);
    xhr.onreadystatechange = function() {
        ReverseGeocoding(xhr);
    }
    xhr.onerror = function(e) { console.log("rvrs geocoding error"); }
    xhr.ontimeout = function(e) { console.log("rvrs geocoding timeout"); }
    xhr.open("GET", url, true);
    xhr.timeout = 3000;
    xhr.send();
}
window.createReverseGeocodingRequest = createReverseGeocodingRequest;
const element = document.getElementById('popup');

const ReverseGeocoding = function(xhr){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected! " + xhr.readyState);

        let parser = new DOMParser();
        let Address = parser.parseFromString(xhr.responseText,"text/xml").getElementsByTagName("Name")[0].childNodes[0].nodeValue;
        console.log("Calculation Results: " +  Address);
        drawPopUp(Address);

    }
    else{
        console.log("Not ready...")
        return 0;
    }
}
window.createNewRoutingRequest = createNewRoutingRequest;
const Routing = function(xhr){ 
    // Checks if you are able to connect
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected! " + xhr.readyState);
        // Calculates routing, then displays the route calculated.
        var lineString = calculateRouting(xhr);
        displayRouting(lineString);
    }
    else{
        console.log("Not ready...")
    }
}
window.Routing = Routing;
// HELPER FUNCTIONS
var calculateRouting = function(xhr){
    // Calculates routing from the request and the API does all the work
    let linestring = JSON.parse(xhr.responseText).resourceSets[0].resources[0].routePath.line.coordinates;
    for (var i=0; i<linestring.length; i++) {
        linestring[i].reverse();
    }
    return linestring; // returns line string to be used by the other helper function
}
var displayRouting = function(linestring){
    // OpenLayer function that gets the linestring from the calculate routing function and displays it on top of the map
    layerLines = new VectorLayer({ 
        source: new VectorSource({
            features: [new Feature({
            geometry: new LineString(linestring).transform('EPSG:4326', 'EPSG:3857'),
            name: 'Line'
            })]
        }),
        style: new Style({
            stroke: new Stroke({
                color: 'rgba(90,90,255,1)',
                width: 3 // / map.getView().getResolution()
            })
        })     });
    map.addLayer(layerLines);   
}

// Runs on click on map, gets coordinate values (EPSG 4326), stores them into array as double
const getCoordsFromMouseCoords = function(){
    // Gets values in string form, then turns the array into a string
    var Coords = (document.getElementById('mouse-position').innerText.split(", ")).toString(); 
    // Converts stringified array into array with double values of coordinates
    Coords = Coords.match(/\d+(?:\.\d+)?/g).map(Number)
    console.log(Coords);
    return Coords;
}



const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');
const overlay = new Overlay({
    element: container,
    autoPan: {
      animation: {
        duration: 250,
      },
    },
  });

let CoordinatesPopup;
let definePopupContents = function(){
    CoordinatesPopup = transform(getCoordsFromMouseCoords(), 'EPSG:4326', 'EPSG:3857');
    console.log("coords: " + getCoordsFromMouseCoords());
    createReverseGeocodingRequest(getCoordsFromMouseCoords());

};
let drawPopUp = function(Address){
    console.log("address dapat to" + Address);
    content.innerHTML = '<p>You clicked here:</p><code>' +Address + '</code>';
    overlay.setPosition(CoordinatesPopup);
}
window.definePopupContents = definePopupContents;
window.getCoordsFromMouseCoords = getCoordsFromMouseCoords;

// Requests API thingies 
