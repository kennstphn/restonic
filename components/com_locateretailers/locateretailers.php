<?php
/**
 * @package    LocateRetailers
 * @subpackage Components
 * components/com_locateretailer/locateretailer.php
 * @link 		http://www.s-go.net
 * @license    GNU/GPL
*/
 
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Require the base controller
 
require_once( JPATH_COMPONENT.DS.'controller.php' );
 
// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// add scripts to <jdoc head >
$document =& JFactory::getDocument();
$document->addScript('http://maps.google.com/maps/api/js?sensor=false&region=US');
$document->addScript('components/com_locateretailers/assets/js/jquery-1.5.min.js');
$document->addScript('components/com_locateretailers/assets/js/locator.js');
$document->addStyleSheet('components/com_locateretailers/assets/css/locator.css');

 
// Create the controller
$classname    = 'LocateRetailersController'.$controller;
$controller   = new $classname( );
 
// Perform the Request task
$controller->execute( JRequest::getWord( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();