<style>

</style>
<div class="app-bar" style="display: none">
    <div class="boxed">
        Changia

        @if (Route::has('login'))
        @endif

    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/jaf-logo.svg') }}" height="50" alt="Changia">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ \Illuminate\Support\Facades\Route::current()->getName() === 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item {{ \Illuminate\Support\Facades\Route::current()->getName() === 'about' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">About Changia
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                @if (Auth::check())
                    <li class="nav-item {{ \Illuminate\Support\Facades\Route::current()->getName() === 'client_entreaties' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client_entreaties') }}">My Entreaties
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->email ?? 'User' }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
