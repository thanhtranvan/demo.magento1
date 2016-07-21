<?php

class Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{

		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("magento1_form", array("legend"=>Mage::helper("magento1")->__("Item information")));

		$fieldset->addField("customer_id", "text", array(
			"name" => "customer_id",
			"label" => Mage::helper("magento1")->__("Customer Id"),
			"title" => Mage::Helper("magento1")->__("Customer Id"),
			"required" => true
		));

		$fieldset->addField("product_code", "text", array(
			"name" => "product_code",
			"label" => Mage::helper("magento1")->__("Product Code"),
			"title" => Mage::Helper("magento1")->__("Product Code"),
			"required" => true
		));

		$fieldset->addField("product_value", "text", array(
			"name" => "product_value",
			"label" => Mage::helper("magento1")->__("Product Value"),
			"title" => Mage::Helper("magento1")->__("Product Value"),
			"required" => true
		));

		$fieldset->addField("period", "text", array(
			"name" => "period",
			"label" => Mage::helper("magento1")->__("Period"),
			"title" => Mage::Helper("magento1")->__("Period"),
			"required" => true
		));

		$fieldset->addField("amount", "text", array(
			"name" => "amount",
			"label" => Mage::helper("magento1")->__("Amount"),
			"title" => Mage::Helper("magento1")->__("Amount"),
			"required" => true
		));

		$fieldset->addField("full_name", "text", array(
			"name" => "full_name",
			"label" => Mage::helper("magento1")->__("Full Name"),
			"title" => Mage::Helper("magento1")->__("Full Name"),
			"required" => true
		));

		$fieldset->addField("telephone", "text", array(
			"name" => "telephone",
			"label" => Mage::helper("magento1")->__("Telephone"),
			"title" => Mage::Helper("magento1")->__("Telephone")
		));

		$fieldset->addField("address", "text", array(
			"name" => "address",
			"label" => Mage::helper("magento1")->__("Address"),
			"title" => Mage::Helper("magento1")->__("Address")
		));

		$fieldset->addField("email", "text", array(
			"name" => "email",
			"label" => Mage::helper("magento1")->__("Email"),
			"title" => Mage::Helper("magento1")->__("Email")
		));

		$fieldset->addField("description", "text", array(
			"name" => "description",
			"label" => Mage::helper("magento1")->__("Description"),
			"title" => Mage::Helper("magento1")->__("Description")
		));

		$defaultStatus = 0;
		if( Mage::registry("order_data") ) {
			$defaultStatus = Mage::registry("order_data")->getStatus();
		}
		$fieldset->addField("status", "select", array(
			"name" => "status",
			"label" => Mage::helper("magento1")->__("Status"),
			"title" => Mage::Helper("magento1")->__("status"),
			"required" => true,
			"value" => $defaultStatus,
			"values" => array(0 => '-- Please Select --', 1 => 'Enabled', 2 => 'Disabled')
		));

		if( Mage::registry("order_data") && Mage::registry("order_data")->getId() ) {
			$fieldset->addField('created', 'text', array(
				'name' => 'created',
				'label'     => Mage::helper('magento1')->__('Created'),
				// 'values'   => Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Grid::getValueArray3(),
				"class" => "required-entry",
				// "required" => true,
				"disabled" => true,
				"readonly" => true
			));
		} else {
			$fieldset->addField('created', 'hidden', array(
				'name' => 'created',
				'label'     => Mage::helper('magento1')->__('Created'),
				'values'   => Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Grid::getValueArray3(),
				// "class" => "required-entry",
				// "required" => true,
				// "disabled" => true,
				// "readonly" => true
			));
		}

		// $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
		// 	Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
		// );

		// $fieldset->addField('date', 'date', array(
		// 'label'        => Mage::helper('magento1')->__('Date'),
		// 'name'         => 'date',
		// 'time' => true,
		// 'image'        => $this->getSkinUrl('images/grid-cal.gif'),
		// 'format'       => $dateFormatIso
		// ));				

		if (Mage::getSingleton("adminhtml/session")->getBlogpostData())
		{
			$form->setValues(Mage::getSingleton("adminhtml/session")->getBlogpostData());
			Mage::getSingleton("adminhtml/session")->setBlogpostData(null);
		} 
		elseif(Mage::registry("order_data")) {
		    $form->setValues(Mage::registry("order_data")->getData());
		}
		return parent::_prepareForm();
	}
}
