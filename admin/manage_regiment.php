<?php
require('top.inc.php');
$photo='';
$name='';
$active_date='';
$center='';
$motto='';
$warcry='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=$_GET['id'];
	$stmt = $pdo->prepare("SELECT * FROM regiment WHERE id=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row){
		$photo=$row['photo'];
		$name=$row['name'];
		$active_date=$row['active_date'];
		$center=$row['center'];
		$motto=$row['motto'];
		$warcry=$row['warcry'];
	}else{
		header('location:regiment.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$photo='regiment_'.rand(111111111,999999999).'_'.uniqid().'_'.str_replace(' ', '_', $_FILES['photo']['name']);
	
	$temp_name=$_FILES['photo']['tmp_name'];
	$photo_type=$_FILES['photo']['type'];
	

	list($width, $height) = getimagesize($temp_name);
	$new_width = 350;
	$new_height = 450;
	$new_width1 = 300;
	$new_height1 = 200;

	$image_p = imagecreatetruecolor($new_width, $new_height);
	$image = imagecreatefromjpeg($temp_name);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	$temp_name_resized = '../images/regiment/' . $photo;
	imagejpeg($image_p, $temp_name_resized, 80);
	imagedestroy($image);
	imagedestroy($image_p);

	$image_p1 = imagecreatetruecolor($new_width1, $new_height1);
	$image1 = imagecreatefromjpeg($temp_name);
	imagecopyresampled($image_p1, $image1, 0, 0, 0, 0, $new_width1, $new_height1, $width, $height);
	$temp_name_resized1 = '../images/regiment/banner/' . $photo;
	imagejpeg($image_p1, $temp_name_resized1, 80);
	imagedestroy($image1);
	imagedestroy($image_p1);

	

	$stmt = $pdo->prepare("SELECT * FROM regiment WHERE name=:name");
	$stmt->bindParam(':name', $_POST['name']);
	$stmt->execute();
	$check=$stmt->rowCount();
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			if($id==$getData['id']){
			}else{
				$msg="THIS Regiment ALREADY EXIST";
			}
		}else{
			$msg="THIS Regiment ALREADY EXIST";
		}
	}
	
	if($msg==''){
		$name=$_POST['name'];
		$active_date=$_POST['active_date'];
		$center=$_POST['center'];
		$motto=$_POST['motto'];
		$warcry=$_POST['warcry'];
		if(isset($_GET['id']) && $_GET['id']!=''){
			$stmt = $pdo->prepare("UPDATE regiment SET photo=:photo, name=:name, active_date=:active_date, center=:center, motto=:motto, warcry=:warcry WHERE id=:id");
					$stmt->bindParam(':photo', $photo);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':active_date', $active_date);
		$stmt->bindParam(':center', $center);
		$stmt->bindParam(':motto', $motto);
		$stmt->bindParam(':warcry', $warcry);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}else{
		$stmt = $pdo->prepare("INSERT INTO regiment(photo,status,name,active_date,center,motto,warcry) VALUES(:photo,1,:name,:active_date,:center,:motto,:warcry)");

		$stmt->bindParam(':photo', $photo);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':active_date', $active_date);
		$stmt->bindParam(':center', $center);
		$stmt->bindParam(':motto', $motto);
		$stmt->bindParam(':warcry', $warcry);
		$stmt->execute();
		header('location:regiment.php');
		die();
	}
}
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add New Regiment</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name?>" required>
                            </div>
                            <div class="form-group">
                                <label for="active_date" class=" form-control-label">Active Date</label>
                                <input type="number" name="active_date" class="form-control" value="<?php echo $active_date?>" required>
                            </div>
                            <div class="form-group">
                                <label for="center" class=" form-control-label">Center</label>
                                <input type="text"  name="center" class="form-control" required value="<?php echo $center?>"></input>
                            </div>
                            <div class="form-group">
                                <label for="motto" class=" form-control-label">Motto</label>
                                <input type="text"  name="motto" class="form-control" required value="<?php echo $motto?>"></input>
                            </div>
                            <div class="form-group">
                                <label for="warcry" class=" form-control-label">Warcry</label>
                                <input type="text"  name="warcry" class="form-control" required value="<?php echo $warcry?>"></input>
                            </div>
                            <div class="form-group">
                                <label for="photo" class=" form-control-label">Select Photo</label>
                                <input type="file" name="photo" class="form-control-file"  accept="image/" required>
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