const calculateFares = function(vehicleType, distanceTravelled, ETA){
    let baseFine = 50;
    let perKM;
    let perETA;
    let fine;
    vehicleType = "SEDAN"
    switch(vehicleType){
        case "SEDAN":
            baseFine = baseFine;
            perKM = 15;
            perETA = 2;
            break;
        case "SUV":
            baseFine += 10;
            perKM = 20;
            perETA = 2.5;

            break;
        case "VAN":
            baseFine += 25;
            perKM = 25;
            perETA = 3;

            break;
        case "BUS":
            console.log("oh boy");
            break;
        default:
            console.log("????")
    }
     return {
        price: fine,
     }
}
console.log(calculateFares());