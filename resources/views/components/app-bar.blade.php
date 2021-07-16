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
            <img src="http://placehold.it/150x50?text=Logo" alt="">
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
                    <li class="nav-item">
                        <a class="nav-link">{{\Illuminate\Support\Facades\Auth::user()->email }}</a>
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
