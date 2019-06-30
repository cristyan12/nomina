
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <span class="navbar-brand mb-0 h1">
            <a class="navbar-brand" href="{{ url('/') }}">
                Sistema de nómina
            </a>
        </span>
        <button class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarText" 
            aria-controls="navbarText" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse float-right" id="navbarText">
            <ul class="navbar-nav mr-auto">
            @include('layouts._auth')
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
      <div class="row">

        @include('layouts._sidebar')
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between align-items-end pt-5 pb-2 mb-3">    
                @section('title')
                @show
            </div>
            @include('layouts._messages')
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
