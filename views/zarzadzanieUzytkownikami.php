<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

  
   
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">


     



</head>
<body class="sb-nav-fixed">

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">User management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Admin Panel</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%;height:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th >Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php    foreach($wynik as $row){     ?>
                <tr>
                    <td><?php echo $row[1]?></td>
                    <td><?php echo $row[0]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo $row[2]?></td>
                    <?php if ($row[2]<>'admin'){ ?>
                    <td style ="text-align: center">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit"
                                data-user-email ="<?php echo $row[3]?>" data-user-login ="<?php echo $row[0]?>" data-user-id ="<?php echo $row[1]?>"
                                data-user-type ="<?php echo $row[2]?>"
                        >Edit</button>

                        <a href="index.php?delete=<?php echo $row[1];?>" >
                            <button type="button" class="btn btn-danger" >Delete</button>
                        </a>

                    </td>
                    <?php }else{ ?>

                    <td >

                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; YourTube 2022</div>

        </div>
    </div>
</footer>
</div>
</div>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/r-2.4.0/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/r-2.4.0/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="index.php?action=zarzadzanieUzytkownikami" class="form-horizontal">
                    <div class="form-group">
                        <label for="login" class="col-form-label col-sm-2">Login:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="login" name="login">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label col-sm-2">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <input type="text" name="id_user" value="" style="visibility: hidden">
                    <div class="form-group">

                        <label for="account-type" class="col-form-label col-sm-4">Account type:</label>
                        <div class="pb-3">
                            <div class="col-sm-10">
                                <select class="form-control" id="account-type" name="account-type">
                                    <option value="2"  >User</option>
                                    <option value="3" >Editor</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="alterUser">Save changes</button>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>


<script>

    $(document).ready(function() {
        var table =  $('#example').DataTable();
    });

    $(document).ready(function(){


        $('#edit').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var email = button.data('user-email')
            var login = button.data('user-login')
            var id = button.data('user-id')
            var type = button.data('user-type')
            var modal = $(this)


            console.log(id);
            console.log(type);

            if (type.indexOf("user") >= 0) {
                modal.find("#account-type").val(2);
            } else if (type.indexOf("edytor") >= 0) {
                modal.find("#account-type").val(3);
            }

            modal.find('input[name="login"]').attr("value", login).blur();
            modal.find('input[name="email"]').attr("value", email).blur();
            modal.find('input[name="id_user"]').attr("value", id).blur();



        })


        $('#edit').on('hide.bs.modal', function () {
            //   location.reload();
        })







    });

</script>








</body>
</html>