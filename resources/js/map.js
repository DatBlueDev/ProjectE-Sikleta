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
import Overlay from 'ol/Overlay';
import Geolocation from 'ol/Geolocation.js';
import {Circle as CircleStyle, Fill, Stroke, Style, Icon} from 'ol/style.js';

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
            geometry: new Point(fromLonLat([-117.8471,33.8635]))
            
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
            geometry: new Point(fromLonLat([-118.2492,34.0705]))
            
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

let map; // Initializes map 
let mapView = new View({
    center: [-13134430.871411238, 4021727.5382839725],
    extent: [-13207322.873982674, 3949038.4688658006, -13058466.45089391, 4076583.5285595],

    zoom: 10
})
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
            view: mapView, interactions: defaults().extend([
                createWaypoint(pointA, sourceA), createWaypoint(pointB, sourceB)
            ],), overlays: [overlay],
            
        });

    },
    returnMap: function(){return map}
};
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

// Makes the map global. (might try to find a better way to call it outside the script)


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

const createEtaOfRouteRequest = function(travelMode) {

    let origin = transform(sourceA.getFeatures()[0].getGeometry().getCoordinates(), 'EPSG:3857', 'EPSG:4326');
    let destination = transform(sourceB.getFeatures()[0].getGeometry().getCoordinates(), 'EPSG:3857', 'EPSG:4326');
    console.log(origin);
    console.log(destination);
    origin = [origin[1], origin[0]]
    destination = [destination[1], destination[0]]

    // origin = [120.5887, 15.1830]
    // destination = [120.5769, 15.1573]
    console.log("origin: " + origin + " | destination: " +  destination + " | travel mode: " +  travelMode)
    url = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=" + origin +"&destinations=" + destination +"&travelMode=driving&key=" + bingKey;
    console.log(url);
    let xhr = new XMLHttpRequest(); // sets up bing api request
    console.log("Request made:" + xhr.readyState);
    xhr.onreadystatechange = function() {
        EtaOfRoute(xhr);
     }
    xhr.onerror = function(e) { console.log("rvrs geocoding error"); }
    xhr.ontimeout = function(e) { console.log("rvrs geocoding timeout"); }
    xhr.open("GET", url, true);
    xhr.timeout = 3000;
    xhr.send();
}
window.createEtaOfRouteRequest = createEtaOfRouteRequest;
const createQueryForLocationRequest = function(query){
    query = encodeURIComponent(query.trim());
    let Coords = transform(sourceA.getFeatures()[0].getGeometry().getCoordinates(), 'EPSG:3857', 'EPSG:4326'); 
    Coords = [Coords[1], Coords[0]];
    url = "https://dev.virtualearth.net/REST/v1/LocalSearch/?query=" + query + "&userLocation="+Coords + "&o=xml&key="+bingKey;
    //&userMapView={lat,lon,lat,lon}
    console.log(url);
    let xhr = new XMLHttpRequest(); // sets up bing api request
    console.log("Request made:" + xhr.readyState);
    xhr.onreadystatechange = function() {
        QueryForAddress(xhr);
     }
    xhr.onerror = function(e) { console.log("rvrs geocoding error"); }
    xhr.ontimeout = function(e) { console.log("rvrs geocoding timeout"); }
    xhr.open("GET", url, true);
    xhr.timeout = 3000;
    xhr.send();
}
window.createQueryForLocationRequest=createQueryForLocationRequest;
const QueryForAddress = function(xhr){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected! " + xhr.readyState);
        let parser = new DOMParser();

        let QueriedAddress = parser.parseFromString(xhr.responseText,"text/xml").getElementsByTagName("AddressLine")[0].childNodes[0].nodeValue;
        console.log(QueriedAddress + " address");
    }
    else{       
        return 0;
    }   
}
const EtaOfRoute = function(xhr){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected! " + xhr.readyState);

        let ETA = JSON.parse(xhr.responseText).resourceSets[0].resources[0].results[0].travelDuration;
        console.log(ETA + " minutes");
    }
    else{       
        return 0;
    }   
}
window.createReverseGeocodingRequest = createReverseGeocodingRequest;
const element = document.getElementById('popup');

const ReverseGeocoding = function(xhr){
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Connected! " + xhr.readyState);

        let parser = new DOMParser();
        let Address = parser.parseFromString(xhr.responseText,"text/xml").getElementsByTagName("Name")[0].childNodes[0].nodeValue;
        drawPopUp(Address);

    }
    else{
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
    var Coords = (document.querySelector('.custom-mouse-position').textContent.split(", "))
    console.log("raw coords:" + Coords)
    var Coords = [parseFloat(Coords[0]), parseFloat(Coords[1])]
    // Converts stringified array into array with double values of coordinates
    console.log("Coords after?: " + Coords);
    return Coords;
}



const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');
closer.onclick = function() {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
  };
const overlay = new Overlay({
    element: container,
    autoPan: {
      animation: {
        duration: 250,
      },
    },
  });

let CoordinatesPopup;

let definePopupContents = function(Waypoint){
    console.log("Coords of waypoint: " + sourceA.getFeatures()[0].getGeometry().getCoordinates());
    let Coords;

    Coords = transform(Waypoint.getGeometry().getCoordinates(), 'EPSG:3857', 'EPSG:4326'); 
//    start = transform(coordinates[0], 'EPSG:3857', 'EPSG:4326').reverse().toString(); 

    
    CoordinatesPopup = transform(Coords, 'EPSG:4326', 'EPSG:3857');
    console.log("coords: " + Coords);
    createReverseGeocodingRequest(Coords);

};
let drawPopUp = function(Address){
    content.innerHTML = '<p>You clicked here:</p><code>' +Address + '</code>';
    overlay.setPosition(CoordinatesPopup);
}
const startUpGeoLocation = function(){
const geolocation = new Geolocation({
    // enableHighAccuracy must be set to true to have the heading value.
    trackingOptions: {
      enableHighAccuracy: true,
    },
    projection: mapView.getProjection(),
});
  
function el(id) {
    return document.getElementById(id);
}

el('track').addEventListener('change', function () {
    geolocation.setTracking(this.checked);
});

// update the HTML page when the position changes.
geolocation.on('change', function () {
el('accuracy').innerText = geolocation.getAccuracy() + ' [m]';
el('altitude').innerText = geolocation.getAltitude() + ' [m]';
el('altitudeAccuracy').innerText = geolocation.getAltitudeAccuracy() + ' [m]';
el('heading').innerText = geolocation.getHeading() + ' [rad]';
el('speed').innerText = geolocation.getSpeed() + ' [m/s]';
});

// handle geolocation error.
geolocation.on('error', function (error) {
const info = document.getElementById('info');
    info.innerHTML = error.message;
    info.style.display = '';
    });
    
    const accuracyFeature = new Feature();
    geolocation.on('change:accuracyGeometry', function () {
    accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
    });

    const positionFeature = new Feature();
    positionFeature.setStyle(
    new Style({
        image: new CircleStyle({
        radius: 6,
        fill: new Fill({
            color: '#3399CC',
        }),
        stroke: new Stroke({
            color: '#fff',
            width: 2,
        }),
        }),
    })
    );
    
    geolocation.on('change:position', function () {
        const coordinates = geolocation.getPosition();
        positionFeature.setGeometry(coordinates ? new Point(coordinates) : null);
    });
    new VectorLayer({
        map: my_map.returnMap(),
        source: new VectorSource({
        features: [accuracyFeature, positionFeature],
        }),
    });
}
console.log(my_map.returnMap)
window.definePopupContents = definePopupContents;
window.getCoordsFromMouseCoords = getCoordsFromMouseCoords;
window.my_map = my_map; 
window.startUpGeoLocation = startUpGeoLocation;
// Requests API thingies 
