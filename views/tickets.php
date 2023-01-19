<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/style/tickets.css" rel="stylesheet"/>
    <?php  echo "<script src='scripts/jquery-3.6.3.js'></script>"?>
    <title>Hello, world!</title>
</head>
<body>

<div class="col-12 p-5" >

    <!-- sidebar -->
    <div class="row">
        <div class="col-12" >
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
        </ul>
    </div>
</div>

<div class="modal" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id ="reqID"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div  class="modal-body modal-body-scroll"id="chatText"  style=" max-height: 50vh; overflow-y: scroll;" >

                </div>

                <form method="post" action = "index.php?action=tickets">
                    <div class="form-group">
                        <textarea class="form-control" id="comment" rows="3" name="messageText"></textarea>
                    </div>
                    <input type="text" name="senderID" value="<?php echo $_SESSION['id_user']?>" style="visibility: hidden">
                    <input type="text" id="case_id" name="caseID" value="$row[0]" style="visibility: hidden">
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success float-end"name="sendMessage" value="accept">Send</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    </div>

<!-- MODAL -->


<script>
    $("#myList").on("click", ".list-group-item-action", function() {
        var title = $(this).data("title");
        $("#reqID").text("CaseTitle: " + title);
});
</script>





    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

    <script>

        $(document).ready(function(){
            $('#chatModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var rootPath = "<?php echo str_replace('\\', '/', dirname(dirname(__FILE__))) ?>";
                
                var rootPath = rootPath.substr(rootPath.lastIndexOf('/') + 1);
               
                var rootPath = 'http://localhost/' + rootPath + '/scripts/';
                    

                
                var ticketId = button.data('id-case');
                var loggedUser = button.data('logged-user');
                var modal = $(this);
                
                $('#case_id').val(ticketId);

             console.log(rootPath);
                if(ticketId != undefined)
                {
                   
                   
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

        })
    </script>




</div>



<?php


?>














<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 Option 2: Separate Popper and Bootstrap JS -->



</body>
</html>