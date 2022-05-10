var video = document.getElementById("VideoReplay");
var vid1 = document.getElementById("myvideo1");
var vid2 = document.getElementById("myvideo2");
var vid3 = document.getElementById("myvideo3");


// video.addEventListener("canplay", function() {
//     setTimeout(function() {
//         video.pause();
//     }, 5000);
// });

function mouseOver(){

    document.getElementById("Rech").style.display="block";
    document.getElementById("BtnRech").style.display="block";
    document.getElementById("iconrech").style.display="none";
}
function mouseOut(){
    document.getElementById("Rech").style.display="none";
    document.getElementById("BtnRech").style.display="none";
    document.getElementById("iconrech").style.display="block";



}

function mouseOverVid1(){

   vid1.autoplay = true;
    vid1.load();
}
function mouseOutVid1(){

   vid1.autoplay = false;
    vid1.load();
}
function mouseOverVid2(){

    vid2.autoplay = true;
    vid2.load();
}
function mouseOutVid2(){

    vid2.autoplay = false;
    vid2.load();
}
function mouseOverVid3(){

    vid3.autoplay = true;
    vid3.load();
}
function mouseOutVid3(){

    vid3.autoplay = false;
    vid3.load();
}
var mybutton = document.getElementById("toppage");


window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 800 || document.documentElement.scrollTop > 800) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}


function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}