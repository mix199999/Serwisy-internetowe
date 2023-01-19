<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="/style/tickets.css" rel="stylesheet"/>
  <script src="/scripts/jquery-3.6.3.js"></script>
  <title>Hello, world!</title>
</head>
<body>

<div class="col-12 vh-100 p-5">


  <div class="row h-100">

      <?php if($result == 0): ?>
    <div class="col-12 d-flex align-items-center justify-content-center">
      <button class="btn btn-success btn-lg"   data-toggle="modal" data-target="#newTicket">Create New Ticket</button>
      <?php else: ?>


      <ul class="list-group fa-padding">
                <div class="list-group" id="myList" role="tablist">
                <li class="list-group-item list-group-item-primary"><h5 style="text-align: center" >Tickets</h5></li>
                <?php
                foreach($result as $row)
                {
                    ?>
                    <li class="list-group-item list-group-item-action" data-toggle="modal" data-target="#chatModal" id="case"  data-toggle="list" role="tab" data-id-case="<?php echo $row[0]?>" data-logged-user = "<?php echo $_SESSION['id_user']?>" data-title="<?php echo $row[4]?>">
                        <?php
                        echo  '<span class="number pull-right"> <h5>Case ID: #'.$row[0].'</h5></span>';
                        echo '<p class="info"> <h6> Case Title: '.$row[4].'</h6></p>';
                        if($row[3] == 'technical')
                        echo '<span class="badge bg-success">'.$row[3].'</span>';
                        else if($row[3] == 'other')
                        echo '<span class="badge bg-danger">'.$row[3].'</span>';
                        else if($row[3] == 'account')
                        echo '<span class="badge bg-info">'.$row[3].'</span>';
                        else if($row[3] == 'payment')
                        echo '<span class="badge bg-warning">'.$row[3].'</span>';
                        echo '</li>';
                }
          ?>
        </div>
        <li class="list-group-item list-group-item-action text-center" >
                <button class="btn btn-success btn-lg "   data-toggle="modal" data-target="#newTicket">Create New Ticket</button>
          </li>


      </ul>
      <?php endif; ?>
    </div>
  </div>
</div>

  <div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id ="reqID">Case Title: <?php echo $row[4]?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div  class="modal-body modal-body-scroll"id="chatText"  style=" max-height: 50vh; overflow-y: scroll;" >

        </div>

        <form method="post" action = "index.php?action=userChatPage">
          <div class="form-group">
            <textarea class="form-control" id="comment" rows="3" name="messageText"></textarea>
          </div>
          <input type="text" name="senderID" value="<?php echo $_SESSION['id_user']?>" style="visibility: hidden">
          <input type="text" name="caseID" id="caseID" style="visibility: hidden">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success float-end"name="sendMessage" value="accept">Send</button>
          </div>
        </form>

      </div>
    </div>
  </div>



<script>
    $("#myList").on("click", ".list-group-item-action", function() {
        var title = $(this).data("title");
        $("#reqID").text("CaseTitle: " + title);
});
</script>

<script>
$("#myList").on("click", ".list-group-item-action", function() {
        var id = $(this).data("id-case");
        $("#caseID").val(id); //ustawienie wartości pola na ID ticketa
    });
</script>





<!-- MODAL -->

<div class="modal" id="newTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >New Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div  class="modal-body modal-body-scroll" >
          <form method="post" action = "index.php?action=userChatPage">
            <div class="form-group">
              <label for="ticketTitle" class="pt-3">Title</label>
              <input type="text" class="form-control" name="ticketTitle" id="ticketTitle" >
              <label for="exampleFormControlSelect1" class="pt-3">Type</label>
              <select class="form-control" id="exampleFormControlSelect1" name="ticketType">
                <option value="technical">Technical</option>
                <option value="other">Other</option>
                <option value="account">Account</option>
                <option value="payment">Payment</option>
              </select>
              <label for="ticketMessage" class="pt-3">Describe your problem </label>
              <textarea class="form-control"  rows="3" name="ticketMessage" id="ticketMessage"></textarea>
            </div>
            <input type="text" name="senderID" value="<?php echo $_SESSION['id_user']?>" style="visibility: hidden">

            <div class="modal-footer">
              
              <button type="submit" class="btn btn-success float-end"name="sendTicket" value="accept">Send</button>
            </div>
          </form>

        </div>
      </div>
    </div>






<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>


  <style>
    #chatText{
      overflow-y: scroll;
    }
  </style>


<script>

  $(document).ready(function(){


    var rootPath = "<?php echo str_replace('\\', '/', dirname(dirname(__FILE__))) ?>";
                
                var rootPath = rootPath.substr(rootPath.lastIndexOf('/') + 1);
               
                var rootPath = 'http://localhost/' + rootPath + '/scripts/';



    $('#chatModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);

      var ticketId = button.data('id-case');
      var loggedUser =  <?php echo $_SESSION["id_user"];  ?>;
      console.log("user: "+loggedUser);

      console.log("ticketId: "+ticketId);
      console.log("loggedUser: "+loggedUser);


      if(ticketId != undefined)
      {
        console.log(ticketId);

        $.ajax({
          url: rootPath+'messages.php',           
          type: 'POST',
          data: {
            idCase: ticketId,
            idUser: loggedUser
          },
          dataType: 'json',
          success: function(response) {

            $('#chatText').html('');

            $.each(response, function(index, message) {
              $('#chatText').append(message);
            });
            $('#chatText').append()
          }
        });

      }


    })

   $('#newTicket').on('hidden.bs.modal', function (e) {
     location.reload();
  })
  })




</script>



</div>



<?php


?>


</body>
</html>