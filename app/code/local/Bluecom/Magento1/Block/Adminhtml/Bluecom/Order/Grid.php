<?php

class Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("orderGrid");
				$this->setDefaultSort("order_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("magento1/order")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
			// add column to view in the admin page
			$this->addColumn("order_id", array(
			"header" => Mage::helper("magento1")->__("ID"),
			"align" =>"right",
			"width" => "50px",
		    "type" => "number",
			"index" => "order_id",
			));
            
			$this->addColumn("customer_id", array(
				"header" => Mage::helper("magento1")->__("Customer Id"),
				"index" => "customer_id",
			));
			$this->addColumn("product_code", array(
				"header" => Mage::helper("magento1")->__("Product Code"),
				"index" => "product_code",
			));
			$this->addColumn('product_value', array(
				'header' => Mage::helper('magento1')->__('Product Value'),
				'index' => 'product_value',
			));
			$this->addColumn('period', array(
				'header' => Mage::helper('magento1')->__('Period'),
				'index' => 'period',
			));
			$this->addColumn('amount', array(
				'header' => Mage::helper('magento1')->__('Amount'),
				'index' => 'amount',
			));
			$this->addColumn('full_name', array(
				'header' => Mage::helper('magento1')->__('Full Name'),
				'index' => 'full_name',
			));
			$this->addColumn('telephone', array(
				'header' => Mage::helper('magento1')->__('Telephone'),
				'index' => 'telephone',
			));
			$this->addColumn('address', array(
				'header' => Mage::helper('magento1')->__('Address'),
				'index' => 'address',
			));
			$this->addColumn('email', array(
				'header' => Mage::helper('magento1')->__('Email'),
				'index' => 'email',
			));
			$this->addColumn('description', array(
				'header' => Mage::helper('magento1')->__('Description'),
				'index' => 'description',
			));
			$this->addColumn('status', array(
				'header' => Mage::helper('magento1')->__('Status'),
				'index' => 'status',
				'type' => 'options',
				'options'=> array(1 => "Enabled", 2 => "Disabled"),
			));
			$this->addColumn('created', array(
				'header' => Mage::helper('magento1')->__('Created'),
				'index' => 'created',
				// 'type' => 'options',
				// 'options'=>Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Grid::getOptionArray3(),
			));

			// add export type
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

			return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('order_id');
			$this->getMassactionBlock()->setFormFieldName('order_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_order', array(
					 'label'=> Mage::helper('magento1')->__('Remove Order'),
					 'url'  => $this->getUrl('*/bluecom_order/massRemove'),
					 'confirm' => Mage::helper('magento1')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray3()
		{
            $data_array=array(); 
			$data_array[0]='timestamp';
            return($data_array);
		}
		static public function getValueArray3()
		{
            $data_array=array();
			foreach(Bluecom_Magento1_Block_Adminhtml_Bluecom_Order_Grid::getOptionArray3() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}