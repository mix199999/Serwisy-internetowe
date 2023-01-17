<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Ustawienia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/scripts/jquery-3.6.3.js"></script>
</head>
<body style="background-color: <?php echo $user->GetColor(); ?>">



<style>
    .list-group-item {
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>
  



<div class="col-12 vh-100 p-5">
    <div class="row col-12 h-100 d-flex justify-content-center align-items-start">
            <ul class="list-group">
                <li class="list-group-item">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#passwordChangeModal">
                    Zmień hasło
                </button>
                </li>
                <li class="list-group-item">
                    <form  method="POST" action="index.php?action=ustawienia">
                        <input type="submit" name="Colorsubmit" value="Zapisz wybrany kolor" id="button2" class="btn btn-secondary m-3 px-3" >
                        <br>
                        <input type="color" class="btn btn-outline-secondary m-3 px-3" id="favcolor" name="favcolor" value="#ff0000">
                    </form>
                </li>
                <li class="list-group-item">
                    <a href="index.php?action=userChatPage" id="button3" class="btn btn-secondary m-3 px-3" >Przejdź do czatu</a>
                </li>
                <li class="list-group-item">
                    <button id="changePrivil-button" class="btn btn-secondary m-3 px-3" data-bs-toggle="modal" data-bs-target="#edit">Poproś o zmiane uprawnień konta</button>
                </li>
            </ul>

    </div>
</div>




<!-- Modal Change_Acc_Type -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Poproś o zmiane uprawnień konta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method = 'post' id="changePrivil-form">
                        <label  for="title3">Tytuł zgłoszenia:</label><br>
                        <input class="form-control" type="text" id="title3" name="title3"><br>
                        <label  for="reason3">Podaj przyczyne prośby:</label><br>
                        <input  class="form-control"type="text" id="reason3" name="reason3"><br>
                        <input type="text" id="id_user3" name="id_user3" value="<?php echo $_SESSION['id_user'] ?>"style="visibility:hidden">
                        <button id="button" type="submit" name="changePrivilButton" class="btn btn-primary w-22">Wyślij</button>
                    </form>

                </div>

            </div>
        </div>
    </div>



<!-- Modal Change password-->
<div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordChangeModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method = 'GET' action="index.php?action=ustawienia">
        <div class="modal-body">
          <div class="form-group">
            <label for="currentPassword">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter your current password">
          </div>
          <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter your new password">
          </div>
          <div class="form-group">
            <label for="confirmNewPassword">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm your new password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="changePassword" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>









<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

    <script>

$(document).ready(function(){

    var rootPath = "<?php echo str_replace('\\', '/', dirname(dirname(__FILE__))) ?>";
                
                var rootPath = rootPath.substr(rootPath.lastIndexOf('/') + 1);
               
                var rootPath = 'http://localhost/' + rootPath + '/scripts/';

  document.getElementById("changePrivil-form").addEventListener("submit", function(event) {
        event.preventDefault(); //zeby nie byl od razu wyslany
    
        var reason3 = document.getElementById("reason3").value;
        var title3 = document.getElementById("title3").value;
        var id_user3 = document.getElementById("id_user3").value;
    
        if (reason3 == "" || title3 == "") {
          window.alert("Values cannot be empty!");
        } else {
            $.ajax({  
            type: 'POST',  
            url: rootPath+'changePrivil.php', 
            data: {reason3: reason3, title3: title3, id_user3: id_user3},
            success: function(response) {
                console.log(response);
                location.reload();
        }
    });
        }
        
          });


    var maxWidth = 0;

    $('.btn').each(function(){
        if($(this).width() > maxWidth){
            maxWidth = $(this).width();
        }
    });

    $('.btn').width(maxWidth);




});



    </script>




</body>
</html>