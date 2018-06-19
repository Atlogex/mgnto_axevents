<?php

class Hmtest_Axevents_Model_Resource_Axevents extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('Axevents/events', 'event_id');
    }
}