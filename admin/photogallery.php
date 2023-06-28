
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
		$update_status_sql="update photogallery set status=:status where id=:id";
		$stmt = $pdo->prepare($update_status_sql);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}
	
	if($type=='delete'){
		$id=get_safe_value($pdo,$_GET['id']);
		$delete_sql="delete from photogallery where id=:id";
		$stmt = $pdo->prepare($delete_sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}
}

$sql="select * from photogallery order by photo asc";
$res=$pdo->query($sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Photo </h4>
				   <h4 class="box-link"><a href="manage_photogallery.php">ADD Photo</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial" width="10%">#</th>
							   <th width="50%">Photo</th>
							   <th width="20%">Updates Date/ Added Date</th>
							   <th width="20%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							foreach ($res as $row){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><a href="../images/photogallery/<?php echo $row['photo']?>" target = "_blank"><img src="../images/photogallery/<?php echo $row['photo']?>"></a></td>
							   <td><?php echo $row['date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_photogallery.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php $i++;} ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>