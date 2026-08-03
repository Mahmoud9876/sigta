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

  <!-- =======================================================
  * Template Name: Arsha - v4.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/">SIGTA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets1/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Accueil</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/assujettis') }}">Assujettis</a></li>

          <li class="dropdown"><a href="#"><span>Situations</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('situations.globale') }}">Global</a></li>
              <li><a href="{{ route('situations.journaliere') }}">Journalière</a></li>
              <li><a href="{{ route('situations.moyen_transports') }}">Moyens de transport</a></li>
              <li><a href="{{ route('situations.coupons') }}">Coupons</a></li>
              <li><a href="{{ route('graphs.selection') }}">Données formation</a></li>
              <li><a href="{{ route('graphs.formation') }}">Données selection</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="{{ url('/mouvements') }}">Mouvements</a></li>
          <li class="dropdown "><a href="#" class="getstarted scrollto"><span >Profile</span> <i class="bi bi-chevron-down"></i></a>
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
          {{-- <li><a class="getstarted scrollto" href="#about">Profile</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">8

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>SYSTEME D'INFORMATION DE GESTION DU TRANSPORT DES APPELES</h1>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets1/img/Image3.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">





    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
        </div>

        <div class="row">
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bxs-file"></i></div>
              <h4><a href="{{ url('/assujettis') }}">Liste des assujetis</a></h4>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bxs-car"></i></div>
              <h4><a href="{{ url('/mouvements') }}">Mouvements</a></h4>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 " data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="{{ url('/situations') }}">Situations</a></h4>
            </div>
          </div>



        </div>

      </div>
    </section><!-- End Services Section -->





  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">





    <div class="container footer-bottom clearfix">
      <div class="copyright">
     <strong><span></span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
         <a href=""></a>
      </div>



    </div>
  </footer><!-- End Footer -->

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
