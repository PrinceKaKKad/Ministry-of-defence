<!DOCTYPE html>
<html class="wide wow-animation font-size-default" lang="en">
  <head>
    <title>Weapon's</title>
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
            <h2>Weapon</h2>
          </div>
        </div>
      </section>
        
        <section class="section section-50 section-md-90 section-lg-bottom-120 section-xl-bottom-165">
        <div class="container isotope-wrap text-center">
          <div class="row row-40">
            <div class="col-sm-12">
              <ul class="isotope-filters-responsive">
                <li>
                  <p>Choose Equipment:</p>
                </li>
                <li class="block-top-level">
                  <button class="isotope-filters-toggle btn btn-sm btn-default" data-custom-toggle="#isotope-1" data-custom-toggle-hide-on-blur="true" data-custom-toggle-disable-on-blur="true">Filter<span class="caret"></span></button>
                  <div class="isotope-filters isotope-filters-minimal isotope-filters-horizontal" id="isotope-1">
                    <ul class="list-inline">
                      <li><a class="active" id="load" data-isotope-filter="Knives" href="#">Knives</a></li>
                      <li><a data-isotope-filter="Pistols" href="#">Pistols</a></li>
                      <li><a data-isotope-filter="Sub-Machine Gun" href="#">Sub-Machine Gun</a></li>
                      <li><a data-isotope-filter="Assault rifles" href="#">Assault rifles</a></li>
                      <li><a data-isotope-filter="Sniper rifles" href="#">Sniper rifles</a></li>
                      <li><a data-isotope-filter="Anti-material rifles" href="#">Anti-material rifles</a></li>
                      <li><a data-isotope-filter="Machine Guns" href="#">Machine Guns</a></li>
                      <li><a data-isotope-filter="Explosives" href="#">Explosives</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-sm-12">
              <div class="row isotope isotope-gutter-default" data-lightgallery="group" data-lg-thumbnail="false">
                <?php include 'includes/equipment.php' ?>

              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="divider"></div>
      <?php include 'includes/footer.php' ?>
  </body>
</html>