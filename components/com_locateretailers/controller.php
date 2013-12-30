<?php
/**
 * @package    LocateRetailers
 * @subpackage Components
 * @link 	http://www.s-go.net
 * @license    GNU/GPL
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );

 
/**
 * Locate Retailer Component Controller
 *
 * @package    LocateRetailers
 * @subpackage Components
 */
class LocateRetailersController extends JControllerLegacy
{
    protected $default_view = 'locateretailers';

    /**
     * @var         string        the default view
     * @since        1.6
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * Display a view
     *
     * @param bool $cachable
     * @param bool $urlparams
     */
    public function display($cachable = false, $urlparams = false)
    {
        parent::display();
    }
}