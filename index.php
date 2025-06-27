<?php
$isAdminContext = false; 
require_once 'includes/utilities/controllers/autoloader.php';


$section = isset($_GET['section']) ? $_GET['section'] : 'home';
$filter = isset($_GET['filter']) ? $_GET['filter'] : null;
$artistaSelecionado = isset($_GET['artist']) ? $_GET['artist'] : null;

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";


// $artistaSelecionado = isset($_GET['artista']) ? $_GET['artista'] : null;

$views = View::validate_views($section);


if($section == 'category'){
    if($filter){
        $obras = Categoria::getCategoriaId($filter);
    }
} elseif ($section == 'artista'){
    if($artistaSelecionado){
        $artista = Artista::getById($artistaSelecionado);
    }
} else{
    $galeriaCompleta = Obras::galeria_completa();
}

$listaArtista = Artista::artistas();
$listaCategoria = Categoria::all_categoria();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Control SEO -->
    <meta name="description" content="<?= $views->getDescription(); ?>">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.23.6/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.23.6/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.23.6/dist/js/uikit-icons.min.js"></script>

    <!-- Links Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Links css global -->
    <link rel="stylesheet" href="public/style/global.css">

    <link rel="shortcut icon" href="public/assets/ICONO.svg" type="image/x-icon">

    <title><?= $views->getTitle(); ?></title>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <!-- Navbar Desktop -->
        <nav class="uk-container border" uk-navbar>
            <div class="uk-navbar-left">
                <a href="index.php?section=home" class="uk-navbar-item uk-logo">
                    <h1 class="logo">MALBA</h1>
                    <img class="uk-box-shadow-hover-xlarge" src="public/images/logo_malba.png" alt="Logo Lettering Personalizado Malba" style="max-height: 50px;">
                </a>
            </div>

            <!-- menu desktop -->
            <div class="uk-navbar-right uk-visible@l">
                <ul class="uk-navbar-nav">
                    <li class="uk-active"><a href="index.php?section=home">Home</a></li>
                    <li><a href="index.php?section=about">Nosotros</a></li>
                    <li><a href="index.php?section=galery">Galeria</a></li>
                    
                    <li>
                        <a href="#">Artistas</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-nav-divider">
                                <?php foreach($listaArtista as $art) { ?>
                                    <li><a href="index.php?section=artista&artist=<?= $art->getId(); ?>"> <?= $art->getName(); ?> </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#">Categorias</a> 
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-nav-divider">
                                <?php foreach($listaCategoria as $cat) { ?>
                                    <li><a href="index.php?section=category&filter=<?= $cat->getId(); ?>"> <?= $cat->getName(); ?> </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <li><a href="index.php?section=envio">Envios</a></li>
                    <li>
                        <a href="#">Team Malba</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav uk-nav-divider">
                                <li><a href="index.php?section=dev">Dessarrollador</a></li>
                                <li><a href="admin/index.php?section=dashboard">Malba Painel</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="index.php?section=login" class="uk-button uk-text-warning">Iniciar Sesión</a></li>
                </ul>
            </div>

            <!-- Botão Hamburguer (Mobile) -->
            <div class="uk-navbar-right uk-hidden@l">
                <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-toggle="target: #mobile-menu">
                    <span uk-navbar-toggle-icon></span>
                </a>
            </div>

            <!-- Offcanvas Menu -->
            <div id="mobile-menu" uk-offcanvas="overlay: true; flip: true">
                <div class="uk-offcanvas-bar uk-flex uk-flex-column">
                    <button class="uk-offcanvas-close" type="button" uk-close></button>

                    <ul class="uk-nav uk-nav-default" uk-nav>
                        <li class="uk-active"><a href="index.php?section=home">Home</a></li>
                        <li><a href="index.php?section=about">Nosotros</a></li>
                        <li><a href="index.php?section=galery">Galeria</a></li>

                        <li class="uk-parent">
                            <a href="#">Artistas</a>
                            <ul class="uk-nav-sub">
                                <?php foreach($listaArtista as $art) { ?>
                                    <li><a href="index.php?section=artista&artist=<?= $art->getId(); ?>"> <?= $art->getName(); ?> </a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="uk-parent">
                            <a href="#">Categorias</a> 
                            <ul class="uk-nav-sub"">
                                <?php foreach($listaCategoria as $cat) { ?>
                                    <li><a href="index.php?section=category&filter=<?= $cat->getId(); ?>"> <?= $cat->getName(); ?> </a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="index.php?section=envio">Envios</a></li>
                        <li><a href="index.php?section=dev">Dessarrollador</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    

    <main class="uk-container ">
        <?php require_once("views/{$views->getName()}.php"); ?>
    </main>


    <footer class="footer">
        <section class=" uk-container uk-flex uk-flex-wrap uk-flex-around border uk-padding-small">
            <div class="uk-width-1-1@s uk-width-1-3@m uk-text-center">
                <img class="uk-align-center" src="public/images/logoMalba_completo.png" alt="Logo completo de Malba Museo de arte Latino Americano de Buenos Aires." style="max-width: 200px;">
            </div>
            <div class="uk-width-1-1@s uk-width-1-3@m">
                <ul class="uk-nav uk-nav-default uk-nav-parent-icon uk-text-center" uk-nav>
                    <li><a href="index.php?section=home">Home</a></li>
                    <li><a href="index.php?section=about">Nosotros</a></li>
                    <li><a href="index.php?section=galery">Galeria</a></li>
                </ul>
            </div>
            <div class="uk-width-1-1@s uk-width-1-3@m uk-text-left">
                <p>Av. Figueroa Alcorta 3415<br>C1425CLA Buenos Aires, Argentina</p>
                <p>Parcial de Programación 2</p>
                <p>Docente: Jorge Ernesto Perez</p>
            </div>
        </section>

        <!-- Direitos autorais-->
        <section class="uk-container border uk-padding-small">
            <div class="content-copy">
                <p class="">© Fundación MALBA</p>
                <p class="">Todos los derechos reservados</p>
            </div>
        </section>


    </footer>

    <script src="public/scripts/validate.js"></script>
    <script src="public/scripts/filter.js"></script>
</body>
</html>