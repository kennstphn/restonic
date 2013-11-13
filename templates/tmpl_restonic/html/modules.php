<?php
/**
 * @package     Joomla
 * @subpackage  Restonic2
 * 
 * @copyright   Copyright (c) 2012 - 2013
 * @license GNU General Public License Version 2 or Later
 */

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a submenu
 */

function modChrome_background($module, &$params, &$attribs)
{
	echo '<div>';
	echo    '<img src="'.$params->get('backgroundimage').'"/>';
	echo     '<div class="container">';
	echo        '<div class="in-slide-content">';
	echo            '<div class="slide-text" id="' . $params->get('moduleclass_sfx') . '">';
	echo                trim(strip_tags($module->content, '<h1><h2><h3><h4><span><p><b><strong>'));
	echo            '</div>';
	echo        '</div>';
	echo    '</div>';
	echo '</div>';
}
