import './bootstrap'
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

document.addEventListener("DOMContentLoaded", function() {
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 3,
        spaceBetween: 25,
        loop: false,
        centerSlide: 'true',
        fade: 'true',
        grabCursor:'true',
        pagination:{
            el:".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints:{
            0:{
                slidesPerView:1,
            },
            520: {
                slidesPerView:2,
            },
            950:{
                slidesPerView:3,
            }
        }
      });
});

document.querySelectorAll('#nav-tab>[data-bs-toggle="tab"]').forEach(el => {
    el.addEventListener('shown.bs.tab', () => {
      const target = el.getAttribute('data-bs-target')
      const scrollElem = document.querySelector(`${target} [data-bs-spy="scroll"]`)
      bootstrap.ScrollSpy.getOrCreateInstance(scrollElem).refresh()
    })
  })
  
/*axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const messages_el = document.getElementById("messages");
const username1_input = document.getElementById("username1");
const username2_input = document.getElementById("username2");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");

message_form.addEventListener('submit', function(e){
    e.preventDefault();
    let has_errors = false;
    if(username1_input.value == ""){
        alert("Please enter a username");
        has_errors = true;
    }
    if(username2_input.value == ""){
        alert("Please enter a username");
        has_errors = true;
    }
    if(message_input.value == ""){
        alert("Please enter a message");
        has_errors = true;
    }
    if(has_errors){
        return;
    }
    const options = {
        method: 'post',
        url: '/send-message',
        data: {
            username1: username1_input.value,
            username2: username2_input.value,
            message: message_input.value
        }
    }
    axios(options);
})

const channelname = `chat.${username1_input.value}.${username2_input.value}`;
console.log("Channel Name:", channelname);
window.Echo.private(channelname)
    .listen('.sendmessage', (e) => {
        messages_el.innerHTML += '<div class="message"><strong>' + e.username1 + ':</strong>' + e.message + '</div>';
        message_input.value = "";
    });

*/
    
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
