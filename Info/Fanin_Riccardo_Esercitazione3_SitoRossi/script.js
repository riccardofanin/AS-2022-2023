var img = ["img/carousel-img/panoramica-istituto.jpg", "img/carousel-img/rossi-confindustria.jpg", "img/carousel-img/gnm-panoramica.jpg", "img/carousel-img/nicola-home.jpg", "img/carousel-img/foto-panoramica.jpg"];
var carousel_position = 0;
var prec_id = "radio-0";

function change_left(){
    carousel_position--;
    if(carousel_position == -1)
    {
        carousel_position = 4;
    }
    document.getElementById("img-carousel").src = img[carousel_position];
    document.getElementById("radio-"+carousel_position).checked = true; 
}

function change_right(){
    carousel_position++;
    if(carousel_position == 5)
    {
        carousel_position = 0;
    }
    document.getElementById("img-carousel").src = img[carousel_position];
    document.getElementById("radio-"+carousel_position).checked = true; 
}

function change_radio(btn_id){
    document.getElementById(prec_id).checked = false; 
    var num = parseInt(btn_id.id.slice(-1));
    document.getElementById("img-carousel").src = img[num];
    prec_id = btn_id.id;
}

function timer_foto() {
    if (++carousel_position >= img.length)
        carousel_position = 0;

    document.getElementById("img-carousel").src = img[carousel_position];
    document.getElementById("radio-"+carousel_position).checked = true; 
}

setInterval(timer_foto, 5000);