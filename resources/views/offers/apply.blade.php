<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler</title>
</head>
<body>
    <h1>Postuler à l'offre "{{ $offer->title }}" de {{ $offer->company->name }}</h1>

    <form action="{{ route('offers.apply', $offer->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="cv">CV:</label><br>
        <input type="file" id="cv" name="cv"><br><br>

        <label for="letter">Lettre de motivation:</label><br>
        <input type="file" id="letter" name="letter"><br><br>
        
        <button type="submit">Postuler</button>
    </form>
</body>
</html>
