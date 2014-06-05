<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Info Factory</title>
  {{HTML::script('/assets/javascript/script.js');}}
  {{HTML::script('js/jquery.min.js');}}
  {{HTML::script('js/bootstrap.min.js');}}
  {{HTML::style('/bootstrap/css/bootstrap.min.css');}}
  {{HTML::style('/assets/css/general.css');}}
  {{HTML::style('/css/main.css');}}
</head>
<body style="margin-top: 25px">
  <header>
      <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <a class="navbar-brand" href="Inicio"><div style="margin-top:-9%;">{{HTML::image('/images/logo.png');}}</div></a>
        <ul class="nav navbar-nav navbar-left">
          <li class="dropdown">
            {{link_to('Inicio', 'Inicio', $attributes = array(), $secure = null)}}
          </li>

          <li class="dropdown">
            {{link_to('#', 'Información', $attributes = array(), $secure = null)}}
          </li>

          @if (Auth::user())
            @if (Auth::user()->tipo == 'cliente')
          	<li class="dropdown">
            	{{link_to('Encuestas', 'Mis Encuestas', $attributes = array(), $secure = null)}}
          	</li>
            <li class="dropdown">
              {{link_to('#', 'Resultados', $attributes = array(), $secure = null)}}
            </li>
            @else
              @if (Auth::user()->tipo == 'panelista')
                <li class="dropdown">
                  {{link_to('MisEncuestas', 'Contestar Encuestas', $attributes = array(), $secure = null)}}
                </li>
              @else
                <li class="dropdown">
                  {{link_to('#', 'Usuarios', $attributes = array(), $secure = null)}}
                </li>
                <li class="dropdown">
                  {{link_to_route('Encuestas.todas', 'Encuestas', $attributes = array(), $secure = null)}}
                </li>
                <li class="dropdown">
                  {{link_to('#', 'Resultados', $attributes = array(), $secure = null)}}
                </li>
              @endif
            @endif
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');}}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{HTML::script('js/bootstrap.min.js');}}
</body>
</html>