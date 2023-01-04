//<script>
    const file = document.getElementById('filechck');
    const url = document.getElementById('urlchck');
    const send = document.getElementById('send');
    file.addEventListener('change', change);
    url.addEventListener('change', change);
    send.addEventListener('change', remove);
    let option = "file" ;

    function change(e) {
        remove();
        option = this.value;
        display();
    }
    function display(e){
        if(option == "file"){
            document.getElementById('type').insertAdjacentHTML("afterend", "<span class= 'video_form' id='option'><label for=''>Wybierz plik:</label><input type='file' name='video' accept='video/*'><br></span>");
        }
        else{
            document.getElementById('type').insertAdjacentHTML("afterend", "<span class= 'video_form' id='option'><label for=''>Podaj adres:</label><input type='url' name='address' value=''><br></span>");
        }
    }
    function remove(e){
        if (document.getElementById('option')) {
            document.getElementById('option').remove();
            option = null;
        }
    }

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
    canvCtx.fillText(text2,position2,320);
}



//</script>