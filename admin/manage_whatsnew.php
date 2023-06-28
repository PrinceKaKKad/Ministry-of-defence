<?php
require 'top.inc.php';
$categories = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($pdo, $_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $check = $stmt->rowCount();

    if ($check > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $categories = $row['categories'];
    } else {
        header('location:whatsnew.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($pdo, $_POST['categories']);
    $stmt = $pdo->prepare("SELECT * FROM news WHERE categories=:categories");
    $stmt->bindParam(':categories', $categories);
    $stmt->execute();
    $check = $stmt->rowCount();

    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($id == $getData['id']) {
            } else {
                $msg = "CATEGORIES ALREADY EXIST";
            }
        } else {
            $msg = "CATEGORIES ALREADY EXIST";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $stmt = $pdo->prepare("UPDATE news SET categories=:categories WHERE id=:id");
            $stmt->bindParam(':categories', $categories);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else {
            $stmt = $pdo->prepare("INSERT INTO news(categories,status) values(:categories, '1')");
            $stmt->bindParam(':categories', $categories);
            $stmt->execute();
        }
        header('location:whatsnew.php');
        die();
    }
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Add New News</strong> </div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">News</label>
									<input type="text" name="categories" placeholder="Enter New News" class="form-control" required value="<?php echo $categories?>">
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