<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/newUserPage.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Nowy Użytkownik</title>
</head>
<body>

<section class="vh-100 gradient-custom">




    <div class="container py-5 h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">


                            <div class="card-body p-4 p-lg-3 text-black" class="main">

                                <div class="d-flex align-items-center">
                                    <div class="pt-1 mx-auto">
                                        <span>Wybierz tagi:</span>
                                    </div>

                                </div>

                                <form id="newUser-form" style="height: 20rem;"  method="post" action = "index.php?action=newUser">
                                    <div class="h-75">
                                        <?php
                                        for($i = 0; $i < $tags_number[0][0]; $i++){
                                        ?>

                                                    <input type="checkbox" class="form-check-input" name="tag[]" id="tag<?php echo $i; ?>" value="<?php echo $all_tags[$i][0]; ?>">
                                                    <label class="me-2" for="tag<?php echo $i; ?>"> <?php echo $all_tags[$i][0]; ?></label>

                                        <?php } ?>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="pt-1 mb-2 mx-auto">
                                            <input class="btn btn-dark btn-lg btn-block mx-auto" id="btn" name="submit" type="submit" value="Zapisz Tagi">
                                        </div>
                                    </div>
                                </form>


                            </div>


                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>