<?php

class Hmtest_Axevents_Model_Resource_Axevents extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('axevents/axevent', 'event_id');
    }
}