<?php

class Hmtest_Axevents_Block_Eventswidget extends Mage_Core_Block_Template
{

    public $eventsStatShow = 0;
    public $eventsStatCnt  = 0;
    public $eventsStatTxt  = 0;

    public function _construct()
    {
        $this->eventsStatShow = Mage::getStoreConfig('axevents/settings/enabled');
        if ($this->eventsStatShow) {
            $this->eventsStatCnt = Mage::getStoreConfig('axevents/settings/events_count');
            $this->eventsStatTxt = Mage::getStoreConfig('axevents/settings/raw_text');
        }
    }
}