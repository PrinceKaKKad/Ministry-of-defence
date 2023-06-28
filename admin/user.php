<?php
// require('functions.inc.php');
require('top.inc.php');
isAdmin();

if(isset($_GET['type']) && $_GET['type'] != ''){
	$type = $_GET['type'];
	
	if($type == 'status'){
		$operation = $_GET['operation'];
		$id = $_GET['id'];
		
		if($operation == 'active'){
			$status = '1';
		}else{
			$status = '0';
		}
		
		$update_status_sql = "UPDATE admin_users SET status = :status WHERE id = :id";
		$update_status_stmt = $pdo->prepare($update_status_sql);
		$update_status_stmt->bindParam(':status', $status, PDO::PARAM_STR);
		$update_status_stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$update_status_stmt->execute();
	}
	
	if($type == 'delete'){
		$id = $_GET['id'];
		$delete_sql = "DELETE FROM admin_users WHERE id = :id";
		$delete_stmt = $pdo->prepare($delete_sql);
		$delete_stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$delete_stmt->execute();
	}
}

$sql = "SELECT * FROM admin_users WHERE role = 1 ORDER BY id ASC";
$res = $pdo->query($sql);
?>


<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">USER MANAGEMENT </h4>
				   <h4 class="box-link"><a href="manage_user.php">ADD User</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="20%">Username</th>
							   <th width="20%">Password</th>
							   <th width="20%">Email</th>
							   <th width="10%">Mobile</th>
							   <th width="26%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
                            while($row=$res->fetch(PDO::FETCH_ASSOC)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['password']?></td>
							   <td><?php echo $row['email']?></td>
							   <td><?php echo $row['mobile']?></td>
							  
							   <td>
								<?php

								if($row['id'] != 1){
									if($row['status']==1){
										echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
									}else{
										echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
									}
									echo "<span class='badge badge-edit'><a href='manage_user.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
									
									echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
									}
								else{
									 if($_SESSION['ADMIN_ROLE'] == 0){
									echo "<span class='badge badge-edit'><a href='manage_user.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
									 }
									 else{
										echo "<span class='badge badge-delete'><a>Don't Have permission</a></span>&nbsp;";
									}
								}
								
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