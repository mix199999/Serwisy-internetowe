<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>support tickets</title>
    <link href="style/userRequestsStyle" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>



<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group" id="list-tab" role="tablist">
                    <div class="grid-body">
                        <h2>Requests</h2>
                        <hr>
                        <div class="padding"></div>
                        <div class="row">
                            <ul class="list-group fa-padding">
                                <?php foreach($result as $row){ ?>
                                <li class="list-group-item list-group-item-action" data-toggle="modal" data-target="#issue" data-user-message="<?php echo $row[3]?>" data-user-request-id="<?php echo $row[0]?>" data-toggle="list" role="tab">                                    <div class="media">
                                        <div class="media-body">

                                            <strong><?php echo $row[5]?></strong>
                                            <?php
                                            if($row[2] == true)
                                            {echo '<span class="badge bg-success" id='."$row[0]".'>Open</span>';}
                                            else
                                            {echo '<span class="badge bg-danger">Closed</span>';}

                                            ?>



                                            <span class="number pull-right" ># <?php echo $row[0]?></span>
                                            <p class="info">Created by <a href="#"><?php echo User::getUserLogin($row[1], $db);?></a> </p>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</section>
</div>

<!-- Modal -->
<div class="modal fade" id="issue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id ="reqID"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p id="userMessage"></p>

                <form method="post" action = "index.php?action=userRequest">

                    <input type="text" name="requestID" value="" style="visibility: hidden">
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" id="comment" rows="3" name="adminComment"></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger float-start" name="send" value="reject">Reject</button>
                    <button type="submit" class="btn btn-success float-end"name="send" value="accept">Accept</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>


<script>

    $(document).ready(function(){
        $('#issue').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userMessage = button.data('user-message');
            var requestID = button.data('user-request-id');
            var modal = $(this);
            modal.find('.modal-body #userMessage').text(userMessage);
            document.querySelector('#reqID').textContent ='User request #'+ requestID;
            modal.find('input[name="requestID"]').attr("value", requestID).blur();
        })


        // $('#issue').on('hidden.bs.modal', function (e) 
        // {
        //     var requestID = $('input[name="requestID"]').val();
        //     console.log(requestID);
            
        //     $('#'+requestID).attr('class', 'badge bg-danger');
           
        //     $('#'+requestID).text('Closed');
            
        // });




    })





</script>



<!--Prrrr -->
</body>
</html>