<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Ustawienia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/scripts/jquery-3.6.3.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/r-2.4.0/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/r-2.4.0/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.js"></script>
</head>
<body>



<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Videos management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Admin Panel</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Videos
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%;height:100%;">
                    <thead>
                    <tr>
                        <th>id_video</th>
                        <th>title</th>
                        <th>uploaded by</th>
                        <th>actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php    foreach($videoData as $video)
                     {     ?>
                    <tr>
                        <td><?php echo $video->id_video;?></td>
                        <td><?php echo $video->getTitle();?></td>
                        <td><?php echo $video->login;?></td>
                        <td style="text-align:center" >
                        <a  href="index.php?action=videosAdministration&deleteVideo=<?php echo $video->id_video;?>" data-id-video="<?php echo $video->id_video;?>">

                            <button type="submit" class="btn btn-danger " id="delete-video-btn" name="deleteVideo"  data-id-video="<?php echo $video->id_video;?>">Delete Video</button>
                        </a>
                          <a href="index.php?action=watch&v=<?php echo $video->id_video;?>"> <button type="button" class="btn btn-primary">Watch</button></a>
                            <?php

                               $reportedVideo = $video->isReported();
                            if ($reportedVideo != 2) {

                             ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#checkReport" data-video-id ="<?php echo $video->id_video;?>"
                                    data-video-title="<?php echo $video->getTitle();?>" data-video-url="<?php echo $video->getUrl();?>"
                                    data-reported-video='<?php echo $reportedVideo; ?>'



                            >Reported</button>
                            <?php } else { ?>
                            <!-- put other actions here -->
                            <?php } ?>
                        </td>


                    </tr>
                    <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</main>






<div class="modal fade" id="checkReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reported Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="videoTitle">Video Title:</label>
                <h5 id="videoTitle"></h5>
                <iframe id="videoIframe"  class="card-img-top rounded h-100" ></iframe>
                <label for="description">Video Description:</label>
                <p id="description"></p>
                <label for="reasonsList">Reported Reasons:</label>
                <ul id="reasonsList">
                </ul>
            </div>
            <div class="modal-footer">
              <a  id="delete-video-btn >
              <button type="submit" class="btn btn-danger float-end" " name="deleteVideo">Delete Video</button>
              </a>
                <a id="rejectBt" >
                    <button type="submit" class="btn btn-secondary float-start" id="reject-report-btn" name="reject">Reject Report</button>
                </a>

            </div>
        </div>
    </div>
</div>



<style>

    #checkReport {
        width: 90%;
        height: 90%;
    }

    #videoIframe {
        width: 100%;
        height: 400px;
    }


</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>

<script>
   
    

    


    $(document).ready(function(){
        var table =  $('#example').DataTable();
        $('#checkReport').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var videoId = button.data("video-id");
            var videoTitle = button.data("video-title");
            var videoUrl = button.data("video-url");
            var reportedVideo = button.data("reported-video");
            var description = reportedVideo[0].description;


            var modal = $(this)
            console.log(videoId);
            console.log(videoTitle);
            console.log(videoUrl);

            var embedLink;
            const ytPattern = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            if(videoUrl.includes('youtube'))
            {

                embedLink = 'https://www.youtube.com/embed/'+videoUrl.match(ytPattern)[2]

            }
            console.log(reportedVideo[0].description);

            modal.find("iframe").attr('src',embedLink);
            for(var i=0;i<reportedVideo.length;i++)
            {

                console.log(reportedVideo[i].reason);
            }

            $('#deleteBt').attr("href", "index.php?deleteVideo=" + videoId);
            $('#rejectBt').attr("href", "index.php?reject=" + videoId);

            $('#videoTitle').text(videoTitle);
            $('#description').text(reportedVideo[0].description);
            var reasonsList = $('#reasonsList');
            reasonsList.empty();
            for (var i = 0; i < reportedVideo.length; i++) {
                reasonsList.append('<li>'+reportedVideo[i].reason+'</li>');
            }

        })

        $('#checkReport').on('hide.bs.modal', function () {
           
        })
        

        $(document).on('click', '#deleteVBt', function() {
           
            var videoId = $(this).attr('data-id-video');
            //remove row from table
            table.row("#videoId"+videoId).remove().draw();
            //send ajax request to delete video
           
            

        });



    });

</script>


</body>
</html>