<?php
require 'top.inc.php';
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
        $stmt = $pdo->prepare("UPDATE regiment SET status=:status WHERE id=:id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    if($type == 'delete'){
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM regiment WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
$stmt = $pdo->prepare("SELECT * FROM regiment ORDER BY id ASC");
$stmt->execute();
$res = $stmt->fetchAll();
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Regiment </h4>
				   <h4 class="box-link"><a href="manage_regiment.php">ADD Regiment</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial" width="10%">#</th>
							   <th width="10%">Name</th>
							   <th width="10%">Active Date</th>
							   <th width="5%">Photo</th>
							   <th width="10%">Regiment Center</th>
							   <th width="20%">Motto</th>
							   <th width="20%">Warcry</th>
							   <th width="15%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i = 1;
							foreach($res as $row){ ?>
							<tr>
								<td class="serial"><?php echo $i?></td>
							    <td class="serial"><?php echo $row['name']?></td>
							    <td class="serial"><?php echo $row['active_date']?></td>
							    <td><a href="../images/regiment/<?php echo $row['photo']?>" target = "_blank"><img src="../images/regiment/<?php echo $row['photo']?>"></a></td>
							    <td class="serial"><?php echo $row['center']?></td>
							    <td class="serial"><?php echo $row['motto']?></td>
							    <td class="serial"><?php echo $row['warcry']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_regiment.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
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