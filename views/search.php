<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

<?php  echo "<script src='scripts/jquery-3.6.3.js'></script>"?>
</head>
<body>

<div class="container-fluid">
    <div class="row d-none d-md-block">
        <input type="range" class="form-control-range" id="displayRange" min="2" max="8" step="2" value="2">
    </div>
    <div class="row">
        <?php
            $vn = 1;
            foreach ($resultsObjects as $result){
                echo "<div class='col-md-2' id='video".$vn."' style='display: '>";
                echo    "<div class='card m-1 bg-dark border border-dark border-5'>";
                $src = "videos/thumbnails/" . $result->getIDvideo() . ".png";
                if(!file_exists($src)){
                    if($result->getExtension() == 'url'){
                        $ytID = substr($result->getUrl(), 32);
                        $src = "http://img.youtube.com/vi/" . $ytID . "/0.jpg";
                    }
                    else{
                        $src = "videos/thumbnails/placeholder.png";
                    }
                }
                echo        "<a href='index.php?action=watch&v=".$result->getIDvideo()."'><img class='card-img-top nav-item' src='".$src."' alt='thumbnail'></a>";
                echo            "<div class='card-body'>";
                echo                "<h5 class='card-title nav-item text-primary'>".$result->getTitle()."</h5>";
                echo            "</div>";
                echo            "<div class='card-footer'>";
                echo                "<small class='text-secondary'>Przesłany przez: ".$result->getUploadedByLogin()."</small>";
                echo            "</div>";
                echo    "</div>";
                echo "</div>";
                $vn++;
            }
        ?>
    </div>
</div>



</body>
</html>