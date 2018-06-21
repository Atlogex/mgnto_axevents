<?php

class Hmtest_Axevents_Block_Eventslist extends Mage_Core_Block_Template
{

    public $imageDefault = 'events_default.jpg';

    public function getEvents()
    {
        return Mage::getModel('axevents/axevents')->getCollection();
        //->addFieldToFilter('block_status',array('eq'=>Hmtest_Axevents_Model_Source_Status::YES)); // Добавить фильтрацию
    }
}