<?php
require('top.inc.php');
isAdmin();

// Retrieve the data from the visitors table
$sql = "SELECT * FROM visitors ORDER BY visit_time DESC";
if($pdo){
    $result = $pdo->query($sql);
    $i=1;

    // Display the data in a table
    if ($result) {
    ?>
    <!doctype html>
    <html class="no-js" lang="">
       <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
       <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>MOD | Welcome <?php echo $_SESSION['ADMIN_USERNAME']?></title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="assets/css/normalize.css">
          <link rel="stylesheet" href="assets/css/bootstrap.min.css">
          <link rel="stylesheet" href="assets/css/themify-icons.css">
          <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
          <link rel="stylesheet" href="assets/css/flag-icon.min.css">
          <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
          <link rel="stylesheet" href="assets/css/style.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
       </head>
       <body>
          <div class="content pb-0">
             <div class="orders">
                <div class="row">
                   <div class="col-xl-12">
                      <div class="card">
                         <div class="card-body">
                            <h4 class="box-title">IP Tracker</h4>
                         </div>
                         <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                               <table class="table ">
                                  <thead>
                                     <tr>
                                        <th>No.</th>
                                        <th>IP Address</th>
                                        <th>Device Name</th>
                                        <th>Referrer URL</th>
                                        <th>Visit Time</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <?php
                                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                           echo "<tr>";
                                           echo "<td>$i</td>";
                                           echo "<td>".$row["ip_address"]."</td>";
                                           echo "<td>".$row["computername"]."</td>";
                                           echo "<td><a href='https://princekakkad.tech".$row["referer_url"]."'target='_blank'>".$row["referer_url"]."</a></td>";
                                           echo "<td>".$row["visit_time"]."</td>";
                                           echo "</tr>";
                                           $i++;
                                        }
                                     ?>
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
        </body>
      </html>
      <?php
    } else {
      echo "No results";
    }
    $pdo = null;
}else{
    echo "Failed to connect to the database.";
}
?>
