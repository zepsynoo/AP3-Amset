<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<style>
    #menu {
        display: none;
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px 15px;
        cursor: pointer;
    }
</style>
<div class="heroe">

    <h1>Bienvenue sur la page D'accueil</h1>

    <h2>Page D'accueil </h2>
</div>
    <button onclick="toggleMenu()">Afficher le menu</button>
    <div id="menu">
        <ul>
            <li class="menu-item hidden"><a href="<?= url_to('salarie_liste') ?>">Salariés</a></li>
            <li class="menu-item hidden"><a href="<?= url_to('mission_liste') ?>">Mission</a></li>
            <li class="menu-item hidden"><a href="<?= url_to('client_liste') ?>">Clients</a></li>
            <li class="menu-item hidden"><a href="<?= url_to('profils_liste') ?>">Profils(V2)</a></li>
        </ul>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>


    </header>
    <!-- commencer le code ici  -->




    <?= $this->endSection() ?>