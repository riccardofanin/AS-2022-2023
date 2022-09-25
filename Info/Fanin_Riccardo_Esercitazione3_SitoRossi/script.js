var img = ["img/carousel-img/panoramica-istituto.jpg", "img/carousel-img/rossi-confindustria.jpg", "img/carousel-img/gnm-panoramica.jpg", "img/carousel-img/nicola-home.jpg", "img/carousel-img/foto-panoramica.jpg"];
var carousel_position = 0;

function change_left(){
    carousel_position--;
    if(carousel_position == -1)
    {
        carousel_position = 4;
    }
    document.getElementById("img-carousel").src = img[carousel_position];
}

function change_right(){
    carousel_position++;
    if(carousel_position == 5)
    {
        carousel_position = 0;
    }
    document.getElementById("img-carousel").src = img[carousel_position];
}

function change_radio(){
    document.getElementById("img-carousel").src = img[0];
}