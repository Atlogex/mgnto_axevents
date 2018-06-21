<?php

class Hmtest_Axevents_Model_Resource_Axevents_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('axevents/axevents');
    }
}