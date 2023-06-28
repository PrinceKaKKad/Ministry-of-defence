<?php
require('top.inc.php');
$photo = '';
$name = '';
$type = '';
$origin = '';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = $_GET['id'];
	$stmt = $pdo->prepare("SELECT * FROM equipment WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row){
		$photo = $row['photo'];
		$name = $row['name'];
		$type = $row['type'];
		$origin = $row['origin'];
	} else {
		header('location:equipment.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$photo = 'equipment_'.rand(111111111,999999999).'_'.uniqid().'_'.str_replace(' ', '_', $_FILES['photo']['name']);
	
	$temp_name = $_FILES['photo']['tmp_name'];
	$photo_type = $_FILES['photo']['type'];
	

	list($width, $height) = getimagesize($temp_name);
	$new_width = 870;
	$new_height = 400;
	$new_width1 = 300;
	$new_height1 = 200;

	$image_p = imagecreatetruecolor($new_width, $new_height);
	$image = imagecreatefromjpeg($temp_name);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	$temp_name_resized = '../images/equipment/' . $photo;
	imagejpeg($image_p, $temp_name_resized, 80);
	imagedestroy($image);
	imagedestroy($image_p);

	$image_p1 = imagecreatetruecolor($new_width1, $new_height1);
	$image1 = imagecreatefromjpeg($temp_name);
	imagecopyresampled($image_p1, $image1, 0, 0, 0, 0, $new_width1, $new_height1, $width, $height);
	$temp_name_resized1 = '../images/equipment/banner/' . $photo;
	imagejpeg($image_p1, $temp_name_resized1, 80);
	imagedestroy($image1);
	imagedestroy($image_p1);

	

	$stmt = $pdo->prepare("SELECT * FROM equipment WHERE name = :name");
	$stmt->bindParam(':name', $name);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($id != $row['id']){
				$msg = "THIS EQUIPMENT ALREADY EXISTS";
			}
		}else{
			$msg = "THIS EQUIPMENT ALREADY EXISTS";
		}
	}
	
	if($msg == ''){
		$name = $_POST['name'];
		$type = $_POST['type'];
		$origin = $_POST['origin'];
		if(isset($_GET['id']) && $_GET['id'] != ''){
			$stmt = $pdo->prepare("UPDATE equipment SET photo=:photo, name=:name, type=:type, origin=:origin WHERE id=:id");
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':photo', $photo);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':origin', $origin);
		$stmt->execute();
	}else{
		$stmt = $pdo->prepare("INSERT INTO equipment (photo, status, name, type, origin) VALUES (:photo, '1', :name, :type, :origin)");
		$stmt->bindParam(':photo', $photo);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':type', $type);
		$stmt->bindParam(':origin', $origin);
		$stmt->execute();
	}
	header('location: equipment.php');
	exit();
}
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add New Equipment</strong></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name?>" required>
                            </div>
                            <div class="form-group">
                                <label for="type" class=" form-control-label">Type</label>
                                <select name="type" class="form-control" required>
                                	<option selected value="<?php echo $type?>">
                                		<?php echo $type?></option>
                                	<!-- Weapons -->
                                	<option value="Knives">Knives</option>
                                	<option value="Pistols">Pistols</option>
                                	<option value="Sub-Machine Gun">Sub-Machine Gun</option>
                                	<option value="Assault rifles">Assault rifles</option>
                                	<option value="Sniper rifles">Sniper rifles</option>
                                    <option value="Anti-material rifles">Anti-material rifles</option>
                                    <option value="Machine Guns">Machine Guns</option>
                                    <option value="Explosives">Explosives</option>

                                    <!-- Vehicles -->
                                    <option value="Armoured combat vehicles">Armoured combat vehicles</option>
                                    <option value="Goods and field transport vehicles">Goods and field transport vehicles</option>
                                    <option value="Artillery">Artillery</option>

                                    <!-- Airdefance -->
                                    <option value="Missile">Missile</option>
                                    <option value="Unmanned Aerial Vehicle">Unmanned Aerial Vehicle</option>
                                    <option value="Drones">Drones</option>
                                    <option value="Air Crafts">Air Crafts</option>

                                    <!-- Navy -->
                                    <option value="Ships">Ships</option>
                                    <option value="Aircraft Carrier">Aircraft Carrier</option>
                                    <option value="Submarine">Submarine</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="origin" class=" form-control-label">Origin</label>
                                <input type="text"  name="origin" class="form-control" required value="<?php echo $origin?>"></input>
                            </div>
                            <div class="form-group">
                                <label for="photo" class=" form-control-label">Select Photo</label>
                                <input type="file" name="photo" class="form-control-file"  accept="image/*" required>
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