<?php

class Bluecom_Magento1_Block_Adminhtml_Bluecom_Order extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{
		$this->_controller = "adminhtml_bluecom_order";
		$this->_blockGroup = "magento1";
		$this->_headerText = Mage::helper("magento1")->__("Bluecom Manager");
		$this->_addButtonLabel = Mage::helper("magento1")->__("Add New Item");
		parent::__construct();
	}

}