<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>


    <?php  echo "<script src='scripts/jquery-3.6.3.js'></script>"?>
     <?php  echo "<script src='scripts/addvideo.js'></script>"?>
</head>
    <body>

        <div class="container py-2 px-0">
            <div class="card">
                <h1 class='card-title align-self-center align-self-md-start'>Dodaj wideo</h1>
                <div class="card-body">
                    <form id="login-form" method="post" action = "index.php?action=addvideo" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-md-2 col-lg-2 col-form-label" for="title">Tytuł:</label>
                            <div class="col">
                                <input class="form-control" id="title" type="text" name="title" value="<?php echo $title ?>">
                                <label class="form-label text-danger col-12" id="title-alert" for="title" style="display: <?php echo $errors['title']; ?>">Pole jest wymagane</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-lg-2 col-form-label" for="title">Wybierz formę przesłania:</label>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="filechck" value="file">
                                    <label class="form-check-label" for="filechck">Z pliku</label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="urlchck" value="url">
                                    <label class="form-check-label" for="urlchck">Z linku</label>
                                </div>
                                <label class="form-label text-danger col-12" id="choice-alert" for="" style="display: <?php echo $errors['choice']; ?>"><?php echo $choiceMsg; ?></label>
                            </div>
                        </div>
                        <div class="form-group row" id="fileChoice" style="display: none">
                            <label class="col-md-2 col-lg-2 col-form-label" for="title">Wybierz plik:</label>
                            <div class="col">
                                <input class="form-control-file" id="file-input" type='file' name='video' accept='video/*'>
                            </div>
                        </div>
                        <div class="form-group row" id="urlChoice" style="display: none">
                            <label class="col-md-2 col-lg-2 col-form-label" for="title">Podaj adres:</label>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">www.youtube.com/watch?v=</span>
                                    </div>
                                    <input class="form-control" id="adress" type="text" name="adress" value=''>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-lg-2 col-form-label" for="tags">Tagi:</label>
                            <div class="col">
                                <textarea class="form-control" id="tags" name="tags" rows="1" placeholder="Podaj tagi oddzielone przecinkami"></textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2" id="thumbnail-btn-div" style="display: none">

                            <button type="button" class="btn btn-secondary" id="thumbnail-btn">Stwórz Miniaturkę!</button>

                        </div>
                        <div class="form-group row py-2">

                                <input class="btn btn-primary w-25" type="submit" id="send" value="Prześlij">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container" id="thumbnail-creator" style="display: none">
            <div class="card">
                <h2 class='card-title align-self-center align-self-md-start'>Kreator miniaturek</h2>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <input class="w-100" id="thtxt" type="text">
                            <video class="border border-5 border-secondary" id="video-element" height="360" width="480" controls>
                                <source type="video/mp4">
                            </video>
                            <input class="w-100" id="thtxt2" type="text">
                        </div>
                        <div class="col-xl-1">
                            <button type="button" class="btn btn-secondary w-auto h-100" id="capture">Uchwyć</button>
                        </div>
                        <div class="col-xl-5">
                            <input type="range" class="form-control-range w-100" id="formControlRange" min="0" max="480" step="1">
                            <canvas class="border border-5 border-secondary" id="canvas-element" height="360" width="480"></canvas>
                            <input type="range" class="form-control-range w-100" id="formControlRange2" min="0" max="480" step="1">
                        </div>
                        <div class="col-xl-1">
                            <input class="form-check-input" type="radio" name="colour" id="black" value="black" checked>
                            <label class="form-check-label" for="black">B</label>
                            <input class="form-check-input" type="radio" name="colour" id="white" value="white">
                            <label class="form-check-label" for="white">W</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
$(document).ready(function() {
    $("input[name='type']").change(function() {
        if ($("#filechck").is(":checked")) {
            $("#fileChoice").show();
            $("#urlChoice").hide();
        } else if ($("#urlchck").is(":checked")) {
            $("#fileChoice").hide();
            $("#urlChoice").show();
        }
    });
});
</script>



    </body>




</html>