<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($pdo,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($pdo,$_GET['operation']);
		$id=get_safe_value($pdo,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update admin_users set status=:status where id=:id";
		$stmt=$pdo->prepare($update_status_sql);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	}
	
	if($type=='photo'){
		$role = $_SESSION['ADMIN_ID'];
		$id = get_safe_value($pdo, $_GET['id']);
		if ($id === $role) {
			$update_sql = "UPDATE admin_users SET photo='profile.png' WHERE id=:id";
			$stmt=$pdo->prepare($update_sql);
			$stmt->bindParam(':id',$id);
			$stmt->execute();
		}
		else{
			echo '<script>alert("Please LOGIN From Your Account")</script>';
		}
	}
}


$sql="select * from admin_users where id = :admin_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':admin_id', $_SESSION['ADMIN_ID']);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

?>

<head>
  <link rel="stylesheet" media="all" href="assets/css/profile.css" />
</head>

<div class="profile-view" title="Profile">
  <div class="left">
    <?php
		  $image_path = '../images/users/' . $row['photo'];
		  if (file_exists($image_path)) {
		    echo '<img src="' . $image_path . '" style="border-width:0px;" title="Profile Picture">';
		  } else {
		    echo '<img src="../images/users/profile.png" style="border-width:0px;" title="Default Profile Picture">';
		  }
		  ?>
	<br>
	<br>
    <h4><b>Name:</b> <?php echo $row['name']; ?> </h4>
    <h4><b>Username:</b> <?php echo $row['username']; ?> </h4>
    <h4><b>Email:</b> <?php echo $row['email']; ?> </h4>
    <h4><b>Number:</b> <?php echo $row['mobile']; ?> </h4>
    <br>
    <h4>
      <?php echo "<span class='badge badge-edit'><a href='manage_user.php?id=".$row['id']."'>Edit Profile</a></span>&nbsp;"; ?>
      <?php echo "<span class='badge red badge-delete'><a href='?type=photo&id=".$row['id']."'>Remove Profile Picture</a></span>"; ?>
    </h4>
  </div>
</div>
<?php
}
require('footer.inc.php');
?>