//<script>
    const file = document.getElementById('filechck');
    const url = document.getElementById('urlchck');
    //const send = document.getElementById('send');
    file.addEventListener('change', change);
    url.addEventListener('change', change);
    //send.addEventListener('change', display);
    let option = "file" ;

    function change(e) {
        if (document.getElementById('option')) {
            document.getElementById('option').remove();
        }
        option = this.value;
        display();
    }
    function display(e){
        if(option == "file"){
            document.getElementById('type').insertAdjacentHTML("afterend", "<span class= 'video_form' id='option'><label for=''>Wybierz plik:</label><input type='file' name='video' accept='video/*'><br></span>");
        }
        else{
            document.getElementById('type').insertAdjacentHTML("afterend", "<span class= 'video_form' id='option'><label for=''>Podaj adres:</label><input type='text' name='address' value=''><br></span>");
        }
    }
    display();
    //tutaj muszę naprawić bo jjak się kliknie sublit to bedzie zawsze file
//</script>