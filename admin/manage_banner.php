<?php
require('top.inc.php');
$photo='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($pdo, $_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM banner WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $check = $stmt->rowCount();
    if($check > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $photo = $row['photo'];
    }else{
        header('location:banner.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $photo='banner_'.rand(111111111,999999999).'_'.uniqid().'_'.str_replace(' ', '_', $_FILES['photo']['name']);
    $temp_name=$_FILES['photo']['tmp_name'];
    $photo_type=$_FILES['photo']['type'];

    // Resize the image to 1200x800 pixels
    list($width, $height) = getimagesize($temp_name);
    $new_width = 1920;
    $new_height = 1080;
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($temp_name);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    $temp_name_resized = '../images/banner/' . $photo;
    imagejpeg($image_p, $temp_name_resized, 80);
    imagedestroy($image);
    imagedestroy($image_p);

    // Move the resized image to the "images" folder
    move_uploaded_file($temp_name_resized, "../images/$photo");

    $stmt = $pdo->prepare("SELECT * FROM banner WHERE photo=:photo");
    $stmt->bindParam(':photo', $photo);
    $stmt->execute();
    $check = $stmt->rowCount();
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = $stmt->fetch(PDO::FETCH_ASSOC);
            if($id == $getData['id']){
            }else{
                $msg = "PHOTO ALREADY EXIST";
            }
        }else{
            $msg = "PHOTO ALREADY EXIST";
        }
    }

    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $stmt = $pdo->prepare("UPDATE banner SET photo=:photo WHERE id=:id");
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }else{
            $stmt = $pdo->prepare("INSERT INTO banner(photo, status) VALUES(:photo, '1')");
            $stmt->bindParam(':photo', $photo);
            $stmt->execute();
        }
        header('location:banner.php');
        die();
    }
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add New Banner</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="photo" class=" form-control-label">Select Photo</label>
                                <input type="file" name="photo" class="form-control-file" accept="image/*" required>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>
