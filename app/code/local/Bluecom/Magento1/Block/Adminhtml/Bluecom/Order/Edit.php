<?php
	
class Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "order_id";
				$this->_blockGroup = "magento1";
				$this->_controller = "adminhtml_bluecom_order";
				$this->_updateButton("save", "label", Mage::helper("magento1")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("magento1")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("magento1")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("order_data") && Mage::registry("order_data")->getId() ){

				    return Mage::helper("magento1")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("order_data")->getId()));

				} 
				else{

				     return Mage::helper("magento1")->__("Add Item");

				}
		}
}