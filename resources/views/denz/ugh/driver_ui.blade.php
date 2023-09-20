<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - eSikleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <main>
        <div id="map-area" class="fixed-top" style="background-image: url('{{ asset('assets/mapsample.png')}}');">
            <div class="menu">
                <button class="border border-0" style="background-color: transparent;">
                    <img src=" {{asset('assets/menu-icon.png')}}" alt="menuicon" id="menu-icon" class="mt-5 ms-4 p-0 img-shadow rounded-circle btn">
                </button>
            </div>
        </div>

        <div class="map-back">
        </div>

        <div class="home rounded-top pt-4 bg-body">

            <div class="categ-content" style="overflow-y: scroll; height: 400px; overflow-x:hidden">
                <h3 class="mb-1 ms-4 travel-msg">Book</h3>
                <div class="booking">
                    <div class="arrived">
                        <div class="card mb-3" style="min-width: 370px;">
                            <div class="row g-0">
                                <div class="col-md-4" style="max-width:150px">
                                    <img src="{{asset('assets/fuxuan.jpg')}}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8" style="max-width:234px">
                                    <div class="card-body">
                                        <h5 class="card-title">Fu Xuan <span style="color: green; font-size: 16px">- Arrived!</span></h5>
                                        <p class="card-text">Final Cost: 470 PHP
                                        <br>
                                        Time: 36 mins</p>
                                        <p class="card-text"><small class="text-body-secondary">Report User</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col text-start ms-3">
                                <h5>Trip</h5>
                            </div>
                            <div class="col text-end me-3">
                                <h5>Time</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-1">
                                <h6>From: Xianzhou Luofu</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>2:27</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>To: SM Clark</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>3:03</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col text-start ms-3">
                                <h5>Price</h5>
                            </div>
                            <div class="col text-end me-3">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-start ms-3">
                                <h6>Base Fare:</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>50</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-1">
                                <h6>Price per KM:</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>(24km)*15</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>Price per min:</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>(30min)*2</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6><strong>Total:</strong></h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>470 PHP</h6>
                            </div>
                        </div>
                    </div>
               
                    <div class="card mb-3" style="min-width: 370px;">
                        <div class="row g-0">
                          <div class="col-md-4" style="max-width:150px">
                            <img src="{{asset('assets/fuxuan.jpg')}}" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-8" style="max-width:234px">
                            <div class="card-body">
                              <h5 class="card-title">Fu Xuan</h5>
                              <p class="card-text">Destination: SM Clark</p>
                              <p class="card-text"><small class="text-body-secondary">Report User</small></p>
                            </div>
                          </div>
                        </div>
                    </div>
          
                    <div class="container mt-3">
                        <div class="row align-items-center">
                            <div class="col text-start ms-3">
                                <h6>Name: Tristan</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>Pickup: 3km</h6>
                            </div>
                            <div class="col text-end me-3">
                                <button type="button" class="btn btn-success m-0" style="font-size: 10px">Accept</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>Destination: SM Clark</h6>
                            </div>
                            <div class="col text-end me-3">
                                <button type="button" class="btn btn-danger m-0" style="font-size: 10px">Decline</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container mt-3">
                        <div class="row align-items-center">
                            <div class="col text-start ms-3">
                                <h6>Name: Nathaniel NoughFuteur</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>Pickup: 1km</h6>
                            </div>
                            <div class="col text-end me-3">
                                <button type="button" class="btn btn-success m-0" style="font-size: 10px">Accept</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3 mt-2">
                                <h6>Destination: Los Angelesk</h6>
                            </div>
                            <div class="col text-end me-3">
                                <button type="button" class="btn btn-danger m-0" style="font-size: 10px">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            

            </div>
        </div>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</script>

</body>
</html>