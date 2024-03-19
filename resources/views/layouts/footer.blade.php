@yield('footer')
@vite('resources/css/footer.css')
<footer>
        <div class="footer-link">
            <a class="footer-button" href="#">A Propos</a>
            <p>|<p>
            <a class="footer-button" href="{{ route('policy')}}">Politique De Confidentialité</a>
            <p>|<p>
            <a class="footer-button" href="#">Contact</a>
        </div>
        <div id="Copyright">
            <p>CESI Ton Job &copy; <script>document.write(new Date().getFullYear());
            </script></p>
        </div>
    </footer>