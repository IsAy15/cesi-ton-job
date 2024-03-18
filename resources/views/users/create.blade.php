<!DOCTYPE html>
<html>
<head>
    <title>Créer un utilisateur</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Créer un utilisateur</h1>

    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <label for="lastname">Nom:</label><br>
        <input type="text" id="lastname" name="lastname"><br>
        <label for="firstname">Prénom:</label><br>
        <input type="text" id="firstname" name="firstname"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="role">Rôle:</label><br>
        <select id="role" name="role">
            <option value="admin">Admin</option>
            <option value="users">User</option>
            <option value="pilote">Pilote</option>
        </select><br><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password"><br><br>
        
        <!-- Titre de la promotion -->
        <label id="promotionLabel" for="promotion" style="display:none;">Promotion:</label><br>

        <!-- Sélection de la promotion -->
        <select id="promotion" name="promotion" style="display:none;">
            @foreach($promotions as $promotion)
                <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Créer</button>
    </form>
    <script>
        window.onload = function() {
            var roleSelect = document.getElementById('role');
            var promotionLabel = document.getElementById('promotionLabel');
            var promotionSelect = document.getElementById('promotion');

            // Écouter les changements dans la sélection de rôle
            roleSelect.addEventListener('change', function() {
                // Vérifier si le rôle sélectionné est "admin"
                if (roleSelect.value === 'admin') {
                    // Masquer le champ de sélection de promotion et son titre
                    promotionLabel.style.display = 'none';
                    promotionSelect.style.display = 'none';
                } else {
                    // Afficher le champ de sélection de promotion et son titre
                    promotionLabel.style.display = 'block';
                    promotionSelect.style.display = 'block';
                }
            });
        };
    </script>
</body>
</html>
