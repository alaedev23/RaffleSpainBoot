<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_set_cookie_params(0);

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once 'classes/Config/Autoloader.php';
spl_autoload_register("Autoloader::load");
spl_autoload_register("Autoloader::newload");

session_start();

try {
    $cFront = new FrontController();
    $cFront->dispatch();
} catch (Exception $e) {
    $vError = new ErrorView();
    $vError->show($e);
}