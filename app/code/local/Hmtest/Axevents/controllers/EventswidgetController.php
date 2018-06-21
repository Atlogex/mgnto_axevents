<?php

class Hmtest_Axevents_EventslistController extends Mage_Core_Controller_Front_Action
{
    public function showAction()
    {
        $widgetActive = Mage::getStoreConfig('axevents/settings/enabled');
        if ($widgetActive) {
            $eventsCnt = Mage::getStoreConfig('axevents/settings/events_count');
            $eventsTxt = Mage::getStoreConfig('axevents/settings/raw_text');
        }
        var_dump($eventsCnt);
        var_dump($eventsTxt);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function eventsStatShow0()
    {
        
        $data['eventsStatShow'] = Mage::getStoreConfig('axevents/settings/enabled');
        if ($data['eventsStatShow']) {
            $data['eventsCnt'] = Mage::getStoreConfig('axevents/settings/events_count');
            $data['eventsTxt'] = Mage::getStoreConfig('axevents/settings/raw_text');
        }

        $this->loadLayout();
        $this->renderLayout();
//        $data['eventsCnt'] = '';
        return $data;
    }
}