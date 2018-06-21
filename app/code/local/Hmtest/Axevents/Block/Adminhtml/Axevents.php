<?php

class Hmtest_Axevents_Block_Adminhtml_Axevents extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_axevents';
        $this->_blockGroup = 'axevents';
        $this->_headerText = Mage::helper('axevents')->__('Events');
        $this->_addButtonLabel = Mage::helper('axevents')->__('Add New Event');
        parent::__construct();
    }

}
