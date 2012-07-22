<?php
/**
* MageSpeedTest.com Magento integration
*
* @package    Magespeedtest_Speedtest
* @author     Ashley Schroder (magespeedtest.com)
* @copyright  Copyright 2012 Ashley Schroder
*/
class Magespeedtest_Speedtest_Helper_Data extends Mage_Core_Helper_Abstract {
	
	/**
	 * Check if there is a sitemap.xml file.
	 * return the path to it, or false if no sitemap exists
	 */
	public function sitemapExists() {
		
		//TODO: check if we have a sitemap.xml
		$collection = Mage::getModel('sitemap/sitemap')->getCollection();
		$collection->load();
		
		foreach($collection as $sitemap) {
			
			Mage::log("Found sitemap: " . $sitemap->getPreparedFilename());
			return $sitemap->getPreparedFilename();
			
		}
		
		Mage::log("Found no sitemap.");
		return false;
	}
	
	/**
	 * Get the URL for the sitemap, or simply the 
	 * base URL if it is the default name and root path.
	 * 
	 * return false if no sitemap exists.
	 */
	public function getSitemapURL() {
		
		if ($sitemap = $this->sitemapExists()) {
			
			$baseURL = Mage::getUrl('');
			
			if ($sitemap == "/sitemap.xml") {
				return $baseURL;
			} else {
				// non-standard location or name
				return $baseURL.$sitemap;
			}
			
		} else {
			return false;
		}
	}
	
	/**
	 * Get the current admin user email, or false if no admin user
	 */
	public function getCurrentUserEmail() {
		
		$user = Mage::getSingleton('admin/session');
		if ($user && $user->getUser()) {
			return $user->getUser()->getEmail();
		} else {
			return false;
		}
	}
}

