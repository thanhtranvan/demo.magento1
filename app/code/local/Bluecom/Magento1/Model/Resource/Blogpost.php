<?php

/**
* Class for Blogpost
*/
class Bluecom_Magento1_Model_Resource_Blogpost extends Mage_Core_Model_Resource_Db_Abstract{

	protected function _construct()
	{
		$this->_init('magento1/blogpost', 'blogpost_id');
	}
}