//<script>


document.querySelector("#send").addEventListener('click', function (){
    //nie wiem jak to
   if(document.querySelector("#title").value == ''){
       document.querySelector("#title-alert").style.display = '';
   }
   else{
       document.querySelector("#title-alert").style.display = 'none';
   }
    if(!document.querySelector("#fileChoice").checked && !document.querySelector("#fileChoice").checked){
        document.querySelector("#choice-alert").style.display = '';
    }
    else{
        document.querySelector("#choice-alert").style.display = 'none';
    }
    if(document.querySelector("#file-input").value == ''){
        document.querySelector("#file-alert").style.display = '';
    }
    else{
        document.querySelector("#file-alert").style.display = 'none';
    }
    if(document.querySelector("#adress").value == ''){
        document.querySelector("#adress-alert").style.display = '';
    }
    else{
        document.querySelector("#adress-alert").style.display = 'none';
    }
});


    document.querySelector("#filechck").addEventListener('change', function (){
        document.querySelector("#fileChoice").style.display = '';
        document.querySelector("#urlChoice").style.display = 'none';
        document.querySelector("#thumbnail-btn-div").style.display = '';
});
document.querySelector("#urlchck").addEventListener('change', function (){
    document.querySelector("#urlChoice").style.display = '';
    document.querySelector("#fileChoice").style.display = 'none';
    document.querySelector("#thumbnail-btn-div").style.display = 'none';
});

document.querySelector("#thumbnail-btn").addEventListener('click', function (){
   let tc = document.querySelector("#thumbnail-creator");
   if(tc.style.display == 'none'){
       tc.style.display = '';
   }
   else{
       tc.style.display = 'none';
   }
});


let vid = document.querySelector("#video-element"),
    canv = document.querySelector("#canvas-element"),
    canvCtx = canv.getContext("2d");
document.querySelector("#file-input").addEventListener('change', function() {
    document.querySelector("#video-element source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-input").files[0]));


    vid.load()

    //zmienić typ


});

document.querySelector("#capture").addEventListener('click', function (){
   drawThumbnail();

    let canvasData = canv.toDataURL("image/png");
    $.ajax({
        type: "POST",
        url: "/actions/addvideo.php",
        data: {
            imgBase64: canvasData
        },
        success: function (response) {
            console.log(response);
        }
    })
});


function drawThumbnail(e){
    let position = document.querySelector("#formControlRange").value,
        position2 = document.querySelector("#formControlRange2").value,
        text = document.querySelector("#thtxt").value,
        text2 = document.querySelector("#thtxt2").value;

    canvCtx.drawImage(vid,0,0,480,360);
    canvCtx.font="50px Comic Sans MS";
    canv.textAlign = "center";
    canvCtx.fillStyle = "black";
    canvCtx.fillText(text,position,50);
    canvCtx.fillText(text2,position2,350);
}


document.querySelector("#send").addEventListener('click', function (){

});


//</script>