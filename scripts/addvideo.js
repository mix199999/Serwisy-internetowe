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

let vid = document.querySelector("#video-element"),
    canv = document.querySelector("#canvas-element"),
    canvCtx = canv.getContext("2d");
document.querySelector("#file-input").addEventListener('change', function() {
    document.querySelector("#video-element source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-input").files[0]));


    vid.load()

    //zmienić typ



});

function drawThumbnail(e){
    canvCtx.drawImage(vid,0,0,vid.videoWidth,vid.videoHeight);
}



//</script>