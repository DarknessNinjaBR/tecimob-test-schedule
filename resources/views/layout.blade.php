<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('/icon.png')}}">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
            <!-- Bootstap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="/">Agenda</a>
              @if (Route::has('login'))
                    @auth
                    <div class="d-flex">
                        <div class="d-grid gap-2">
                            <h5>Logado como <span class="badge bg-secondary">{{$userStatus->name}}</span></h5>
                            <a class="btn btn-sm btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="d-flex">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('login')}}" class="btn btn-success">Login</a>
                            <a href="{{route('register')}}" class="btn btn-primary">Registro</a>
                        </div>
                    </div>
                    @endauth
            @endif
                
              </div>
            </div>
          </nav>

        <header>

        </header>
        <div class="container-fluid">
<br/>
            @yield("content")

        </div>
        <footer>

        </footer>

         <!-- Bootstap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>
</html>
