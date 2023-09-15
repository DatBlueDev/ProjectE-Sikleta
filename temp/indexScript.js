// Simple Client-Side javascript for "scene changes" in HTML Log-in page
const indexPage = document.getElementById("main");
const loginPage = document.getElementById("LoginScene");
const registerPage = document.getElementById("RegisterScene");

function loginSelect(){
    loginPage.style.display = "block";
    indexPage.style.display = "none";

}
function registerSelect(){
    registerPage.style.display = "block";
    indexPage.style.display = "none";

}
function indexSelect(){
    loginPage.style.display = "none";
    registerPage.style.display = "none";
    indexPage.style.display = "block";


}