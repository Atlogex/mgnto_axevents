<?php

class Hmtest_Axevents_Block_Adminhtml_Axevents_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_form');
        $this->setTitle(Mage::helper('axevents')->__('Block Information'));
    }

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('axevents_block');
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('event_id' => $this->getRequest()->getParam('event_id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('axevents')->__('General Information'), 'class' => 'fieldset-wide'));

        if ($model->getBlockId()) {
            $fieldset->addField('event_id', 'hidden', array(
                'name' => 'event_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('axevents')->__('Block Title'),
            'title' => Mage::helper('axevents')->__('Block Title'),
            'required' => true,
        ));


        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('axevents')->__('Status'),
            'title' => Mage::helper('axevents')->__('Status'),
            'name' => 'status',
            'required' => true,
            'options' => array(0 => $this->__('NO'), 1 => $this->__('YES')),
        ));

        $fieldset->addField('image', 'image', array(
            'name' => 'image',
            'label' => Mage::helper('axevents')->__('Slide'),
            'title' => Mage::helper('axevents')->__('Slide'),
            //'required'  => true,
        ));


        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config');
        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('axevents')->__('Content'),
            'title' => Mage::helper('axevents')->__('Content'),
            'style' => 'height:36em',
            'required' => true,
            'config' => $wysiwygConfig->getConfig()
        ));


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
