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
		$update_status_sql="update equipment set status=:status where id=:id";
		$stmt = $pdo->prepare($update_status_sql);
		$stmt->bindParam(':status', $status, PDO::PARAM_INT);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
	
	if($type=='delete'){
		$id=get_safe_value($pdo,$_GET['id']);
		$delete_sql="delete from equipment where id=:id";
		$stmt = $pdo->prepare($delete_sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}
}

$sql="select * from equipment order by id asc";
$res=$pdo->query($sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Equipments </h4>
				   <h4 class="box-link"><a href="manage_equipment.php">ADD Equipment</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial" width="10%">#</th>
							   <th width="10%">Name</th>
							   <th width="10%">Type</th>
							   <th width="10%">Photo</th>
							   <th width="40%">Origin</th>
							   <th width="20%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i = 1;
							foreach($res as $row){ ?>
							<tr>
								<td class="serial"><?php echo $i?></td>
							    <td class="serial"><?php echo $row['name']?></td>
							    <td class="serial"><?php echo $row['type']?></td>
							    <td><a href="../images/equipment/<?php echo $row['photo']?>" target = "_blank"><img src="../images/equipment/<?php echo $row['photo']?>"></a></td>
							    <td class="serial"><?php echo $row['origin']?></td>
							   
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_equipment.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
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