<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/general.css')
    @cookieconsentscripts
</head>
<body>
    <header>
        <div class="logo" onclick="window.location = '{{ route('welcome') }}'">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2090 2090" width="3rem">
                <style>
                        .s0 { fill: #ffffff } 
                        .s1 { fill: #fefefe } 
                </style>
                <path id="Layer" class="s0" d="m-0.3 1354c-0.1-53.3 2.7-180.9 8.4-189.9 6.4-10.4 15.8-16.5 28.6-16.5 65 0.1 130 0.5 195-0.2 17.3-0.2 38 14.8 38.3 34.3 0.1 6.9-0.7 104.6 0.7 146.6 1.1 36 4.7 71.9 13.5 107.3 8.1 32.8 22 63.1 36.7 93.1 17.8 36.3 42.5 67.2 69.7 96.7 33.2 36.1 72.3 64.5 113 91.1 12.5 8.2 24.8 16.8 38 23.8 17.5 9.3 35.4 18.1 53.8 25.3 21.9 8.6 44.3 15.9 66.9 22.3 15.9 4.5 32.3 6.9 48.6 9.7 14.4 2.4 28.8 4.3 43.3 5.8 11.2 1.2 22.5 1.9 33.7 2.2 15.4 0.3 30.7 0 46 0.1 24 0.1 47.7-1.4 71.4-5.1 23.5-3.8 47.3-5.9 70.6-10.7 19.3-4 38-11.2 57.1-16.5 31.9-8.9 61.4-23.1 90.5-38.2 31.9-16.6 61.7-36.6 89.5-59.5 13-10.8 26.1-21.6 38-33.6 13.3-13.4 25.9-27.7 37.7-42.5 20.3-25.4 38.5-52.3 53-81.6 13.5-27.4 23.2-56.1 27.8-86.3 2.3-15.4 2.6-31.1 5-46.4 3-19.6 0.4-39.3 2-58.8 4-51.2 1.5-102.4 1.7-153.6 0.4-164.3 1.2-930.3 1.1-933.7-8.1 0-868.2 0.1-885.5 0.1-24.9 0-46.8-19.7-49.4-44.4-0.5-4.3-1.4-95.6-0.5-136.9 0.5-22 9.3-40.9 30.2-51.2 7.1-3.6 26.3-6.1 27.6-6.1q767.5 0 1535 0c30.4 0 51.6 21.4 51.6 52.2q0 66 0 132c0 24.5-12.4 42.3-35.2 51-8.1 3.1-28.9 3.4-30.9 3.4-116.6 0-356.4 0-360.5 0 0 4.9-0.1 877.7 0.1 1106.7 0.1 19.3-2.8 38.3-4.4 57.4-1.9 22-6 43.9-9 65.9-3.8 27.6-10.2 54.5-19.5 80.8-6.2 17.2-10.8 34.9-17.5 51.8-6.7 16.9-15.1 33.2-23 49.6-14.3 29.3-30.1 57.8-49.4 84-22.1 29.9-44 60.1-68.1 88.4-49.8 58.5-109 106.1-176.3 144.7-47.6 28.2-97.6 49.5-149.2 67.1-40.2 13.7-81.1 24.7-122.9 32.5-29.6 5.5-110.8 21.8-161.3 22.1-50.5 0.3-154.2-8.3-181.8-12-57.3-7.6-113.3-21.2-168.4-38.6-68.6-21.8-133.6-51.6-194.1-90.8-34.9-22.6-67.4-48.3-97.8-77-39.6-37.4-74.2-79-104-124.5-34.1-52.2-61.6-107.7-81.9-166.7-8.2-23.8-15.7-47.8-21.8-72.2-4.1-16.9-11.7-120.2-11.7-154.5z"/>
                <path id="Layer" class="s1" d="m261.3 187c-8.8 22.6-24.7 36.3-47 43.5-20.4 6.7-41.3 9.4-62.6 9.7-16 0.3-32 0.3-48-0.7-17.8-1-35.4-4.1-52.4-10.4-25.2-9.3-38.6-28.2-45-53.1-5.1-20-7-40.6-5.8-61.2 1.2-21 2.8-42.1 11.3-62.1 6.9-16.3 17.2-28.9 33.5-36.4 15.1-7.1 31-10.9 47.6-12.9 17.9-2.2 35.7-3.7 53.6-2.9 22.5 1 44.9 3 66.7 9.5 31.5 9.3 48.5 30.9 54.5 62.3 5.9 30.9 5.2 62-0.1 93-1.3 7.1-3.9 14-6.3 21.7z"/>
            </svg>
        </div>
        <nav class="navbar">
            @if (Auth::check())
                <div class="nav-menu profile">
                    <div class="nav-menu-content" id="profile-link">
                        <i class="fa-solid fa-user"></i>
                        <span>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="{{ route('profile.index') }}">Profil</a></li>
                        @if (Auth::user()->role == 'admin')
                            <li><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                            <li><a href="{{ route('companies.index') }}">Entreprises</a></li>
                            <li><a href="{{ route('offers.index') }}">Offres</a></li>
                            <li><a href="{{ route('promotions.index') }}">Promotions</a></li>
                        @endif
                        <li>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <a href="#" onclick="document.getElementById('logout-form').submit();">Déconnexion</a>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="nav-menu offer">
                    <div class="nav-menu-content" href="{{ route('profile.offers') }}">
                        <i class="fa-solid fa-suitcase"></i>
                        <span>Vos offres</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="{{ route('profile.offers') }}">Voir mes offres</a></li>
                        <li><a href="{{ route('offers.index') }}">Voir toutes les offres</a></li>
                    @if (Auth::user()->role == 'admin')
                        <li><a href="{{ route('offers.create') }}">Ajouter une offre</a></li>
                    @endif
                    </ul>
                </div>
                <div class="nav-menu wishlist">
                    <a class="nav-menu-content" href="{{ route('profile.wishlist') }}">
                        <i class="fa-solid fa-heart"></i>
                        <span>Wishlist</span>
                    </a>
                </div>
            @endif             
        </nav>
    </header>
    <main>
        @yield('content')
        @cookieconsentview
    </main>
    @extends('layouts.footer')
    @yield('footer')
</body>
</html>