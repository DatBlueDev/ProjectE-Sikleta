<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - eSikleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/map.js'])
    @laravelPWA
</head>
<body>
    <main>
        <div id="map-area" class="fixed-top">
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
              </div>
            <div id="app">
                <div id="osm_map" onclick="getCoordsFromMouseCoords();"></div>
            </div>
            <div class="menu">
                <button class="border border-0" style="background-color: transparent;">
                    <img src=" {{asset('assets/menu-icon.png')}}" alt="menuicon" id="menu-icon" class="mt-5 ms-4 p-0 img-shadow rounded-circle btn">
                </button>
            </div>
        </div>

        <div class="map-back">
        </div>

        <div class="home rounded-top pt-4 bg-body">

            <div class="categ-content">
                <h4 class="my-1 ms-4 ready-msg mt-2">Ready to go, Username?</h4>
                <h3 class="mb-1 ms-4 travel-msg">How would you like travel?</h3>

                <div class="slide-container swiper mt-4">
                    <div class="swiper-pagination"></div>
                    <div class="slide-content">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <button id="bus" class="btn btn-vehicle rounded-4 mx-auto" onClick="reply_click(this.id)">
                                        <img src="{{asset('assets/vehicle-bus.png')}}" class="card-img img-shadow" alt="bus">
                                        <h5 class="dark-blue fw-bold">Bus</h5>
                                    </button>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <button id="sedan" class="btn btn-vehicle rounded-4 mx-auto" onClick="reply_click(this.id)">
                                        <img src="{{asset('assets/vehicle-sedan.png')}}" class="card-img img-shadow" alt="bus">
                                        <h5 class="dark-blue fw-bold">Sedan</h5>
                                    </button>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <button id="suv" class="btn btn-vehicle rounded-4 mx-auto" onClick="reply_click(this.id)">
                                        <img src="{{asset('assets/vehicle-suv.png')}}" class="card-img img-shadow" alt="bus">
                                        <h5 class="dark-blue fw-bold">SUV</h5>
                                    </button>
                                </div>
                            </div>

                            <div id="van" class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <button id="van" class="btn btn-vehicle rounded-4 mx-auto" onClick="reply_click(this.id)">
                                        <img src="{{asset('assets/vehicle-van.png')}}" class="card-img img-shadow" alt="bus">
                                        <h5 class="dark-blue fw-bold">Van</h5>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="locquery">
                <div class="searchbar justify-content-center align-items-center d-flex my-3">
                    <div id="src">
                        <input class="rounded-3 border border-2 py-2 mt-3" id = "destinationInput" type="text" placeholder="Enter your destination">
                        <button type="button" onclick = "createQueryForLocationRequest(document.getElementById('destinationInput').value)" class="btn btn-orange text-light">Search</button>
                    </div>
                    
                </div>
                
                <div  class = "d-flex justify-content-center text-center    ">
                    <table id = "queryResultsTable">

                    </table>
                </div>
                <div  class = "d-flex justify-content-center text-center    " style="background-color:rgb(39, 90, 200)">
                    <button type="button" class="btn btn-secondary" onclick="calculateAll()" > hey </button>
                    <div id="kmOfRouteDisplay"></div> <br>
                    <div id="ETAOfRouteDisplay"></div> <br>
                    <div id="PricingDisplay"></div>

                </div>
                <div class="savedplaces">
                    <h3 class="fw-bold text-light ms-3 fs-2">Saved Places</h3>
                </div><!-- SAVED PLACES -->

                <div class="slide-container swiper mt-4">
                    <div class="swiper-pagination"></div>
                    <div class="slide-content">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <div class="svdplcdiv d-flex flex-column align-items-center mx-auto my-4" style="height: 20vh;">
                                        <div class="svdplcimg position-relative p-3 rounded-circle bg-body img-shadow btn">
                                            <img src="{{asset('assets/saved-loc-home.png')}}" alt="home icon" style="width: 100%; height: 7vh;">
                                        </div>
                                        <div class="svdplctext text-center mt-2">
                                            <h4 class="fw-bold text-light">Home</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <div class="svdplcdiv d-flex flex-column align-items-center mx-auto my-4" style="height: 20vh;">
                                        <div class="svdplcimg position-relative p-3 rounded-circle bg-body img-shadow btn">
                                            <img src="{{asset('assets/saved-loc-work.png')}}" alt="work icon" style="width: 100%; height: 7vh;">
                                        </div>
                                        <div class="svdplctext text-center mt-2">
                                            <h4 class="fw-bold text-light">Work</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <div class="svdplcdiv d-flex flex-column align-items-center mx-auto my-4" style="height: 20vh;">
                                        <div class="svdplcimg position-relative p-3 rounded-circle bg-body img-shadow btn">
                                            <img src="{{asset('assets/saved-loc-banner.png')}}" alt="banner icon" style="width: 100%; height: 7vh;">
                                        </div>
                                        <div class="svdplctext text-center mt-2">
                                            <h4 class="fw-bold text-light">Saved 1</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 4 -->
                            <div class="swiper-slide">
                                <div class="card-wrapper mx-1">
                                    <div class="svdplcdiv d-flex flex-column align-items-center mx-auto my-4" style="height: 20vh;">
                                        <div class="svdplcimg position-relative p-3 rounded-circle bg-body img-shadow btn">
                                            <img src="{{asset('assets/saved-loc-add.png')}}" alt="add icon" style="width: 100%; height: 7vh;">
                                        </div>
                                        <div class="svdplctext text-center mt-2">
                                            <h4 class="fw-bold text-light">Add</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    let vehicle;
    let action;
    let form;
    function reply_click(clicked_id)
  {
      vehicle = clicked_id; 
      action = "/" + vehicle;
      console.log(action);
      let form = document.getElementById("src");
      console.log(form);
      form.action = action;
      console.log()
  }</script>

  <script type="module">
        let emu = new my_map.display();

        let selected = null;
            console.log("e")

        my_map.returnMap().on('click', function (evt) {
            if (selected !== null){
                selected=null;
            }
            my_map.returnMap().forEachFeatureAtPixel(evt.pixel, function (f) {

                selected = f;
                definePopupContents(f); 
                console.log(f);
                return true;
            }, {hitTolerance:5})
            console.log("what");
        });
        startUpGeoLocation();
    </script>


</body>
</html>