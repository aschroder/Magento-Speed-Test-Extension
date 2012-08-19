<?php

/**
* @author Ashley Schroder (aschroder.com)
* @copyright  Copyright (c) 2010 Ashley Schroder
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/

class Magespeedtest_Speedtest_PerformanceController
	extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('system/tools')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('System'), Mage::helper('adminhtml')->__('System'))
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Tools'), Mage::helper('adminhtml')->__('Tools'))
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Performance Monitoring'), Mage::helper('adminhtml')->__('Performance Monitoring'));
        return $this;
    }	
		
	public function indexAction() {
		  $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('magespeedtest/view', 'view'))
            ->renderLayout();
	}	
	
} 