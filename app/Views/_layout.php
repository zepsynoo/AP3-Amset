<?php
$user = auth()->user();
$admin = $user && $user->inGroup('admin');
$com = $user && $user->inGroup('com');
$rhu = $user && $user->inGroup('rhu');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
    <!-- HEADER: MENU + HEROE SECTION -->
    <header>
        <div class="menue">
            <div>
                <nav>
                    <ul>
                        <li class="logo">
                            <a href="<?= url_to('accueil') ?>"><img src="<?= base_url('upload/amset.png') ?>"
                                    alt="Amset logo">
                            </a>
                        </li>
                        </li>
                        <?= $admin || $rhu ? '<li class="menu-item hidden"><a href="' . url_to('salarie_liste') . '">Salariés</a></li>' : '' ?>
                        <?= $admin || $com ? '<li class="menu-item hidden"><a href="' . url_to('mission_liste') . '">Missions</a></li>' : '' ?>
                        <?= $admin || $com ? '<li class="menu-item hidden"><a href="' . url_to('client_liste') . '">Clients</a></li>' : '' ?>
                        <?= $admin ? '<li class="menu-item hidden"><a href="' . url_to('profils_liste') . '">Profils</a></li>' : '' ?>
                        <li class="menu-item hidden"><a href="<?= url_to('logout') ?>">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <?= $this->renderSection('contenu') ?>

        <!-- footer en bas de la page -->
        <footer>

            <div class="copyrights">

                <p>&copy; <?= date('Y') ?> Amset Foundation. Amset is open source project released under the
                    MIT
                    open source licence.</p>

            </div>

        </footer>

</body>

</html>