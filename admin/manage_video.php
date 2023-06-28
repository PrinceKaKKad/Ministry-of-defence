<?php
require('top.inc.php');

$name='';
$link='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($pdo,$_GET['id']);
    $res=$pdo->prepare("SELECT * FROM videogallery WHERE id=:id");
    $res->bindParam(":id", $id);
    $res->execute();
    $check=$res->rowCount();
    if($check>0){
        $row=$res->fetch(PDO::FETCH_ASSOC);
        $name=$row['name'];
        $link=$row['link'];
    }else{
        header('location:video.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $name=get_safe_value($pdo,$_POST['name']);
    $link=get_safe_value($pdo,$_POST['link']); 

    // check if link matches either of the two allowed formats
    if (!preg_match('/^(https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu.be\/)/', $link)) {
        $msg="Invalid link format";
    } else {
        // replace link with desired format
        $link = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $link);
        $link = str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $link);

        $res=$pdo->prepare("SELECT * FROM videogallery WHERE name=:name");
        $res->bindParam(":name", $name);
        $res->execute();
        $check=$res->rowCount();
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=$res->fetch(PDO::FETCH_ASSOC);
                if($id==$getData['id']){

                }else{
                    $msg="Video already exists";
                }
            }else{
                $msg="Video already exists";
            }
        }

        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $update_sql="UPDATE videogallery SET name=:name,link=:link WHERE id=:id";
                $update_res=$pdo->prepare($update_sql);
                $update_res->bindParam(":name", $name);
                $update_res->bindParam(":link", $link);
                $update_res->bindParam(":id", $id);
                $update_res->execute();
            }else{
                $insert_sql="INSERT INTO videogallery(name,link,status) VALUES(:name,:link,1)";
                $insert_res=$pdo->prepare($insert_sql);
                $insert_res->bindParam(":name", $name);
                $insert_res->bindParam(":link", $link);
                $insert_res->execute();
            }
            header('location:video.php');
            die();
        }
    }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>VENDOR MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body card-block">


                                <div class="form-group">
                                    <label for="name" class=" form-control-label">name</label>
                                    <input type="text" name="name" placeholder="Enter name" class="form-control" required value="<?php echo $name?>">
                                </div>
                                <div class="form-group">
                                    <label for="link" class=" form-control-label">link</label>
                                    <input type="text" name="link" placeholder="Enter link" class="form-control" required value="<?php echo $link?>">
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
         