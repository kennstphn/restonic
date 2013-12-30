<?php
/**
 * @package    Locate Retailer
 * @subpackage Components
 * @link http	http://www.s-go.net
 * @license    GNU/GPL
*/
 
// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );

 
/**
 * HTML View class for the LocateRetailers Component
 *
 * @package    LocateRetailers
 */
 
class LocateRetailersViewLocateRetailers extends JViewLegacy
{
    function display($tpl = null)
    {
        $model = $this->getModel();
        $rows = $model->getLocations('321');
        print_r($rows);

        parent::display($tpl);
    }
}