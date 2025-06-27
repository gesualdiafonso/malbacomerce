<?php
require_once '../../includes/utilities/controllers/autoloader.php';

$id = $_POST['id'] ?? FALSE;

echo "<pre>";
print_r($id);
echo "</pre>";

try {
    $tecnia = Tecnica::getTecnicaId((int)$id);
    $tecnia->delete();

    Flags::add_flags('success', "La técnica se ha eliminado correctamente.");

    header('Location: ../index.php?section=admin_tecnica');
    exit;
} catch (Exception $e) {
    Flags::add_flags('danger', "No se pudo eliminar la técnica. Error: " . $e->getMessage());
    header('Location: ../index.php?section=admin_tecnica'); // opcional
}


