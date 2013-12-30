<?php

class LocateRetailersModelLocateRetailers extends JModelLegacy {

    protected $retailer_db;

    public function __construct($config)
    {

        parent::__construct($config);

        // override constructor
        $options = array();

        $config = JComponentHelper::getParams('com_locateretailers');

        $options['host'] = $config->get('host');
        $options['user'] = $config->get('db_user');
        $options['password'] = $config->get('db_password');
        $options['database'] = $config->get('db_name');

        // set new remote database location
        $db = JDatabase::getInstance($options);

        // override the db with the new instance
        parent::setDbo($db);
    }


    /**
     * gets rows from the tbl_locations table
     * returns rows as object list
     *
     * @param $zip
     * @return mixed
     */
    public function getLocations($zip)
    {
        // cut down to just three chars
        $zip = substr($zip, 0, 2);

        $db = $this->getDbo();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('tbl_locations');
        $query->where('location_zip LIKE '. $db->quote($zip.'%'));
        $db->setQuery($query);
        $rows = $db->loadAssocList();
        $addresses = array();
        foreach ($rows as $row) {
            $addresses[] = $row;
        }

        return $addresses;
    }
}

?>