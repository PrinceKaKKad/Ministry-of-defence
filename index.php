<!DOCTYPE html>
<html class="wide wow-animation font-size-default" lang="en">
<head>
  <title>Home</title>
  <?php include 'includes/header.php' ?>
  <meta name="robots" content="index, follow">
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

    <section class="section">
      <?php include 'includes/banner.php' ?>
    </section>
    <section class="section-60 section-md-90 section-lg-150 bg-default">
      <div class="container">
        <div class="row">
          <h2>The defence of India and all of its parts is the responsibility of the Indian government.</h2>
          <h6 class="text-gray-100 mt-4">Safety and Security First: The Indian Ministry of Defence Committed to the Protection of Its People and Sovereignty.</h6>
        </div>
        <div class="row">
          <div class="col-lg-6 position-relative d-none d-md-block">
            <div class="parallax-scene-js parallax-scene parallax-scene-1" data-scalar-x="5" data-scalar-y="10">
              <div class="layer-01">
                <div class="layer" data-depth="0.25"><img src="images/photogallery/PIC 3_41.jpg" alt="" width="330" height="294">
                </div>
              </div>
              <div class="layer-02">
                <div class="layer" data-depth=".55"><img src="images/photogallery/PIC 5_30.jpg" alt="" width="320" height="294">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1 offset-md-top-100 offset-lg-top-50">
            <h5>Bangladesh War (1971)</h5>
            <p>India intervened in East Pakistan's independence movement, leading to a war. India gained control of East Pakistan, which became the independent country of Bangladesh</p>
            <h5 class="mt-5">Kargil War (1999)</h5>
            <p>Pakistan's infiltration in the Kargil region of Kashmir led to a limited war. India launched a successful military operation to evict Pakistani forces from Kargil, and Pakistan withdrew its troops.</p>
            <h5 class="mt-5">Surgical Strike (2016)</h5>
            <p>The surgical strike refers to a military operation conducted by the Indian Army in September 2016, in response to the Uri attack, a terrorist attack that killed 19 Indian soldiers. The Indian Army conducted the operation by crossing the Line of Control (LoC) and targeting terrorist launchpads in Pakistan-occupied Kashmir (PoK). The operation was successful in destroying several terrorist camps and caused significant casualties among the militants.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="section-60 section-md-90 section-lg-150 section-boxed bg-primary">
      <div class="container">
        <h2>Photo Gallery</h2>
        
        <div class="row row-40 row-lg-80 row-xxl-110 justify-content-center">
          <?php include 'includes/photogallery.php' ?>
        </div>
      </div>
    </section>
    <section class="section-60 section-md-90 section-lg-150 section-boxed bg-primary">
      <div class="container">
        <div class="row row-40 row-lg-80 row-xxl-110 justify-content-center">

          <?php include 'includes/whatsnew.php' ?>
        </div>
      </div>
    </section>
    <!-- Footer app-->
    <?php include 'includes/footer.php'?>

</body>
</html>