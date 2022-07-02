let i = 0;
let images = [];

images[0] = 'images/Riverbank.jpg';
images[1] = 'images/Moonart.jpg';
images[2] = 'images/Snowart.jpg';

function changeImg(){
    document.slide.src = images[i];

    if(i < images.length - 1){
        i++;
    }
    else{
        i = 0;
    }

    setTimeout("changeImg()", 2000);
}

window.onload = changeImg;