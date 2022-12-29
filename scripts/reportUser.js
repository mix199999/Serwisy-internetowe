document.getElementById("reportUser-button").addEventListener("click", function() {
    document.getElementById("popupUser").style.display = "block";
  });
  

  document.getElementById("reportUser-form").addEventListener("submit", function(event) {
    event.preventDefault(); //zeby nie byl od razu wyslany

    const reason = document.getElementById("reason").value;
    const title = document.getElementById("title").value;

    if (reason === "" || title === "") {
      console.log("Values cannot be empty!");
    } else {
      fetch("actions/reportUser.php", {
        method: "POST",
        body: JSON.stringify({
          //userId: '<?php echo $x ;?>', // zmienic x
          reason: reason,
          title: title

        })
      });
    }
    
      });