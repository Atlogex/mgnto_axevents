<?php

class Hmtest_Axevents_EventslistController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        // Подключим основной шаблон
        $this->loadLayout();
        $this->renderLayout();
    }

    public function showEventsStats()
    {

    }
}