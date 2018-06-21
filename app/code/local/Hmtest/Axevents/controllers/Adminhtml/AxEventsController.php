<?php

class Hmtest_Axevents_Adminhtml_AxeventsController extends Mage_Adminhtml_Controller_Action
{
    public function _construct()
    {
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('axevents/adminhtml_axevents'));
        $this->renderLayout();
    }


    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('event_id');

        Mage::register('axevents_block', Mage::getModel('axevents/axevents')->load($id));
        $blockObject = (array)Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if (count($blockObject)) {
            Mage::registry('axevents_block')->setData($blockObject);
        }
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('axevents/adminhtml_axevents_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {

            $data['image'] = false;
            if (isset($_FILES['image']['name']) and (file_exists($_FILES['image']['tmp_name']))) {
                $this->savePicture();
                $data['image'] = $_FILES['image']['name'];
            } else {
                if (isset($data['image']['delete']) && $data['image']['delete'] == 1)
                    $data['image'] = '';
            }

            $id = $this->getRequest()->getParam('event_id');
            $block = Mage::getModel('axevents/axevents')->load($id);
            $block
                ->setTitle($this->getRequest()->getParam('title'))
                ->setDescription($this->getRequest()->getParam('description'))
                ->setStatus($this->getRequest()->getParam('status'));

            // Остановить удаление картинки если она была загружена в прошлый раз
            if ($data['image'] !== false) $block->setImage($data['image']);

            $block->save();

            /*$block
               ->setData($this->getRequest()->getParams())
               ->setCreatedAt(Mage::app()->getLocale()->date())
               ->save();*/

            if (!$block->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Cannot save the event');
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
            return $this->_redirect('*/*/edit', array('event_id' => $this->getRequest()->getParam('event_id')));
        }

        Mage::getSingleton('adminhtml/session')->addSuccess('Event was saved successfully!');

        $this->_redirect('*/*/' . $this->getRequest()->getParam('back', 'index'), array('event_id' => $block->getId()));
    }


    public function savePicture()
    {
        try {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything


            $uploader->setAllowRenameFiles(false);

            // setAllowRenameFiles(true) -> move your file in a folder the magento way
            // setAllowRenameFiles(true) -> move your file directly in the $path folder
            $uploader->setFilesDispersion(false);

            $path = Mage::getBaseDir('media') . DS;

            $uploader->save($path, $_FILES['image']['name']);
        } catch (Exception $e) {

        }

    }


    public function deleteAction()
    {
        $block = Mage::getModel('axevents/axevents')
            ->setId($this->getRequest()->getParam('event_id'))
            ->delete();
        if ($block->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Block was deleted successfully!');
        }
        $this->_redirect('*/*/');

    }


    public function massStatusAction()
    {
        $statuses = $this->getRequest()->getParams();
        try {
            $blocks = Mage::getModel('axevents/axevents')
                ->getCollection()
                ->addFieldToFilter('event_id', array('in' => $statuses['massaction']));
            foreach ($blocks as $block) {
                $block->setBlockStatus($statuses['block_status'])->save();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Blocks were updated!');

        return $this->_redirect('*/*/');

    }

    public function massDeleteAction()
    {
        $blocks = $this->getRequest()->getParams();
        try {
            $blocks = Mage::getModel('axevents/axevents')
                ->getCollection()
                ->addFieldToFilter('event_id', array('in' => $blocks['massaction']));
            foreach ($blocks as $block) {
                $block->delete();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Blocks were deleted!');

        return $this->_redirect('*/*/');

    }
}