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
        $update_status_sql="update news set status=:status where id=:id";
        $stmt = $pdo->prepare($update_status_sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    if($type=='delete'){
        $id=get_safe_value($pdo,$_GET['id']);
        $delete_sql="delete from news where id=:id";
        $stmt = $pdo->prepare($delete_sql);
        $stmt->execute(['id' => $id]);
    }
}

$sql="select * from news order by date desc";
$stmt = $pdo->query($sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">What's New </h4>
				   <h4 class="box-link"><a href="manage_whatsnew.php">ADD News</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial" width="10%">#</th>
							   <!-- <th>ID</th> -->
							   <th width="55%">NEWS</th>
							   <th width="15%">Date</th>
							   <th width="20%">Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=$stmt->fetch(PDO::FETCH_ASSOC)){?>

							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <!-- <td><?php echo $row['id']?></td> -->
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_whatsnew.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
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