
<?php

class Bluecom_Magento1_Adminhtml_Bluecom_OrderController extends Mage_Adminhtml_Controller_Action
{
	/**
   * Initialize action
   *
   * Here, we set the breadcrumbs and the active menu
   *
   * @return Mage_Adminhtml_Controller_Action
   */
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("bluecom/orders")->_addBreadcrumb(Mage::helper("adminhtml")->__("Bluecom  Manager"),Mage::helper("adminhtml")->__("Bluecom Manager"));
		$this->_title($this->__('Bluecom'))->_title($this->__('Order'))
            ->_addBreadcrumb($this->__('Bluecom'), $this->__('Bluecom'))
            ->_addBreadcrumb($this->__('Order'), $this->__('Order'));
		// $this->_addContent($this->getLayout()->createBlock('magento1/adminhtlm_bluecom_order'));
		return $this;
	}

    public function indexAction()
    {
        // $this->loadLayout();
        // $this->_addContent($this->getLayout()->createBlock('magento1/adminhtlm_bluecom_orders'));
        $this->_title($this->__("Bluecom"));
	    $this->_title($this->__("Manager Orders"));

		$this->_initAction();
        $this->renderLayout();
    }

    public function editAction()
    {               
            $this->_title($this->__("Magento1"));
            $this->_title($this->__("Order"));
            $this->_title($this->__("Edit Item"));
            
            $id = $this->getRequest()->getParam("id");
            $model = Mage::getModel("magento1/order")->load($id);
            if ($model->getId()) {
                Mage::register("order_data", $model);
                $this->loadLayout();
                $this->_setActiveMenu("magento1/order");
                $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Order Manager"), Mage::helper("adminhtml")->__("Order Manager"));
                $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Order Description"), Mage::helper("adminhtml")->__("Order Description"));
                $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
                $this->_addContent($this->getLayout()->createBlock("magento1/adminhtml_bluecom_order_edit"))->_addLeft($this->getLayout()->createBlock("magento1/adminhtml_bluecom_order_edit_tabs"));
                $this->renderLayout();
            } 
            else {
                Mage::getSingleton("adminhtml/session")->addError(Mage::helper("magento1")->__("Item does not exist."));
                $this->_redirect("*/*/");
            }
    }

    public function newAction()
    {

      $this->_title($this->__("Magento1"));
      $this->_title($this->__("Order"));
      $this->_title($this->__("New Item"));

      $id   = $this->getRequest()->getParam("id");
      $model  = Mage::getModel("magento1/order")->load($id);

      $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
      if (!empty($data)) {
          $model->setData($data);
      }

      Mage::register("order_data", $model);

      $this->loadLayout();
      $this->_setActiveMenu("magento1/order");

      $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

      $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Order Manager"), Mage::helper("adminhtml")->__("Order Manager"));
      $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Order Description"), Mage::helper("adminhtml")->__("Order Description"));


      $this->_addContent($this->getLayout()->createBlock("magento1/adminhtml_bluecom_order_edit"))->_addLeft($this->getLayout()->createBlock("magento1/adminhtml_bluecom_order_edit_tabs"));

      $this->renderLayout();

    }
    public function saveAction()
    {
      $post_data=$this->getRequest()->getPost();

      if ($post_data) {
          try {
              $model = Mage::getModel("magento1/order")
              ->addData($post_data)
              ->setId($this->getRequest()->getParam("id"))
              ->save();

              Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Order was successfully saved"));
              Mage::getSingleton("adminhtml/session")->setBlogpostData(false);

              if ($this->getRequest()->getParam("back")) {
                  $this->_redirect("*/*/edit", array("id" => $model->getId()));
                  return;
              }
              $this->_redirect("*/*/");
              return;
          } 
          catch (Exception $e) {
              Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
              Mage::getSingleton("adminhtml/session")->setBlogpostData($this->getRequest()->getPost());
              $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
          return;
          }
      }
      $this->_redirect("*/*/");
    }

    public function deleteAction()
    {
            if( $this->getRequest()->getParam("id") > 0 ) {
                try {
                    $model = Mage::getModel("magento1/order");
                    $model->setId($this->getRequest()->getParam("id"))->delete();
                    Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
                    $this->_redirect("*/*/");
                } 
                catch (Exception $e) {
                    Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                    $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                }
            }
            $this->_redirect("*/*/");
    }

    public function massRemoveAction()
    {
      try {
        $ids = $this->getRequest()->getPost('order_ids', array());
        foreach ($ids as $id) {
              $model = Mage::getModel("magento1/order");
              $model->setId($id)->delete();
        }
        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
      }
      catch (Exception $e) {
        Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
      }
      $this->_redirect('*/*/');
    }
        
    /**
     * Export order grid to CSV format
     */
    public function exportCsvAction()
    {
        $fileName   = 'order.csv';
        $grid       = $this->getLayout()->createBlock('magento1/adminhtml_bluecom_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    } 
    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction()
    {
        $fileName   = 'order.xml';
        $grid       = $this->getLayout()->createBlock('magento1/adminhtml_bluecom_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }


  //   public function newAction()
  //   {  
  //       // We just forward the new action to a blank edit form
  //       $this->_forward('edit');
  //   }  

  //   public function editAction()
  //   {  
  //       $this->_initAction();

  //       // Get id if available
  //       $id  = $this->getRequest()->getParam('id');
  //       $model = Mage::getModel('magento1/order');

  //       if ($id) {
  //           // Load record
  //           $model->load($id);

  //           // Check if record is loaded
  //           if (!$model->getId()) {
  //               Mage::getSingleton('adminhtml/session')->addError($this->__('This Order no longer exists.'));
  //               $this->_redirect('*/*/');

  //               return;
  //           }  
  //       }  

  //       $this->_title($model->getId() ? $model->getName() : $this->__('New Order'));

  //       $data = Mage::getSingleton('adminhtml/session')->getBazData(true);
  //       if (!empty($data)) {
  //           $model->setData($data);
  //       }  

  //       Mage::register('order_data', $model);

  //       $this->_initAction()
  //           ->_addBreadcrumb($id ? $this->__('Edit Order') : $this->__('New Order'), $id ? $this->__('Edit Order') : $this->__('New Order'))
  //           // link of block "magento1/adminhtml_bluecom_order_edit":
  //           // "magento1" attribute is the element name of helper class in "config.xml" file
  //           ->_addContent($this->getLayout()->createBlock('magento1/adminhtml_bluecom_order_edit')->setData('action', $this->getUrl('*/*/save')))
  //           ->renderLayout();
  //   }

  //   public function saveAction()
  //   {
  //       if ($postData = $this->getRequest()->getPost()) {
  //           $model = Mage::getSingleton('magento1/order');
  //           $model->setData($postData);

  //           try {
  //               $model->save();
 
  //               Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The order has been saved.'));
  //               $this->_redirect('*/*/');
 
  //               return;
  //           }  
  //           catch (Mage_Core_Exception $e) {
  //               Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
  //           }
  //           catch (Exception $e) {
  //               Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this order.'));
  //           }

  //           Mage::getSingleton('adminhtml/session')->setBazData($postData);
  //           $this->_redirectReferer();
  //       }
  //   }

  //   public function messageAction()
  //   {
  //       $data = Mage::getModel('magento1/order')->load($this->getRequest()->getParam('id'));
  //       echo $data->getContent();
  //   }

  //   /**
  //    * Check currently called action by permissions for current user
  //    *
  //    * @return bool
  //    */
  //   // protected function _isAllowed()
  //   // {
  //   //     return Mage::getSingleton('admin/session')->isAllowed('sales/foo_bar_baz');
  //   // }
}  