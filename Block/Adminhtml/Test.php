<?php

/**
 * MageSpeedTest.com Magento Test Button
 *
 * @package    Magespeedtest_Speedtest
 * @author     Ashley Schroder (magespeedtest.com)
 * @copyright  Copyright 2012 Ashley Schroder
 */


class Magespeedtest_Speedtest_Block_Adminhtml_Test
extends Mage_Adminhtml_Block_System_Config_Form_Field {

	const BASE_URL = 'magespeedtest/settings/baseurl';
	const DEFAULT_LOCATION = 'USAWEST'; // USA, West
	const EXT = 'ext'; // for analytics
	const DEFAULT_CONCURRENCY = '10'; // 10 users
	const DEFAULT_DURATION = '30'; // 30 seconds
	const HIDE_SITEMAP_WARNING = "<style type='text/css'>.sitemapWarning{display:none;}</style>";
	

	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {

		$this->setElement($element);

		$sitemap = Mage::helper('magespeedtest')->sitemapExists();
		if ($sitemap) {
			return $this->_getAddRowButtonHtml($this->__('Run A Magento Speed Test'));
		} else {
			return $this->_getAddRowButtonHtml($this->__('Create a sitemap.xml first'));
		}

	}


	protected function _getAddRowButtonHtml($title) {

		$buttonBlock =
		$this->getElement()->getForm()->getParent()->getLayout()->createBlock('adminhtml/widget_button');

		$_websiteCode = $buttonBlock->getRequest()->getParam('website');

		$sitemap = Mage::helper('magespeedtest')->sitemapExists();
		$url = Mage::getStoreConfig(self::BASE_URL);
		$extraHTML = ""; // used to hide sitemap warning.

		if ($sitemap) {

			$sitemapURL = Mage::helper('magespeedtest')->getSitemapURL();
			$currentUserEmail = Mage::helper('magespeedtest')->getCurrentUserEmail();
			
			$params = http_build_query(array(
    							'domain' => $sitemapURL,
    							'concurrency' => self::DEFAULT_CONCURRENCY,
    							'duration' => self::DEFAULT_DURATION,
    							'location' => self::DEFAULT_LOCATION,
    							'ref' => self::EXT,
    							'email' => $currentUserEmail
			));

			$url .= "?$params";

			// we have a sitemap, no need for the sitemap warning.
			$extraHTML = self::HIDE_SITEMAP_WARNING;
			
		} else {

			$params = array(
	        'website' => $_websiteCode,
			'_store' => $_websiteCode ? $_websiteCode : Mage::app()->getDefaultStoreView()->getId()
			);
			
			$url = Mage::helper('adminhtml')->getUrl("*/sitemap/new", $params);
		}


		return $this->getLayout()->createBlock('adminhtml/widget_button')
			->setType('button')
			->setLabel($this->__($title))
			->setOnClick("window.location.href='".$url."'")
			->toHtml() . $extraHTML;
	}
}
