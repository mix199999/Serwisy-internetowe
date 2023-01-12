//<script>

document.querySelector("#displayRange").addEventListener("change" ,function (){
    let displayNumber = document.querySelector("#displayRange").value;
    if(displayNumber == 8){
        displayNumber = 12;
    }
    let videos = document.querySelectorAll("[id^='video']");
    let newClass = "col-md-" + displayNumber;
    for (let i=0; i < videos.length; i++){
        videos[i].className = newClass;
    }
});

//</script>