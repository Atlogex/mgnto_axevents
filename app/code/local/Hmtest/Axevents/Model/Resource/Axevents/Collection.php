<?php

class Hmtest_Axevents_Model_Resource_AxEvents_Collection extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('AxEvents/events', 'event_id');
    }
}