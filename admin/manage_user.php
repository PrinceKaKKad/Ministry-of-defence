<?php
require('top.inc.php');

$username='';
$password='';
$name='';
$email='';
$mobile='';
$photo='';
$msg='';
$status='';
$role='';
$btn_txt;

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if(empty($row)){
        header('location:index.php');
        die();
    } else{
        $username=$row['username'];
        $password=$row['password'];
        $name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
    }
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    if(isset($_FILES['photo']['name'])){
        $photo='user_'.rand(111111111,999999999).'_'.uniqid().'_'.str_replace(' ', '_', $_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'],'../images/users/'.$photo);
    }

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $check = $stmt->rowCount();
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = $stmt->fetch();
            if($id == $getData['id']){
            } else{
                $msg="Username already exists";
            }
        } else{
            $msg="Username already exists";
        }
    }

    if($msg == ''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            if($photo != ''){
                $stmt = $pdo->prepare("UPDATE admin_users SET username=?, password=?, name=?, email=?, mobile=?, photo=? WHERE id=?");
                $stmt->execute([$username, $password, $name, $email, $mobile, $photo, $id]);
            } else{
                $stmt = $pdo->prepare("UPDATE admin_users SET username=?, password=?, name=?, email=?, mobile=? WHERE id=?");
                $stmt->execute([$username, $password, $name, $email, $mobile, $id]);
            }
        } else{
            $stmt = $pdo->prepare("INSERT INTO admin_users(username, password, name, photo, role, email, mobile, status) VALUES(?,?,?,?,?,?,?,?)");
            $stmt->execute([$username, $password, $name, $photo, 1, $email, $mobile, 1]);
        }
        header('location:index.php');
        die();
    }
}
?>
<div class="content pb-0">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"><strong><?php echo (isset($_GET['id']))?'UPDATE':'ADD'?> USER</strong></div>
          <form method="post" enctype="multipart/form-data">
            <div class="card-body card-block">
              <div class="form-group">
                <label for="username" class=" form-control-label">Username</label>
                <input type="text" name="username" placeholder="Enter username" class="form-control" required value="<?php echo $username?>" required>
              </div>
              <div class="form-group">
                <label for="password" class=" form-control-label">Password</label>
                <input type="password" name="password" placeholder="Enter password" class="form-control" required value="<?php echo $password ?>" required>
              </div>
              <div class="form-group">
                <label for="name" class=" form-control-label">Name</label>
                <input type="text" name="name" placeholder="Enter name" class="form-control" required value="<?php echo $name ?>" required>
              </div>
              <div class="form-group">
                <label for="photo" class=" form-control-label">Photo</label>
                <input type="file" name="photo" class="form-control">
                <?php if ($photo != '') { ?>
                <input type="hidden" name="current_photo" value="<?php echo $photo ?>">
                <img src="<?php echo ADMIN_IMAGE_URL.$photo ?>" height="50" alt="" required>
                <?php } ?>
              </div>
              <div class="form-group">
                <label for="email" class=" form-control-label">Email</label>
                <input type="email" name="email" placeholder="Enter email" class="form-control" required value="<?php echo $email ?>" required>
              </div>
              <div class="form-group">
                <label for="mobile" class=" form-control-label">Mobile Number</label>
                <input type="number" name="mobile" placeholder="Enter mobile number" class="form-control" required value="<?php echo $mobile ?>" required>
              </div>
              <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                <span id="payment-button-amount">Submit</span>
              </button>
              <div class="field_error"><?php echo $msg?></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
require('footer.inc.php');
?>