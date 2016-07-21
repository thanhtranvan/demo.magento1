<?php


class Bluecom_Magento1_Model_Order extends Mage_Core_Model_Abstract
{

	protected function _construct()
	{
		$this->_init('magento1/order');
	}
}