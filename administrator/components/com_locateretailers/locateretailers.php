<?php

// no direct access
defined('_JEXEC') or die;

// instantiate the controller
$controller = JControllerLegacy::getInstance('LocateRetailers');

$controller->execute('locateretailers');

$controller->redirect();

?>