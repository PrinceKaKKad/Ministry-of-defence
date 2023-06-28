<div id="carouselExampleDark" class="carousel slide section" data-bs-ride="carousel">

  <div class="carousel-inner">
    <div class="carousel-item active col-12" data-bs-interval="3000">
      <img src="images/banner/banner_657784726_643bcda87d3c7_PIC_16_7.jpg" title="Banner" class="d-block w-100" alt="" style="max-height: 700px; min-height: 300px;">
    </div>

    <?php

    // Prepare and execute the SQL query to fetch active banners
    $stmt = $pdo->prepare("SELECT * FROM banner WHERE status = ?");
    $stmt->execute([1]);

    // Loop through the result set and output the banner images
    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $photo = $row["photo"];
        ?>
        <div class="carousel-item" data-bs-interval="3000">
          <img src="images/banner/<?php echo $photo ?>" title="Banner" class="d-block w-100" alt="<?php echo $photo ?>" style="max-height: 700px;min-height: 300px">
        </div>
        <?php
        $i++;
    }

    if ($i == 0) {
        echo "No images found";
    }
    ?>
  </div>
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <?php
    // Output the carousel indicators
    if ($i != 0) {
        for ($j = $i; $j > 0; $j--) {
            ?>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $i ?>" aria-label="Slide <?php echo $i ?>"></button>
            <?php
            $i--;
        }
    }
    ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
