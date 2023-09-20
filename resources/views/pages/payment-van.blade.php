<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - eSikleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>" />

    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="swiper-bundle.min.css"/>

    <!-- SWIPER JS -->
    <script src="swiper-bundle.min.js"></script>

</head>
<body>
    <main>
        <div class="home">
            <div class="vehicletop">
                <div class="vehicle-container" style="text-align: justify; text-justify: inter-word;">
                    <img src="assets/vehicle-van.png" alt="van" class="img-shadow">
                </div>
                <h3 class="dark-blue fw-bold ms-3 mt-4">Van</h3>
                    <p class="fs-6 ms-3 me-3">Vans are the ultimate choice for group outings and cargo needs, providing ample space for passengers or cargo. Versatile and accommodating, they are your go-to option for larger groups and all your hauling requirements.</p>

                <hr>
                    <h5 class="fw-bold dark-blue ms-3">Desination:</h5>
                    <p class="fw-bold ms-3 accent">Name of Place</p>
                <hr>

                    <h5 class="fw-bold dark-blue ms-3">Ridesharing</h5>
                    <form>
                        <label for="cash">
                            <input type="radio" id="cash" name="payment" value="cash" class="ms-3 my-1">
                            Turn on
                        </label>
                    </form>
                    <p class="fs-6 ms-3 mt-2">If turned on, your base fare will be divided in half. Although, this may come at the risk of sharing your vehicle with another user.</p>

                <hr>

                <div class="pricing">
                    <h5 class="fw-bold dark-blue ms-3">Pricing</h5>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col text-start ms-3">
                                <h6>Base Fare</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>P75.00</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3">
                                <h6>Price per KM</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>P25.00</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-start ms-3">
                                <h6>Price per min. ETA</h6>
                            </div>
                            <div class="col text-end me-3">
                                <h6>P3.00</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="paymentmthd pb-5">
                    <h5 class="fw-bold dark-blue ms-3">Payment method</h5>
                    <form>
                        <label for="cash">
                            <input type="radio" id="cash" name="payment" value="cash" class="ms-3 my-1">
                            Cash
                        </label><br>

                        <label for="cashless">
                            <input type="radio" id="cashless" name="payment" value="cashless" class="ms-3 my-1">
                            Cashless
                        </label><br>

                        <input type="submit" value="Continue" class="ms-4 mt-3 btn btn-orange text-light">
                    </form>
                </div>
            </div>
        </div>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>