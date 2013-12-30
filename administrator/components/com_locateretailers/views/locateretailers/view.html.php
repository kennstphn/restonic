<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 12/30/13
 * Time: 10:17 AM
 */


class LocateRetailersViewLocateRetailers extends JViewLegacy
{
    function display($tpl = null)
    {
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JToolbarHelper::title(JText::_('Locate Retailers'));
        JToolbarHelper::preferences('com_locateretailers');
    }

}