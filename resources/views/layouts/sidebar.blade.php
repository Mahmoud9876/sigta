<div class="container">
    <div class="header-bar">
        <nav class="navbar navbar-default ">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ env('APP_NAME') }}
                    </a>
                </h1>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav>
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('acceuil') ? 'active' : '' }}"><a href="{{ url('/') }}"><span
                                    class="fa fa-home banner-nav" aria-hidden="true"></span>Accueil</a></li>
                        <li class="{{ Request::is('assujettis*') ? 'active' : '' }}"><a
                                href="{{ url('/assujettis') }}"><span class="fa fa-file banner-nav"
                                    aria-hidden="true"></span>ASSUJETTIS</a></li>
                        <li class="{{ Request::is(['codes', 'icons']) ? 'active' : '' }}" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                    class="fa fa-file-o banner-nav" aria-hidden="true"></span>SITUATIONS<span
                                    class="badge badge-danger"></span><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('situations.globale') }}">GLOBALE<span
                                            class="badge badge-success"></span></a>
                                </li>
                                <li>
                                    <a href="{{ route('situations.journaliere') }}">JOURNALIERE</a>
                                </li>
                                <li>
                                    <a href="{{ route('situations.moyen_transports') }}">M. TRANSPORT</a>
                                </li>
                                <li>
                                    <a href="{{ route('situations.coupons') }}">COUPONS</a>
                                </li>
                                <li>
                                    <a href="{{ route('graphs.selection') }}">DONNEES SELECTION</a>
                                </li>
                                <li>
                                    <a href="{{ route('graphs.formation') }}">DONNEES FORMATION</a>
                                </li>
				@if(Auth::user()->isAdmin())
                                <li>
                                    <a href="{{ route('situation.generale') }}">SITUATION </a>
                                </li>
				@endif
                            </ul>
                        </li>
                        <li class="{{ Request::is('mouvements*') ? 'active' : '' }}"><a
                                href="{{ url('/mouvements') }}"><span class="fa fa-truck banner-nav"
                                    aria-hidden="true"></span>Mouvements</a></li>

                        <li class="{{ Request::is('profil') ? 'active' : '' }}" class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><span
                                    class="fa fa-user banner-nav" aria-hidden="true"></span>Profile<span
                                    class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img width="50" height="50" src="{{ URL::asset('/images/logo.jpg') }}"
                                        class="img-circle" alt="User Image" />
                                    <p>

                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer ">
                                    <div class="container" style="width: 350px; height: 50px;">
                                        @if (Auth::user()->isAdmin())
                                            <div class="pull-left">
                                                <a href="/register" class="btn btn-default btn-flat">Ajouter
                                                    utilisateur</a>
                                            </div>
                                        @else
                                            <div class="pull-left">
                                                <a href="/pw-edit" class="btn btn-default btn-flat">Modifier M.P</a>
                                            </div>
                                            {{ Auth::user()->centre }}
                                        @endif
                                        <div class="pull-right ">
                                            <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Se déconnecter
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <div class="clearfix"> </div>
</div>
