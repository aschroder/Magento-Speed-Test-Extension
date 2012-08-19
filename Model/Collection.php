<?php 

/**
* @author Ashley Schroder (aschroder.com)
* @copyright  Copyright (c) 2010 Ashley Schroder
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
* 
* Faux collection that wraps the XML response from the API.
*/

class Magespeedtest_Speedtest_Model_Collection extends Varien_Data_Collection {
	
	// This is just a little hack to get the collection working properly.
	public function addItem(Varien_Object $item) {
		parent::addItem($item);
		$this->_totalRecords = $this->_totalRecords + 1; 
	}
	
}
