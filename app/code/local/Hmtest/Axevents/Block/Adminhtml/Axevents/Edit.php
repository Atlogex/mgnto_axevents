<?php

class Hmtest_Axevents_Block_Adminhtml_Axevents_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'event_id';
        $this->_controller = 'adminhtml_axevents';
        $this->_blockGroup = 'axevents';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('axevents')->__('Save Block'));
        $this->_updateButton('delete', 'label', Mage::helper('axevents')->__('Delete Block'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('axevents_block')->getId()) {
            return Mage::helper('axevents')->__("Edit Block '%s'", $this->escapeHtml(Mage::registry('axevents_block')->getTitle()));
        }
        else {
            return Mage::helper('axevents')->__('New Block');
        }
    }

}
