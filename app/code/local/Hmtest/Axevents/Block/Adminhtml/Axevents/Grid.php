<?php

class Hmtest_Axevents_Block_Adminhtml_Axevents_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cmsBlockGrid');
        $this->setDefaultSort('block_identifier');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('axevents/axevents')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('title', array(
            'header' => Mage::helper('axevents')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $sourceYesNo = Mage::getSingleton('adminhtml/system_config_source_yesno');
        $this->addColumn('status', array(
            'header' => Mage::helper('cms')->__('Status'),
            'align' => 'left',
//            'type'      => 'options',
//            'options'   =>  $sourceYesNo->toOptionArray,
            'type' => 'options',
            'options' => array(0 => $this->__('NO'), 1 => $this->__('YES')),
            'index' => 'status'
        ));


        /* todo добавить даты
         $this->addColumn('created_at', array(
            'header'    => Mage::helper('axevents')->__('Created At'),
            'index'     => 'created_at',
            'type'      => 'date',

        ));*/


        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('event_id');
        $this->getMassactionBlock()->setIdFieldName('event_id');
        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('axevents')->__('Delete'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('axevents')->__('Are you sure?')
                )
            )
            ->addItem('status',
                array(
                    'label' => Mage::helper('axevents')->__('Update status'),
                    'url' => $this->getUrl('*/*/massStatus'),
                    'additional' =>
                        array('block_status' =>
                            array(
                                'name' => 'block_status',
                                'type' => 'select',
                                'class' => 'required-entry',
                                'label' => Mage::helper('axevents')->__('Status'),
//                            'values' => Mage::getModel('axevents/source_status')->toOptionArray()
                            )
                        )
                )
            );

        return $this;
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('event_id' => $row->getId()));
    }

}
