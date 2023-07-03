<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('app.main')}}">ManualsBase</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('app.main')}}">Главная</a>
        </li>
        @if (auth()->user())
        @hasanyrole('user')
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('manuals.create') }}">Добавить инструкцию</a>
        </li>
        @endhasanyrole

        @hasrole('super-admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Консоль
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('products.list')}}">Устройства</a></li>
            <li><a class="dropdown-item" href="{{route('manuals.index')}}">Инструкции</a></li>
            <li><a class="dropdown-item" href="{{route('complaints.index')}}">Жалобы</a></li>
            <li><a class="dropdown-item" href="{{route('users.index')}}">Пользователи</a></li>
            <li><a class="dropdown-item" href="{{route('roles.index')}}">Роли</a></li>
            <li><a class="dropdown-item" href="{{route('permissions.index')}}">Права</a></li>
          </ul> 
                 
        </li>
        @endhasrole  
        @endif
       
      </ul>
      <ul class="navbar-nav d-flex align-items-center justify-content-end" style="margin-right:0">
            @if (auth()->user())
                        <li class="nav-item text-light mx-3">
                            {{ auth()->user()->name }}
                        </li>
                        <li class="nav-item text-light mx-3">

                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('auth.register') }}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('auth.login-page') }}">Войти</a>
                        </li>
              @endif
          </ul>
    </div>
  </div>
</nav>
</header>
