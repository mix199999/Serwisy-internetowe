document.getElementById("changePrivil-button").addEventListener("click", function() {
    document.getElementById("popupPrivil").style.display = "block";
  });
  
  document.getElementById("changePrivil-form").addEventListener("submit", function(event) {
    event.preventDefault(); //zeby nie byl od razu wyslany

    const reason = document.getElementById("reason").value;
    const title = document.getElementById("title").value;
    
    var formData = new FormData();
    formData.append(reason, title);

    if (reason === "" || title === "") {
      window.alert("Values cannot be empty!");
    } else {
      fetch("actions/changePrivil.php", {
        method: "POST",
        body: FormData
        })
        .then(function (response) {
          return response.text();
        })
        .then(function (body) {
          console.log(body);
      });
    }
    
      });