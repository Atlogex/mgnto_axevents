<?php

class Hmtest_Axevents_Model_Axevents extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        
        // Инициализация ресурсной модели (папкаресурноймодели/ресурснаямодель.php)
        $this->_init('axevents/axevents');
    }
}