<?php
/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2010 Ashley Schroder
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magespeedtest_Speedtest_Block_View extends Mage_Adminhtml_Block_Widget_Grid_Container {
	
    /**
     * Block constructor
     */
    public function __construct() {
    	$this->_blockGroup = 'magespeedtest';
        $this->_controller = 'view';
        $this->_headerText = Mage::helper('cms')->__('Performance Monitoring');
        parent::__construct();
        
        // Remove the add button
        $this->_removeButton('add');
    }
}
