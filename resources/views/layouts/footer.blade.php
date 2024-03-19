@yield('footer')
@vite('resources/css/footer.css')
<footer>
        <div class="footer-link">
            <a href="#">A Propos</a>
            <p>|<p>
            <a href="{{ route('policy')}}">Politique De Confidentialité</a>
            <p>|<p>
            <a href="#">Contact</a>
        </div>
        <div id="Copyright">
            <p>CESI Ton Job &copy; <script>document.write(new Date().getFullYear());
            </script></p>
        </div>
    </footer>