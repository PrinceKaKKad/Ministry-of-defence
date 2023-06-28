<?php

// Check connection
if (!$pdo) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM equipment WHERE status = 1";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = $row["id"];
        $name = $row["name"];
        $photo = $row["photo"];
        $origin = $row["origin"];
        $type = $row["type"];
        ?>

                <div class="col-12 col-md-6 col-lg-3 isotope-item" data-filter="<?php echo $type ?>">
                  <a class="link link-external" href="equipment-post?post=<?php echo $id; ?>">
                    <figure><img src="images/equipment/banner/<?php echo $photo; ?>" alt="" width="370" height="278">
                    </figure>
                    <br>
                                  <h6><?php echo $name ?></h6><br></a>
                                  <div style="text-align: justify; font-family: ;">
                                  </div>
                    <a class="link link-original" href="images/equipment/<?php echo $photo; ?>" data-lightgallery="item"></a>
                  
                </div>
<?php
}
} else {
    ?>

                <div class="col-12 isotope-item" data-filter="">
                  <div class="thumbnail thumbnail-variant-3"><a class="link link-external" href="#" target = "_blank"><span class="novi-icon icon icon-sm fa fa-link"></span></a>
                    <br>
                    <h6>Data Not Found</h6><br>
                    <div class="caption"><a class="link link-original" href="#" alt = "No Image Found" data-lightgallery="item"></a></div>
                  </div>
                </div>
<?php
}
?>
