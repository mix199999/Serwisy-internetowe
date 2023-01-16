<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="scripts/adminNav.js"></script>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Editor</title>
  
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>




    <?php 
    echo "<link href='styles/zarzadzanieUzytkownikami.css' rel='stylesheet' />";
   
    echo "<script src='scripts/jquery-3.6.3.js'></script>"
   

    ?>
  </head>
  <body>

    <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
          <!-- Navbar Brand-->
          <a class="navbar-brand ps-3">Editor panel</a>
          <!-- Sidebar Toggle-->
          <button onclick="hideSideBar()" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
          <!-- Navbar Search
          <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
              <div class="input-group">
                  <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                  <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
              </div>
          </form> -->
          <!-- Navbar-->
          <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
              <div class="input-group">
                  <button type="button" class="btn btn-danger"><a href="./index.php?action=wyloguj">Logout</a></button>
              </div>
          </form>
      
      </nav>
      <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
              <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                  <div class="sb-sidenav-menu">
                      <div class="nav">
                          <div class="sb-sidenav-menu-heading"><a href="./index.php?action=addvideo" class="nav-link"> Add video</a></div>  
                          <div class="sb-sidenav-menu-heading"><a href="./index.php?action=reports" class="nav-link">Reports</a></div>
                          <div class="sb-sidenav-menu-heading"><a href="./index.php?action=ustawienia" class="nav-link">Ustawienia</a></div>

              </nav>
          </div>
          <div id="layoutSidenav_content" >
      



   
    
    

  </body>
</html>