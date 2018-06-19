<?php

class Hm_Test_NewCol_Model_NewCol extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('newcol/column');
    }
}
