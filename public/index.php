<?php

// Error Reporting
error_reporting(E_ALL); // Report all errors (E_ALL, E_ERROR)
ini_set('display_errors', 1); // 0 = hide, 1 = display all errors
// short_open_tag set in php.ini

// Set Time Zone
putenv("TZ=America/Detroit"); // Retrieve from db
date_default_timezone_set('America/Detroit');
setlocale(LC_MONETARY, 'en_US');

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
