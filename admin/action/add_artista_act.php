<?php
require_once '../../includes/utilities/controllers/autoloader.php';

$postData = $_POST;
$fileData = $_FILES['imagen'];


// echo "<pre>";
// print_r($postData);
// echo "</pre>";

// echo "<pre>";
// print_r($fileData);
// echo "</pre>";

try{
    $imagen = Imagen::subirImagen("../../public/images/artistas/", $fileData);
    $artistaId = Artista::insert(
        $postData['name'],
        $postData['biografy'],
        $postData['estilo'],
        $postData['critica'],
        $imagen
    );

    $anoFallecimiento = !empty($postData['ano_fallecimiento']) ? $postData['ano_fallecimiento'] : null;
    DetallesArtista::insert(
        $artistaId,
        $postData['premiacion'],
        $postData['curiosidad'],
        $postData['ano_inicio'],
        $anoFallecimiento,
        $postData['nacionalidad']
    );

    Flags::add_flags('success', "El artista <strong>{$postData['name']}</strong> se ha creado correctamente.");

    header('Location: ../index.php?section=admin_artista');
} catch (Exception $e){
    // echo "<pre>";
    // print_r($e);
    // echo "</pre>";
    // die('No consguimos cargar el artista informado');
    Flags::add_flags('danger', "No se pudo cargar el artista. Error: " . " " . $e->getMessage());
}

