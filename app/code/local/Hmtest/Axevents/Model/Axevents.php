<?php

class Hmtest_Axevents_Model_Axevents extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        die('crec');
        $this->_init('axevents/axevent');
    }
}