
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Nómina v-0.01</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Sistema de nómina</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('positions.index') }}">
                  <span data-feather="file"></span>
                  Tabulador de cargos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('branches.index') }}">
                  <span data-feather="file"></span>
                  Sucursales
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('departments.index') }}">
                  <span data-feather="file"></span>
                  Departamentos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('units.index') }}">
                  <span data-feather="bar-chart-2"></span>
                  Unidades
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('professions.index') }}">
                  <span data-feather="layers"></span>
                  Profesiones
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Sistemas de Nómina
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-end pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            @include('layouts.messages')
            @yield('content')
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Icons -->
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
