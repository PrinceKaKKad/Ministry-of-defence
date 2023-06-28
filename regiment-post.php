<!DOCTYPE html>
<html class="wide wow-animation font-size-default" lang="en">
  <head>
    <title>POST</title>
    <?php include 'includes/header.php';?>
    <?php include 'includes/conn.php' ?>
		
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <div class="page">
      <?php include 'includes/navbar.php' ?>
      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url(images/bg-blog.jpg);">
        <div class="container">
          <div class="page-title">
            <h2>POST</h2>
          </div>
        </div>
      </section>
      <section>
        <?php include 'includes/regiment_post.php' ?>
      </section>

    <?php include 'includes/footer.php' ?>
  </body>
</html>