<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des entreprises
    </title>
</head>
<body>
    <h1>Liste des entreprises</h1>
    <a href="{{ route('companies.create') }}">Ajouter une entreprise</a>
    @foreach ($companies as $company)
        <div class="company">
            <div class="infos">
                <h2>{{ $company->cp_name }}</h2>
                <p>{{ $company->cp_sector }}</p>
                <p>{{ $company->cp_localization }}</p>
            </div>
            <div class="actions">
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>