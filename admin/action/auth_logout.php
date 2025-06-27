<?php
require_once '../../includes/utilities/controllers/autoloader.php';

Autentication::log_out();

header('Location: ../index.php?section=login');