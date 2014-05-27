<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Info Factory</title>
  <script type="text/javascript" src="/assets/javascript/script.js"></script>
  <script type="text/javascript" src="/assets/javascript/datetimepicker.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  {{HTML::style('/bootstrap/css/bootstrap.min.css');}}
  {{HTML::style('/assets/css/general.css');}}
  {{HTML::style('/bootstrap/css/css/bootstrap.min.css');}}
  {{HTML::style('/css/main.css');}}
</head>
<body style="margin-top: 25px">
  <header>
      <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <a class="navbar-brand" href="Inicio"> {{HTML::image('/images/icon.png');}} Info Factory</a>
        <ul class="nav navbar-nav navbar-left">
          <li class="dropdown">
            {{link_to('Inicio', 'Inicio', $attributes = array(), $secure = null)}}
          </li>

          <li class="dropdown">
            {{link_to('#', 'Información', $attributes = array(), $secure = null)}}
          </li>

          @if (Auth::user())
          	<li class="dropdown">
            	{{link_to('#', 'Mis Encuestas', $attributes = array(), $secure = null)}}
          	</li>
          @endif
        </ul>
        @if (Auth::user())
            <p class="navbar-text navbar-right" style="margin-right: 1em;">{{link_to('Logout', 'Salir', $attributes = array(), $secure = null)}}</p>
            <p class="navbar-text navbar-right" style="margin-right: 1em;">{{link_to('Usuarios/'.Auth::user()->id, Auth::user()->username, $attributes = array(), $secure = null)}}</p>
        @else
            <p class="navbar-text navbar-right" style="margin-right: 1em;">{{link_to('Registro', 'Registrarse', $attributes = array(), $secure = null)}}</p>
            <p class="navbar-text navbar-right" style="margin-right: 1em;">{{link_to('Login', 'Ingresar', $attributes = array(), $secure = null)}}</p>
        @endif
      </nav>
    </header>
  <div class="container col-md-8 col-md-offset-2">
    @yield('main')
  </div>
</body>
</html>