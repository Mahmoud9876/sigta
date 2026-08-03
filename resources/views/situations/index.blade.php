<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIGTA </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets1/img/favicon.png" >
  <link href="assets1/img/apple-touch-icon.png" >

  <!-- Google Fonts -->

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets1/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets1/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class=" me-auto text-black-50"><a href="/">SIGTA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets1/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto text-black-50 " href="/">Accueil</a></li>
          <li><a class="nav-link scrollto text-black-50" href="{{ url('/assujettis') }}">Assujettis</a></li>

          <li class="dropdown text-black-50"><a href="#"><span class="text-black-50">Situations</span> <i class="bi bi-chevron-down text-black-50"></i></a>
            <ul>
              <li><a href="{{ route('situations.globale') }}">Global</a></li>
              <li><a href="{{ route('situations.journaliere') }}">Journalière</a></li>
              <li><a href="{{ route('situations.moyen_transports') }}">Moyens de transport</a></li>
              <li><a href="{{ route('situations.coupons') }}">Coupons</a></li>
              <li><a href="{{ route('graphs.selection') }}">Données formation</a></li>
              <li><a href="{{ route('graphs.formation') }}">Données selection</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto text-black-50" href="{{ url('/mouvements') }}">Transport</a></li>
          <li class="dropdown "><a href="#" class="getstarted scrollto text-black-50"><span >Profile</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @if (Auth::user()->isAdmin())
              <li><a href="/register">Ajouter un
                utilisateur</a></li>
                @else
              <li><a href="/pw-edit">Modifier M.P</a></li>
              @endif
              <li> <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Se déconnecter
            </a> <form id="logout-form" action="{{ url('/logout') }}" method="POST"
            style="display: none;">
            {{ csrf_field() }}
        </form>
        </li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>SITUATIONS</h2>
        </div>

        <div class="row p-4">
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="{{ route('situations.globale') }}">Globale</a></h4>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-file-blank"></i></div>
              <h4><a href="{{ route('situations.journaliere') }}">Journalière</a></h4>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-bus"></i></div>
              <h4><a href="{{ route('situations.moyen_transports') }}">Moyens de transport</a></h4>
            </div>
          </div>
        </div>

        <div class="row p-4">
            <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box text-center">
                <div class="icon"><i class="bx bx-credit-card"></i></div>
                <h4><a href="{{ route('situations.coupons') }}">Coupons</a></h4>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box text-center">
                <div class="icon"><i class="bx bx-home"></i></div>
                <h4><a href="{{ route('graphs.selection') }}">Sélection</a></h4>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box text-center">
                <div class="icon"><i class="bx bxs-briefcase"></i></div>
                <h4><a href="{{ route('graphs.formation') }}">Formation</a></h4>
              </div>
            </div>
          </div>
      </div>
    </section><!-- End Services Section -->





  </main><!-- End #main -->



  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/aos/aos.js"></script>
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets1/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>

</body>

</html>
