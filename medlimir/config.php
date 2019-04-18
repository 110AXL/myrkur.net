<?php
/*** This config is located in the root folder and goes on every page ***/

// Start session
session_start();
// Define common places
define("ROOT_DIR",__DIR__);
define("CLASS_DIR",ROOT_DIR.'/core.processor/classes');
define("FUNCTIONS_DIR",ROOT_DIR.'/core.processor/functions');
// Require the page initializer class
require_once(CLASS_DIR."/class.HeaderProcessor.php");
// Initialize the autoloader for classes
// Load timezone
// You can put any other preset in this method
HeaderProcessor::initApp();
// Here is where you put in events like login, logout, etc...
HeaderProcessor::eventListener($_POST);
// Use this function to help load up classes
spl_autoload_register('autoLoader');
?>
