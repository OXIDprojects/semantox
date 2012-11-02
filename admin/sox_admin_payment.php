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
* Admin article semantox payment manager.
*/
class SOX_Admin_Payment extends oxAdminDetails{
	
	/**
	* OXID object which has to be loaded for rendering
	*
	* @var string
	*/
	protected $_sThisEditObject = "oxpayment";
	
	/**
	* Mapping table
	*
	* @var string
	*/
	protected $_sThisMappingTable = "oxobject2payment";
	
	/**
	* Column name of saved object ids
	*
	* @var string
	*/
	protected $_sThisEditObjectId = "OXPAYMENTID";
	
	/**
	* Template file which has to be returned
	*
	* @var string
	*/
	protected $_sThisTemplate = "sox_admin_payment.tpl";
	
	/**
	* Predefined payment methods
	*
	* @var array
	*/
	protected $_aThisSoxObjects = array("ByBankTransferInAdvance",
										"ByInvoice",
										"Cash",
										"CheckInAdvance",
										"COD",
										"DirectDebit",
										"GoogleCheckout",
										"PayPal",
										"PaySwarm",
										"AmericanExpress",
										"DinersClub",
										"Discover",
										"JCB",
										"MasterCard",
										"VISA"					);
	
	/**
	* Executes parent method parent::render(), loads soxobjects, loads
	* editobject, passes its data to Smarty engine and returns template
	* file $_sThisTemplate.
	*
	* @return string
	*/
	public function render(){
		parent::render();
		$sOXID = $this->_aViewData["oxid"] = oxConfig::getParameter("oxid");  // $this->getEditObjectId()
		if ( $sOXID != "-1" && isset( $sOXID)) {
			$this->_aViewData["sox"] = $this->getSoxObjects();
		}
		$oOxObject = oxNew($this->_sThisEditObject);
		$oOxObject->loadInLang($this->_iEditLang, $sOXID);
		$this->_aViewData["edit"] =  $oOxObject;
	return $this->_sThisTemplate;
	}
	
	/**
	* Saves changed mapping configurations
	*
	* @return null
	*/
	public function save() {
		$aParams = oxConfig::getParameter("editval");
		$aSoxObjects = (array) oxConfig::getParameter("soxobjectid");
		
		// Delete old mappings
		$oDb = oxDb::getDb();
		$oDb->execute("DELETE FROM {$this->_sThisMappingTable} WHERE {$this->_sThisEditObjectId} = '".oxConfig::getParameter("oxid")."' AND OXTYPE = 'sox_{$this->_sThisEditObject}'");
		
		// Save new mappings
		foreach($aSoxObjects as $sSoxObject){
			$oMapping = oxNew("oxbase");
            $oMapping->init($this->_sThisMappingTable);
			$oMapping->assign($aParams);
            $oMapping->{$this->_sThisMappingTable."__oxobjectid"} = new oxField($sSoxObject);
            $oMapping->save();
		}

	}
	
	/**
	* Returns an array including all available soxobjects as array keys.
	* Values of assigned soxobjects are set to 1. Values of none assigned
	* soxobjects are set to 0.
	*
	* @return array
	*/
	public function getSoxObjects(){
		$aSoxObjects = array_flip($this->_aThisSoxObjects);
		foreach( $aSoxObjects as $sKey => $sValue ){
			$aSoxObjects[$sKey]	= in_array( $sKey, $this->_getAssignedSoxObjects() ) ? 1 : 0;
		}
		return $aSoxObjects;
	}
	
	/**
	* Returns assigned soxobjects
	*
	* @return array
	*/
	protected function _getAssignedSoxObjects(){
		$oDb = oxDb::getDb();
		$sQ = "SELECT OXOBJECTID FROM {$this->_sThisMappingTable} WHERE {$this->_sThisEditObjectId} = '".oxConfig::getParameter("oxid")."' AND OXTYPE = 'sox_{$this->_sThisEditObject}'";
		$oRs = $oDb->execute($sQ);
		$aMappings = array();
		if ( $oRs !== false && $oRs->recordCount() > 0) {
			while ( !$oRs->EOF ) {
				$aMappings[] = $oRs->fields[0];
				$oRs->moveNext();
			}
		}
		
		// Sets an array including soxobjectids
		$sObjectIds = array();
		foreach( $aMappings as $sObjectId ){
			$sObjectIds[] = str_replace(":", "", strstr($sObjectId, ":"));
		}
		return $sObjectIds;
	}

}

?>