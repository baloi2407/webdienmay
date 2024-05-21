<?php
$sql = mysqli_query($mysqli,"SELECT * FROM tbl_slider WHERE slider_active=1 ORDER BY slider_id DESC");
$row = mysqli_fetch_array($sql);
?>
<!-- //banner -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
          <img class="d-block w-100" src="./images/<?= $row['slider_image']; ?>" alt="First slide">
      </div>
  </div>
</div>