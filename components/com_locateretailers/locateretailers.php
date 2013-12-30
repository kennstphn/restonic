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

// Load classes
JLoader::registerPrefix('LocateRetailer', JPATH_COMPONENT);

// Application
$app = JFactory::getApplication();

$input = $app->input;

// add scripts to <jdoc head >
$doc = JFactory::getDocument();
$doc->addScript('http://maps.google.com/maps/api/js?sensor=false&region=US');
// $doc->addScript('components/com_locateretailers/assets/js/jquery-1.5.min.js');
$doc->addScript('components/com_locateretailers/assets/js/locator.js');
$doc->addStyleSheet('components/com_locateretailers/assets/css/locateretailers.css');


// instantiate the controller
$controller = JControllerLegacy::getInstance('LocateRetailers');

$controller->execute($app->input->get('task'));

$controller->redirect();