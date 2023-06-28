<?php
require('top.inc.php');

if(isset($_GET['type']) && $_GET['type']!='') {
    $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
    if($type=='status') {
        $operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($operation=='active') {
            $status='1';
        } else {
            $status='0';
        }
        $update_status_sql = "UPDATE banner SET status=:status WHERE id=:id";
        $stmt = $pdo->prepare($update_status_sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }
    
    if($type=='delete') {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $delete_sql = "DELETE FROM banner WHERE id=:id";
        $stmt = $pdo->prepare($delete_sql);
        $stmt->execute(['id' => $id]);
    }
}

$sql = "SELECT * FROM banner ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Banner</h4>
				   <h4 class="box-link"><a href="manage_banner.php">ADD Banner</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial" width="10%">#</th>
							   <th width="45%">Banner</th>
							   <th width="20%">Updates Date/ Added Date</th>
							   <th width="30%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							foreach ($res as $row) { ?>

							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><a href="../images/banner/<?php echo $row['photo']?>" target = "_blank"><img src="../images/banner/<?php echo $row['photo']?>"></a></td>
							   <td><?php echo $row['date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."	'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_banner.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
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