<?php

/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2010 Ashley Schroder
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magespeedtest_Speedtest_Block_View_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	
	const API_URL = 'admin/magespeedtest/apiurl';

    public function __construct() {
        parent::__construct();
        $this->setId('performanceMonitoringGrid');
        $this->setDefaultSort('time');
        $this->setDefaultDir('ASC');
        
        $this->setPagerVisibility(false);
        $this->setFilterVisibility(false);
    }
    
    protected function _prepareCollection() {
    	
		// Start with an empty faux collection
 		$collection = new Magespeedtest_Speedtest_Model_Collection();
 		
 		$url = Mage::getStoreConfig(self::API_URL);
 		
 		if ($url) {
	 		$xml = simplexml_load_file($url);
	 		if ($xml) {
		 		$results = $xml->results->result;
		 		
		 		foreach ($results as $result) {
		 			
			 		$obj = new Varien_Object();
		 			$obj->setData('time', new Zend_Date(($result->timestamp/1000), Zend_Date::TIMESTAMP));
		 			$obj->setData('alert', $result->alert->__toString());
		 			$obj->setData('transPerSecond', $result->transPerSecond->__toString());
		 			$obj->setData('secondsPerTrans', $result->secondsPerTrans->__toString());
		 			$obj->setData('testUrl', $result->testUrl->__toString());
			     	$collection->addItem($obj);
		 		}
	 		}
	 		
 		}
 		
         $this->setCollection($collection);
         return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('time', array(
            'header'    => Mage::helper('adminhtml')->__('Time'),
        	'width'     => '80px',
            'index'     => 'time',
	        'sortable'  => false,
            'filter'    => false
        ));
        $this->addColumn('transPerSecond', array(
            'header'    => Mage::helper('adminhtml')->__('Throughput (transactions/s)'),
        	'width'     => '40px',
            'index'     => 'transPerSecond',
	        'sortable'  => false,
            'filter'    => false
        ));
        $this->addColumn('secondsPerTrans', array(
            'header'    => Mage::helper('adminhtml')->__('Time per transaction (s)'),
        	'width'     => '40px',
            'index'     => 'secondsPerTrans',
	        'sortable'  => false,
            'filter'    => false
        ));
        $this->addColumn('view', array(
                    'header'    => Mage::helper('adminhtml')->__('View'),
                    'format'    => '<a target="_blank" href="' . '$testUrl' .'">View</a> ',
                    'index'     => 'type',
                    'width'     => '20px',
                    'sortable'  => false,
                    'filter'    => false
        ));

        return parent::_prepareColumns();
    }
    
    public function getRowClass($_item) {
	    // Make alert rows class 'invalid'.
    	if ($_item && $_item['alert'] == "true") {
	    	return "invalid";
    	} else {
    		return parent::getRowClass($_item);
    	}
    }
    
    public function getResetFilterButtonHtml() {
    	// no reset
    }
    
    public function getSearchButtonHtml() {
    	// no search
    }
    
}
