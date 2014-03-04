<?php
/**
 * @package     Joomla
 * @subpackage  mkejug
 * 
 * @copyright   Copyright (c) 2012 - 2013
 * @license GNU General Public License Version 2 or Later
 */

defined('_JEXEC') or die;


abstract class tmpHelper
{
    public function pageType()
    {
        $app = JFactory::getApplication();
        $menu = $app->getMenu();

        if ($menu->getActive() == $menu->getDefault())
        {
            // do a check and return false as a classname
            return 'home';
        }

        // this should never get hit but just incase, assume its not the homepage
        return 'inside';

    }

	public function removeJS()
	{
		$doc = JFactory::getDocument();
		$doc->unset($doc->_scripts[JURI::base() . '/media/jui/js/jquery.min.js']);
	}

	public function getPageSuffix()
	{

		$app = JFactory::getApplication();
		$menu = $app->getMenu();

		$active = $menu->getActive();

		// get the active page title
		if (! is_object( $active )) {
			return;
		}

		$suffix = $active->params->get('pageclass_sfx');

		return $suffix;
	}
}