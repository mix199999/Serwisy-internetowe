<!DOCTYPE html>
<html lang="en">
<head>
    <script src="scripts/adminNav.js"></script>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User</title>
    <link href="style/adminStyles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    
    echo "<link href='styles/zarzadzanieUzytkownikami.css' rel='stylesheet' />";
   
   echo "<script src='scripts/jquery-3.6.3.js'></script>"
</head>
<body>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a href="index.php?action=StartPage" class="navbar-brand ps-3">User panel</a>
            <!-- Sidebar Toggle-->
            <button onclick="hideSideBar()" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
<!--
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
-->

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" id="search-form" method="post" action = "index.php?action=search">
        <div class="input-group">
            <?php if(!isset($search)) {$search = '';}?>
                  <input id="search-input" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="search" value="<?php echo $search ?>">
                    <button class="btn btn-primary" id="send" type="submit"><i class="fas fa-search"></i></button>
        </div>
            <div style="display:none;" id="search-tag1" class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" checked="checked" id="title" name="title" value="checked" <?php if(isset($_POST['title'])) echo "checked"?>>
                <label class="form-check-label text-light" for="title">Po Tytule</label>
  
            </div>
            <div style="display:none;" id="search-tag2" class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tags" name="tags" value="checked" <?php if(isset($_POST['tags'])) echo "checked"?>>
                <label class="form-check-label text-light" for="tags">Po Tagach</label>
            </div>
            <div style="display:none;" id="search-tag3" class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="user" name="user" value="checked" <?php if(isset($_POST['user'])) echo "checked"?>>
                <label class="form-check-label text-light" for="user">Po Uzytkowniku</label>
            </div>
    </form>
  </div>
  

            <!-- Navbar-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <button type="button" class="btn-danger"><a href="./index.php?action=wyloguj">Logout</a></button>
                </div>
            </form>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <div class="sb-sidenav-menu-heading"><a href="./index.php?action=watch" class="nav-link">Oglądaj filmy</a></div>
                            <div class="sb-sidenav-menu-heading"><a href="./index.php?action=ustawienia" class="nav-link">Ustawienia</a></div>
                          <?php
                          require_once USER_CLASS_PATH;
                          require_once CONN_PATH;
                          require_once VIDEO_CLASS_PATH;
                          $database = new Database();
                          $db = $database->getConnection();
                            $userId = $_SESSION['id_user'];
                                //go to userChannel.php with id of logged user
                                $login = User::getUserLogin($userId, $db);
                                if(Video::getVideosByLogin($login,$db) != false)
                                echo "<div class='sb-sidenav-menu-heading'><a href='index.php?action=userChannel&channel=".$login."' class='nav-link'>Twoje konto</a></div>";
                          ?>

                          




                </nav>
            </div>
            <div id="layoutSidenav_content" >

<script>
        $(document).ready(function(){
            $('#search-input').click(function(){
                document.getElementById("search-tag1").style.display = "inline-block	";
                document.getElementById("search-tag2").style.display = "inline-block	";
                document.getElementById("search-tag3").style.display = "inline-block	";
            });


            
        })

</script>
</body>
</html>
