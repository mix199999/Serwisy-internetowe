<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo _ROOT_PATH.DIRECTORY_SEPARATOR .'styles'.DIRECTORY_SEPARATOR.'logowanie'.'.css' ?>">

    <?php 
    echo "<link href='styles/"."logowanie.css' rel='stylesheet' />"; 
   
    echo "<script src='scripts/jquery-3.6.3.js'></script>";
   

   
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Logowanie</title>
</head>
<body>
<section class="vh-100 gradient-custom">

    <div class="container py-5 h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://i.postimg.cc/gJyj0yTG/finalne.webp"
                                 alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black" class="main">


                                <div class="d-grid gap-4 col-12 mx-auto">
                                    <button id="LoginButton" onclick="log()" class="btn btn-dark btn-lg btn-block" type="button" >Sign in</button>

                                    <button id="RegisterButton" onclick="reg()" class="btn btn-dark btn-lg btn-block" type="button">Sign up</button>
                                </div>
                                <form id="login-form" method="post" action = "index.php?action=logowanie">

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" ></i>

                                    </div>



                                    <div id="login">
                                        <input type="text" name = "login" id="log" class="form-control form-control-lg" />
                                        <label class="form-label" >Login</label>
                                    </div>


                                    <div id="email">
                                        <input type="email"  class="form-control form-control-lg" onkeyup="emailcheck()" name="email" id="em"/>
                                        <label class="form-label" >Email address</label>
                                    </div>

                                    <div id = "pass">
                                        <input type="password" onkeyup="passwordcheck()" name="passwd" id="passw" class="form-control form-control-lg" />
                                        <label class="form-label" for="passw">Password</label>
                                    </div>
                                    <div id="typkonta">

                                        <select class="form-select form-select-lg mb-3" name="id_priv" >
                                            <option value="2" selected>user</option>
                                            <option value="3">edytor</option>
                                        </select>
                                        <label class="form-label" for="typkonta">Account type</label>
                                    </div>



                                    <div class="pt-1 mb-4">


                                        <div class="d-grid gap-4 col-12 mx-auto">
                                            <input class="btn btn-dark btn-lg btn-block" id="subButton" type="submit" value="Login">
                                        </div>

                                    </div>
                                </form>
                                <label id="blad" class="form-label" for="typkonta">Wrong password</label>
                                <label id = "description" class="form-label" for="typkonta">Password must be at least 8 characters long and must contain letters in mixed case and digits</label>

                                <label class="form-label" id="blademail">Wrong email address</label>
                                <p  id="acc" class="mb-5 pb-lg-2" style="color: #393f81;"><a id="hacc" onclick="log()">Have an account? Sign in</a></p>
                                <p  id="noacc" class="mb-5 pb-lg-2" style="color: #393f81;"><a id="dhacc" onclick="reg()" >Don't have an account? Sign up</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo "<script src='scripts/"."logowanie.js' type='text/javascript'></script>"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>