<?php
/*
 * Archivo de configuraci�n de las clases que usaremos
 * Se llama desde Configure::getClass('NombreClase');
 */

/**
 * Engine:  Don't modify.
 */
//$config['factory']						=  PATH_ENGINE . 'factory.class.php';
//$config['sql']							=  PATH_ENGINE . 'sql.class.php';


$config['mail']							=  PATH_ENGINE . 'mail.class.php';
$config['session']						=  PATH_ENGINE . 'session.class.php';
$config['user']							=  PATH_ENGINE . 'user.class.php';
$config['url']							=  PATH_ENGINE . 'url.class.php';
$config['uploader']						=  PATH_ENGINE . 'uploader.class.php';


$config['dispatcher']					=  PATH_ENGINE . 'dispatcher.class.php';


/** 
 * Controllers & Models
 *
 */

// 404 Controller
$config['ErrorError404Controller']		= PATH_CONTROLLERS . 'error/error404.ctrl.php';

// Home Controller
$config['HomeHomeController']			= PATH_CONTROLLERS . 'home/home.ctrl.php';


// Pages Controller
$config['PagesPractica1Controller']		= PATH_CONTROLLERS . 'pages/practica1.ctrl.php';
$config['PagesPractica2Controller']		= PATH_CONTROLLERS . 'pages/practica2.ctrl.php';
$config['PagesFormulariController']		= PATH_CONTROLLERS . 'pages/formulari.ctrl.php';
$config['PagesGaleriaController']		= PATH_CONTROLLERS . 'pages/galeria.ctrl.php';
$config['PagesVentController']		    = PATH_CONTROLLERS . 'pages/vent.ctrl.php';
$config['PagesCordaController']		    = PATH_CONTROLLERS . 'pages/corda.ctrl.php';
$config['PagesPercussioController']	    = PATH_CONTROLLERS . 'pages/percussio.ctrl.php';

$config['PagesPractica3Controller']		= PATH_CONTROLLERS . 'pages/practica3.ctrl.php';


// Shared Controllers
$config['SharedHeadController']			= PATH_CONTROLLERS . 'shared/head.ctrl.php';
$config['SharedFooterController']		= PATH_CONTROLLERS . 'shared/footer.ctrl.php';
$config['SharedModul1Controller']		= PATH_CONTROLLERS . 'shared/modul1.ctrl.php';
$config['SharedModul1ProvaController']		= PATH_CONTROLLERS . 'shared/modul1Prova.ctrl.php';


//Pages Models
$config['PagesFormulariModel']          = PATH_MODELS . 'pages/formulari.model.php';
$config['PagesGaleriaModel']            = PATH_MODELS . 'pages/galeria.model.php';
$config['PagesPractica3Model']          = PATH_MODELS . 'pages/practica3.model.php';