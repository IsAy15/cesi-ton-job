@extends('layouts.home')
@section('title', 'Contact')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Contact</h1>
            <form action="https://api.web3forms.com/submit" method="POST" class="form-v">
                <input type="hidden" name="access_key" value="bff74283-e893-450f-ba71-6c451066d92a">
                    <input type="text" name="name" placeholder="Prénom NOM" required>
                    <input type="email" name="email" placeholder="Email" required>
                <div>
                    <input type="text" name="phone" placeholder="Numero de téléphone">
                </div>
                <textarea name="message" cols="30" rows="10" placeholder="Votre message (Précisez votre objet en début de message)" required></textarea>
                <div class="captcha-container">
                    <div class="h-captcha" data-captcha="true"></div>
                </div>
                <input type="hidden" name="redirect" value="https://web3forms.com/success">
                <input type="submit" value="Envoyez mon message" class="btn-1">
                <script src="https://web3forms.com/client/script.js" async defer></script>
            </form>
    </div>
    <div class="container-1 default-bg fit-center">
        <h1>Informations de contact</h1>
        <p>Vous pouvez également nous contacter :</p>
        <p>par e-mail à l'adresse <a href="mailto:contact@ctj.fr">contact@ctj.fr</a></p>
        <p>ou par téléphone au <a href="tel:+33782735856">0782735857</a>.</p>
    </div>
@endsection
