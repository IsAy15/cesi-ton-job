<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('admin.pilotes.index') }}">Utilisateurs</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div>
            <p>CESI Ton Job &copy; 2024</p>
        </div>
        <div>
            <a href="{{ route('policy')}}">Politique de confidentialité</a>
        </div>
    </footer>
</body>
</html>