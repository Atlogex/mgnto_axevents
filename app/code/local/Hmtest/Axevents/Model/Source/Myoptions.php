<?php

class Hmtest_Axevents_Model_Source_Myoptions
{
    const ENABLED = '1';
    const DISABLED = '0';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::ENABLED, 'label'=>Mage::helper('axevents')->__('Yes')),
            array('value' => self::DISABLED, 'label'=>Mage::helper('axevents')->__('No')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            self::DISABLED => Mage::helper('axevents')->__('Yes'),
            self::ENABLED => Mage::helper('axevents')->__('No'),
        );
    }

}
