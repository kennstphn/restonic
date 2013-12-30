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
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        $doc->setMimeEncoding('application/json');
        // Change the suggested filename.

        $zipcode = $app->input->getInt('zip');
        $rows = $model->getLocations($zipcode);
        echo json_encode($rows);

    }
}