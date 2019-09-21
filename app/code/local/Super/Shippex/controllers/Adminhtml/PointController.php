<?php

use Super_Shippex_Model_Point as PointModel;
use Super_Shippex_Model_Resource_Point as PointResource;

class Super_Shippex_Adminhtml_PointController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('shippex/point');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("Admin Grid"));
        $this->renderLayout();
    }

    /**
     * @throws Mage_Core_Exception
     */
    public function editAction()
    {
        $pointId = $this->getRequest()->getParam('id');
        $pointModel = PointModel::get($pointId);

        if ($pointModel->getId() || $pointId == 0) {
            Mage::register('point_data', $pointModel);
            $this->loadLayout();
            $this->_setActiveMenu('shippex/shippexgrid');
            $this->_addBreadcrumb('Shippex Pickup Points', 'Pickup Points');
            $this->_addBreadcrumb('Pickup Point Description', 'Pikcup Point Description');
            $this->getLayout()->getBlock('head')
                ->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                ->createBlock('shippex/adminhtml_point_edit'))
                ->_addLeft($this->getLayout()
                    ->createBlock('shippex/adminhtml_point_edit_tabs')
                );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError('Pickup point does not exist');
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            $pointId = $this->getRequest()->getParam('id');
            try {
                $postData = $this->getRequest()->getPost();
                if ($pointId <= 0) {
                    PointModel::get()
                        ->addData($postData)
                        ->setId($pointId)
                        ->save();

                    Mage::getSingleton('adminhtml/session')->addSuccess('Pickup point saved');
                    $this->_redirect('*/*/');
                    return;
                } else {
                    PointModel::get($pointId)
                        ->addData($postData)
                        ->save();
                }

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setfilmsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $pointId));
                return;
            }

            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        $pointId = $this->getRequest()->getParam('id');
        if ($pointId > 0) {
            try {
                PointModel::get()
                    ->setId($pointId)
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess('Pickup point deleted');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $pointId));
            }
        }
        $this->_redirect('*/*/');
    }


}