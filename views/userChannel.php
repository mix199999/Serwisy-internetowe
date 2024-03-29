<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Ustawienia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="/scripts/jquery-3.6.3.js"></script>
</head>
<body>



<div class="col-12 min-vh-100 p-lg-5">
  <div class="row col-12 vh-100 d-flex justify-content-center align-items-start">
    <div class="d-flex flex-wrap justify-content-center h-25">
      <?php foreach ($modifiedLinks as $link): ?>
      <div class="bs-card-video h-100 m-3 col-2 position-relative" data-link="<?php echo $link['url']; ?>"  data-video-title="<?php echo $link['title']; ?>">
        <a class="d-block h-100 w-100" >
          <iframe src="<?php echo $link['url']; ?>" class="card-img-top rounded h-100" ></iframe>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<style>
  .bs-card-video {
    transition: transform 0.2s ease;
    box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);
    border-radius: 0;
    border: 0;
  }
  .bs-card-video:hover {
    transform: scale(1.1);
  }
</style>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
<script>
  document.querySelectorAll('.bs-card-video').forEach(link => {
    var div = document.createElement("div");
    div.style.width = "100%";
    div.style.height = "100%";
    div.style.position = "absolute";
    div.style.top = 0;
    div.style.left = 0;
    div.style.zIndex = 1;
    div.setAttribute('title', link.getAttribute("data-video-title"));
    div.addEventListener('click', function(event) {
      var url = "index.php?action=watch&v=" + link.getAttribute("data-link");
      window.location.href = url;
    });
    link.appendChild(div);
  });
</script>



















</body>
</html>