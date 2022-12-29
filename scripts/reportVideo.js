document.getElementById("reportVideo-button").addEventListener("click", function() {
    document.getElementById("popupVideo").style.display = "block";
  });
  

  document.getElementById("reportVideo-form").addEventListener("submit", function(event) {
    event.preventDefault(); //zeby nie byl od razu wyslany

    const reason = document.getElementById("reason").value;
    const title = document.getElementById("title").value;
    
    if (reason === "" || title === "") {
      window.alert("Values cannot be empty!");
    } else {
      fetch("actions/reportVideo.php", {
        method: "POST",
        body: JSON.stringify({
          //videoId: '<?php echo $x ;?>', // zmienic x
          //userId: '<?php echo $y ;?>',
          reason: reason,
          title: title

        })
      });
    }
    
      });
  
  