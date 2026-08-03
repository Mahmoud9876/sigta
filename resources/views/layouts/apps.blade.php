<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{URL::asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{URL::asset('assets/css/style.css')}}" rel='stylesheet' type='text/css' media="all">
    <link href="{{URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/fonts/fonts.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type='image/jpg' href="{{URL::asset('images/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{URL::asset('assets/ajax/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/ajax/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/ajax/_all.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/ajax/select2.min.css')}}">
    <link rel="shortcut icon" type='image/ico' href="{{URL::asset('images/favicon.ico')}}"/>
    <script type="text/javascript" src="{{ asset('finexo/js/jquery-3.4.1.min.js') }}"></script>

    <script src="{{URL::asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/responsiveslides.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/adminlte.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery-jvectormap.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{URL::asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('assets/js/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/daterangepicker.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.knob.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/modernizr.js')}}"></script>
    <script>
    	//paste this code under head tag or in a seperate js file.
    	// Wait for window load
    	$(window).load(function() {
    		// Animate loader off screen
    		$(".se-pre-con").fadeOut("fast");
    	});
    </script>
    @yield('css')
</head>

<body class="skin-blue sidebar-mini" >
<div class="se-pre-con"></div>
<!-- Ends -->
  @include('layouts.sidebar')

  @if(Request::is(['assujettis*', 'situations*', 'mouvements*', '/', 'graphe*']))

  @endif


    <div id="page-content-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  @yield('content')
              </div>
          </div>
      </div>
    </div>

    @yield('scripts')
</body>
</html>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/notify.min.js') }}"></script>
<audio id="notification" src="{{asset('assets/audio/notification.mp3')}}" type="audio/mp3"></audio>
<script>
    var audio = document.getElementById("notification");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }

    Echo.private('events')
        .listen('AssujettiEvent', function (e) {
            if(e.operation == 'inc') {
                playAudio()
                $.notify(e.message, e.type)
                $('#'+e.centre+'-'+e.event).text(parseInt($('#'+e.centre+'-'+e.event).text())+1)
                $('#total-'+e.event).text(parseInt($('#total-'+e.event).text())+1)
            }

            if(e.operation == 'dec') {
                $('#'+e.centre+'-'+e.event).text(parseInt($('#'+e.centre+'-'+e.event).text())-1)
                $('#total-'+e.event).text(parseInt($('#total-'+e.event).text())-1)
            }
        }).listen('FormationEvent', function (e) {
            if(e.formation != '') {
                console.log('#'+e.id+'-'+e.event)
                $.notify(e.message, e.type)
                $('#'+e.id).text(parseInt($('#'+e.id).text())+1)
                $('#'+e.formation+'-total').text(parseInt($('#'+e.formation+'-total').text())+1)
            }
            if(e.old_formation != null || e.formation == '') {
                $("#"+e.old_id).text(parseInt($("#"+e.old_id).text())-1)
                $('#'+e.old_formation+'-total').text(parseInt($('#'+e.old_formation+'-total').text())-1)
            }
        }).listen('TransportEvent', function(e) {
            if(e.sntl == 'SNTL' || e.sntl == 'GT') {
                $('#'+e.selection+'-'+e.sntl).text(parseInt($('#'+e.selection+'-'+e.sntl).text())+1)
                $('#'+e.sntl+'-total').text(parseInt($('#'+e.sntl+'-total').text())+1)
            }

            if(e.old == 'SNTL' || e.old == 'GT' ) {
                $("#"+e.selection+'-'+e.old).text(parseInt($("#"+e.selection+'-'+e.old).text())-1)
                $('#'+e.old+'-total').text(parseInt($('#'+e.old+'-total').text())-1)
            }
        });
</script>
<script>
    $(document).ready( function () {
      $("[rel=tooltip]").tooltip({ placement: 'top'});

    });

</script>
