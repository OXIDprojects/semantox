<?php

/**
 * This file is part of Semantox module for OXID eShop.
 * 
 * Semantox is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Semantox is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Semantox. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://code.google.com/p/semantox/
 */

/**
* Admin shop system semantox manager.
*/
class SOX_Admin_Shop extends Shop_Config{
	
	/**
	* Predefined customer types
	*
	* @var array
	*/
	protected $_aSoxCustomers = array(	"Enduser" => 0,
										"Reseller" => 0,
										"Business" => 0,				
										"PublicInstitution"	=> 0);
	
	/**
	* Executes parent method parent::render(), creates oxContentList and
	* object, passes its data to Smarty engine and returns template
	* file "sox_admin_shop.tpl".
	*
	* @return string
	*/
	public function render(){
		// Gets list of content pages which could be used for embedding
		// business entity, price specification, and delivery specification data
		$oContentList = oxNew("oxcontentlist");
		$sTable = getViewName("oxcontents", $this->_iEditLang);
		$oContentList->selectString("SELECT * FROM {$sTable} WHERE OXACTIVE = 1 
										AND OXTYPE = 0 
										AND OXLOADID = 'oxagb' OR OXLOADID = 'oxdeliveryinfo' 
										OR OXLOADID = 'oximpressum' OR OXLOADID = 'oxrightofwithdrawal'
										AND OXSHOPID = '".oxConfig::getParameter("oxid")."'");				// $this->getEditObjectId()

		$this->_aViewData["contents"] = $oContentList;
		// Handles customer array
		$myConfig = $this->getConfig();
		$aSoxCustomersConf = $myConfig->getShopConfVar("aSoxCustomers");
		if(isset($aSoxCustomersConf)){
			foreach ($this->_aSoxCustomers as $sSoxCustomer => $iValue) {
				$aSoxCustomers[$sSoxCustomer] = (in_array($sSoxCustomer, $aSoxCustomersConf)) ? 1 : 0;
        	}
		}else{
			$aSoxCustomers = array();
		}
		$this->_aViewData["customers"] = $aSoxCustomers;
		$this->_aViewData["notify"] = $this->_canNotify();

		parent::render();
		return "sox_admin_shop.tpl";
	}
	
	/**
	* Notify semantic web search engines
	*
	* @return null
	*/
	public function notify(){
		$myConfig = $this->getConfig();
		$oLang = oxLang::getInstance();
		if($this->_canNotify()){
			// Get input url
			$aConfStrs = $myConfig->getParameter("confstrs");
			$sSitemapUrl = $aConfStrs["sSoxSitemapUrl"];
			if(!empty($sSitemapUrl)){
				// Set sitemap dir
				$sParsedUrl = parse_url($sSitemapUrl);
				$sSitemap = $myConfig->getConfigParam('sShopDir').$sParsedUrl["path"];
				if(file_exists($sSitemap)){
					// Set submission url
					$sNotificationUrl = "http://gr-notify.appspot.com/submit?uri=".urlencode($sSitemapUrl)."&agent=semantox";
					if(ini_get('allow_url_fopen') == '1'){
						$sNotification = file_get_contents($sNotificationUrl);
						if($sNotification && preg_match( "/200 OK/", $http_response_header[0])){
							// Save new timestamp
							//$myConfig->saveShopConfVar("str", "iSoxLastNotification", time());
							$sNotifyMsg = $oLang->translateString("SOX_SHOP_NOTIFY_MSG_SUCCESS", $this->_iEditLang);
						}else{
							$sNotifyMsg = $oLang->translateString("SOX_SHOP_NOTIFY_MSG_URL", $this->_iEditLang);
						}
					}else{
						$sNotifyMsg = $oLang->translateString("SOX_SHOP_NOTIFY_MSG_FOPEN", $this->_iEditLang);
					}
				}else{
					$sNotifyMsg = $oLang->translateString("SOX_SHOP_NOTIFY_MSG_NOTFOUND", $this->_iEditLang);
				}
			}
		}
		$this->_aViewData["notified"] = $sNotifyMsg;
	}
	
	/**
	* Checks if user can notify semantic web search engines
	*
	* @return bool
	*/
	private function _canNotify(){
		$iSoxLastNotification = $this->getConfig()->getShopConfVar("iSoxLastNotification");
		if($iSoxLastNotification && $iSoxLastNotification >= time()-86400){
			return false;
		}else{
			return true;
		}
	}

}

?>