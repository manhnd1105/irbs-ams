<?php

/*
 *---------------------------------------------------------------
 * OVERRIDE FUNCTIONS
 *---------------------------------------------------------------
 *
 * This will "override" later functions meant to be defined
 * in core\Common.php, so they throw erros instead of output strings
 */

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
{
	throw new PHPUnit_Framework_Exception($message, $status_code);
}

function show_404($page = '', $log_error = TRUE)
{
	throw new PHPUnit_Framework_Exception($page, 404);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP
 *---------------------------------------------------------------
 *
 * Bootstrap CodeIgniter from index.php as usual
 */

require_once __DIR__ . '/../../../index.php';

/*
 * This will autoload controllers inside subfolders
 */ 
//spl_autoload_register(function ($class) {
//	foreach (glob(APPPATH .'modules/account/controllers/'.strtolower($class).'.php') as $controller) {
//		require_once $controller;
//	}
//});
//}