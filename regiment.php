<!DOCTYPE html>
<html class="wide wow-animation font-size-default" lang="en">
  <head>
    <title>Regiment</title>
		<?php include 'includes/header.php' ?>
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
      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap" style="background-image: url(images/bg-gallery.jpg);">
        <div class="container">
          <div class="page-title">
            <h2>Regiment</h2>
          </div>
        </div>
      </section>

      <section class="section section-50 section-md-90 section-lg-bottom-120 section-xl-bottom-165">
        <div class="container isotope-wrap text-center">
          <div class="row row-40">
            <div class="col-sm-12">
              <div class="row isotope isotope-gutter-default" data-lightgallery="group" data-lg-thumbnail="false">
                <?php include 'includes/regiment.php' ?>

              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="divider"></div>
      <?php include 'includes/footer.php' ?>
  </body>
</html>