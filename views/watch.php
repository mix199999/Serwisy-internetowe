<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/scripts/jquery-3.6.3.js"></script>

    <title>Title</title>
</head>

<body style="background-color: <?php echo $user->GetColor(); ?>">
  <div class="container">
      <div class="row mt-5">
          <div class="col-md-12">
            <?php
            if($videoExist == true)         //sprawdzamy czy film wogole istnieje
            {              
                if($userRole == 1) echo "<div class='mt-3 text-center mb-5'><a href='index.php?action=videosAdministration'> <button type='button' class='btn btn-primary'>Wróć do zarządzania filmami</button></a></div>";       //jezeli admin to dodajemy mu przycisk co przenosi do zarzadzania uzytkownikami
                
                if(!isset($_GET['v']))      //jezeli w linku nie jest ustawiony parametr v
                {       
                    if($urlTable[$currentIndex]['extension'] == 'url') // pobieramy filmy uzytkownika z jego tagami i wyswietlamy tutaj film o rozszerzeniu URL czyli youtube
                    {
                        echo "<iframe width='1255' height='753' src='" . Video::youtube_link_to_embed($urlTable[$currentIndex]['url']) . "' title='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                    } 
                    else //jezeli nie jest to rozszerzenie youtube to wyswietlamy zwykly
                    {
                        echo "<video width='1255' height='753' controls> <source src='{$urlTable[$currentIndex]['url']}' type='video/{$urlTable[$currentIndex]['extension']}'> </video>";   
                    }  
                    echo "<div class='d-flex align-items-center'><div class='col-md-11 mb-2'><h1 class='mt-3 font-weight-bold'>".$urlTable[$currentIndex]['title']."</h1></div><button id='report-button' class='btn btn-danger ml-auto' data-bs-toggle='modal' data-bs-target='#report'>Zgłoś</button></div>"; //tytul filmu oraz reportbutton filmu
                    echo "<div class='col-md-12 mb-2'><h3 class='mt-3'> <a href='index.php?action=userChannel&channel=".$editorName."' style='text-decoration:none; color:rgb(0, 153, 153);'> ".$editorName." </a> </h3></div>";     //wyswietlenie edytora  wraz z linkiem do niego    
                    ?>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12 text-center mt-3">
              <?php            
                    if ($currentIndex > 0)  // sprawdź, czy istnieje poprzedni film - wyswietlenie przeycisku przejscia do poprzedniego filmu
                    {
                        echo "<a href='index.php?action=watch&index=" . ($currentIndex - 1) . "'><button class='btn btn-secondary mx-2'>Poprzedni</button></a>";
                    }
                    if ($currentIndex < count($urlTable) - 1)   // sprawdź, czy istnieje następny film - wyswietlenie przycisku przejscia do kolejnego filmu
                    {
                        echo "<a href='index.php?action=watch&index=" . ($currentIndex + 1) . "'><button class='btn btn-secondary mx-2'>Następny</button></a>";
                    }            
                }

                else    //jezeli v jest ustawione znaczy ze wyswietlamy tylko jeden film konkretny bez przyciskow dalej wczesniej
                {
                    if($oneVideoUrl['extension'] == 'url')  //jezeli jego rozszerzenie to youtube wyswietlamy youtube
                    {
                        echo "<iframe width='1255' height='753' src='" . Video::youtube_link_to_embed($oneVideoUrl['url']) . "' title='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                    } 
                    else //jezeli to nie youtube to wyswietlamy jak normalny film
                    {
                        echo "<video width='1255' height='753' controls> <source src='{$oneVideoUrl['url']}' type='video/{$oneVideoUrl['extension']}'> </video>";   
                    }
                    echo "<div class='d-flex align-items-center'><div class='col-md-11 mb-2'><h1 class='mt-3 font-weight-bold'>".$oneVideoUrl['title']."</h1></div><button id='report-button' class='btn btn-danger ml-auto' data-bs-toggle='modal' data-bs-target='#report'>Zgłoś</button></div>"; //tytul filmu i przcisk report
                    echo "<div class='col-md-12 mb-2'><h3 class='mt-3'> <a href='index.php?action=userChannel&channel=".$editorId."' style='text-decoration:none; color:rgb(0, 153, 153)'> ".$editorId." </a> </h3></div>";         //edytor i przejscie do niego
                }
            }

            else  //jezeli film nie istnieje wyswietlamy komunikat ze zdjeciem o jego braku
            {
              
                echo "<div class='col-md-12 text-center mt-3'><img src='icons/errorVideo.png' alt='error' width='300' height='300'></div>";
                echo "<div class='col-md-12 text-center mt-3'><h1 class='mt-3 font-weight-bold'>Ten film nie istnieje</h1></div>";
                //może chcesz wybrać ponownie tagi?
                //stwórz przycisk  przekierowuje do strony newUser.php 
                echo "<div class='col-md-12 text-center mt-3'><a href='index.php?action=newUser'><button class='btn btn-secondary mx-2'>Wybierz ponownie tagi</button></a></div>";


            
               
            }
            ?>
      </div>
  </div>

  
  
  <!-- Modal Change_Acc_Type -->
  <div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zgłoś video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method = 'post' id="report-form">
                    <label  for="reason">Wybierz przyczyne prośby:</label><br>
                    <div><input type="checkbox" id="1" name="choice" value="1">
                        <label for="1">Treści o charakterze seksualnym</label></div>
                    
                    <div><input type="checkbox" id="2" name="choice" value="2">
                        <label for="2">Treści przedstawiające przemoc lub budzące odrazę</label></div>
                    
                    <div><input type="checkbox" id="3" name="choice" value="3">
                        <label for="3">Treści krzywdzące lub szerzące nienawiść</label></div>
                    
                    <div><input type="checkbox" id="4" name="choice" value="4">
                        <label for="4">Nękanie lub dokuczanie</label></div>
                    
                    <div><input type="checkbox" id="5" name="choice" value="5">
                        <label for="5">Sceny szkodliwe lub niebezpieczne</label></div>
                    
                    <div><input type="checkbox" id="6" name="choice" value="6">
                        <label for="6">Nieprawdziwe informacje</label></div>
                    
                    <div><input type="checkbox" id="7" name="choice" value="7">
                        <label for="7">Wykorzystywanie dzieci</label></div>
                    
                    <div><input type="checkbox" id="8" name="choice" value="8">
                        <label for="8">Propagowanie terroryzmu</label></div>
                    
                    <div><input type="checkbox" id="9" name="choice" value="9">
                        <label for="9">Spam lub treści wprowadzające w błąd</label></div>
                    
                    <div><input type="checkbox" id="10" name="choice" value="10">
                        <label for="10">Naruszenie moich praw</label></div>
                    
                    <div><input type="checkbox" id="11" name="choice" value="11">
                        <label for="11">Problem z napisami</label></div>
                        

                    <label  for="reason">Dodatkowe uwagi:</label><br>
                    <input  class="form-control"type="text" id="reason" name="reason"><br>
                    <input type="text" id="idVideo" name="idVideo" value="<?php echo $id_video_value ?>"style="visibility:hidden"> 
                    <input type="text" id="id_user" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"style="visibility:hidden">
                    <button type="submit" name="reportButton" class="btn btn-primary w-22">Wyślij</button>
                </form>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

<script>

$(document).ready(function(){

  document.getElementById("report-form").addEventListener("submit", function(event) {
        event.preventDefault(); //zeby nie byl od razu wyslany

        let reason = document.getElementById("reason").value;
        let choice = [];
        let id_user = document.getElementById("id_user").value;
        let idVideo= document.getElementById("idVideo").value;

        if(document.getElementById('1').checked) {
            choice.push(1);
        } 
        if(document.getElementById('2').checked) {
            choice.push(2);
        }
        if(document.getElementById('3').checked) {
            choice.push(3);
        }
        if(document.getElementById('4').checked) {
            choice.push(4);
        }
        if(document.getElementById('5').checked) {
            choice.push(5);
        }
        if(document.getElementById('6').checked) {
            choice.push(6);
        }
        if(document.getElementById('7').checked) {
            choice.push(7);
        }
        if(document.getElementById('8').checked) {
            choice.push(8);
        }
        if(document.getElementById('9').checked) {
            choice.push(9);
        }
        if(document.getElementById('10').checked) {
            choice.push(10);
        }
        if(document.getElementById('11').checked) {
            choice.push(11);
        }

        if (reason == "") {
          window.alert("Values cannot be empty!");
        } else {

            var rootPath = "<?php echo str_replace('\\', '/', dirname(dirname(__FILE__))) ?>";                
            var rootPath = rootPath.substr(rootPath.lastIndexOf('/') + 1);               
            var rootPath = 'http://localhost/' + rootPath + '/scripts/';
            $.ajax({  
            type: 'POST',  
            url: rootPath+'reportVideo.php', 
            data: {reason: reason, choice:choice, id_user: id_user, idVideo:idVideo},
            success: function(response) {
                console.log(response);
                location.reload();

        }
    });
        }
       
        
          });


});

</script>

</body>
</html>