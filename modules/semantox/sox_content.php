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
* Extends Content for getting more detailed company, delivery and payment information
*/
class Sox_Content extends Sox_Content_parent{

	/**
	* An array including all ShopConfVars which are used to extend business 
	* entity data
	*
	* @var array
	*/
	protected $_aSoxBusinessEntityExtends = array(	"sSoxLogoUrl",
													"sSoxLongitude",
													"sSoxLatitude",
													"sSoxGLN",
													"iSoxNAICS",
													"iSoxISIC",
													"sSoxDUNS"		);
	
	/**
	* Loads soxGetContentPagesLocs() from soxUtils to get oxloadids of 
	* content pages where business entity data, payment charge specifications,
	* and delivery charge specifications have to be embedded
	*
	* @return array
	*/
	public function soxGetContentPagesLocs(){
		return soxUtils::getInstance()->soxGetContentPagesLocs();
	}
	
	/**
	* Gets business entity data
	*
	* @return object
	*/
	public function soxGetBusinessEntityData(){
		$myConfig = $this->getConfig();
		$sShopId = $myConfig->getShopId();
		$oShop = oxNew("oxshop");
		$oShop->loadInLang(0, $sShopId);
		
		// Get extended business entity data
		foreach($this->_aSoxBusinessEntityExtends as $sExtend){
			// Removes "a", "bl", "i", "s" from confvarname and converts
			// string to lower case. Example: blSoxFoo -> soxfoo
			$sFielName = "oxshops__".strstr(strtolower($sExtend), "sox");
			$oShop->$sFielName = new oxField($myConfig->getShopConfVar($sExtend), oxField::T_RAW);
		}
				
		return $oShop;
	}
	
	/**
	* Returns an object including all payments which are not mapped to a 
	* predefined GoodRelations payment method. This object is used for
	* defining new instances of gr:PaymentMethods at content pages.
	*
	* @return object
	*/
	public function soxGetNotMappedPayments(){
		$oSoxUtils = soxUtils::getInstance();
		$oPayments = oxNew("oxpaymentlist");
		$oPayments->selectString("SELECT oxpayments.* FROM oxpayments WHERE NOT EXISTS(SELECT * FROM oxobject2payment WHERE oxobject2payment.OXPAYMENTID = oxpayments.OXID AND oxobject2payment.OXTYPE = 'sox_oxpayment') AND oxpayments.OXACTIVE = 1");
		foreach($oPayments as $oPayment){
			$sNewId = $oSoxUtils->soxCreateCleanObjectId($oPayment->oxpayments__oxdesc->value, $oPayment->oxpayments__oxid->value);
			$oPayment->cleanid = new oxField($sNewId, oxField::T_RAW);
			$oPayment->label = new oxField($oSoxUtils->soxTextFilter($oPayment->oxpayments__oxdesc), oxField::T_RAW);
			$oPayment->comment = new oxField($oSoxUtils->soxTextFilter($oPayment->oxpayments__oxlongdesc), oxField::T_RAW);
		}
		return $oPayments;
	}
	
	/**
	* Returns an object including all delivery sets which are not mapped to a 
	* predefined GoodRelations delivery method. This object is used for
	* defining new instances of gr:DeliveryMethods at content pages.
	*
	* @return object
	*/
	public function soxGetNotMappedDeliverySets(){
		$oSoxUtils = soxUtils::getInstance();
		$sShopId = $this->getConfig()->getShopId();
		$oDelSets = oxNew("oxdeliverysetlist");
		$oDelSets->selectString("SELECT oxdeliveryset.* FROM oxdeliveryset WHERE NOT EXISTS(SELECT * FROM oxobject2delivery WHERE oxobject2delivery.OXOBJECTID = oxdeliveryset.OXID AND oxobject2delivery.OXTYPE 'sox_oxdeliveryset') AND oxdeliveryset.OXACTIVE = 1 AND oxdeliveryset.OXSHOPID = '{$sShopId}'");
		foreach($oDelSets as $oDelSet){
			$sNewId = $oSoxUtils->soxCreateCleanObjectId($oDelSet->oxdeliveryset__oxtitle->value, $oDelSet->oxdeliveryset__oxid->value);
			$oDelSet->cleanid = new oxField($sNewId, oxField::T_RAW);
			$oDelSet->label = new oxField($oSoxUtils->soxTextFilter($oDelSet->oxdeliveryset__oxtitle), oxField::T_RAW);
		}
		return $oDelSets;
	}
	
	/**
	* Uses _soxGetChargeSpecs() to get available delivery charge specifications
	* and adds some additional data to every delivery charge specification.
	*
	* @return object
	*/
	public function soxGetDeliveryChargeSpecs(){
		$oDeliveryChargeSpecs = $this->_soxGetChargeSpecs("oxdeliverylist", $this->_soxSelectDeliveries());
		foreach($oDeliveryChargeSpecs as $oDeliveryChargeSpec){
			$sOXID = $oDeliveryChargeSpec->getId();
			$oDeliveryChargeSpec->eligibleregions = new oxField($this->_soxGetAssignedCountries($sOXID, "oxobject2delivery"), oxField::T_RAW);
			$oDeliveryChargeSpec->deliverymethods = new oxField($this->_soxGetAssignedDeliverySets($sOXID), oxField::T_RAW);
		}
		return $oDeliveryChargeSpecs;
	}
	
	/**
	* Gets an oxdeliverylist or oxpaymentlist and adds some additional data
	*
	* @param $sList	type of list (oxdeliverylist or oxpaymentlist)
	* @param $sSelect select string
	*
	* @return object
	*/
	protected function _soxGetChargeSpecs($sList, $sSelect){
		
		$myConfig = $this->getConfig();
		
		// Load new oxdeliverylist 
		$oChargeSpecs = oxNew($sList);
		$oChargeSpecs->selectString($sSelect);
		
		// Value added tax included?
		$iVAT = $myConfig->getShopConfVar("iSoxVAT");
		$oChargeSpecs->vat = new oxField($iVAT, oxField::T_RAW);
		
		// Add validity period
		$sTimeDiff = soxUtils::getInstance()->soxGetTimeZoneOffset();
		
		$iDays = $myConfig->getShopConfVar("iSoxPriceValidity");
		$iFrom = time() - (2*60*60);
		$iThrough = $iFrom + ($iDays * 24 * 60 * 60);
		$oChargeSpecs->validfrom = new oxField(date('Y-m-d\TH:i:s', $iFrom).$sTimeDiff, oxField::T_RAW);
		$oChargeSpecs->validthrough = new oxField(date('Y-m-d\TH:i:s', $iThrough).$sTimeDiff, oxField::T_RAW);
		
		foreach($oChargeSpecs as $oChargeSpec){
			$oChargeSpec->cleanid = new oxField(soxUtils::getInstance()->soxCreateCleanObjectId($oChargeSpec->getId()), oxField::T_RAW);
		}
		
		return $oChargeSpecs;
	}
	
	/**
	* Gets eligible countries
	*
	* @param string $sOXID
	* @param string $sTable
	*
	* @return array
	*/
	protected function _soxGetAssignedCountries($sOXID, $sTable){
		$aAssignedCountries = array();
		$sQ = "SELECT oxcountry.OXISOALPHA2 FROM ";
		$sQ .= "(SELECT oxcountry.OXISOALPHA2 FROM oxcountry LEFT JOIN {$sTable} ON {$sTable}.OXOBJECTID = oxcountry.OXID ";
		$sQ .= "WHERE {$sTable}.OXTYPE = 'oxcountry' AND {$sTable}.OXDELIVERYID = '{$sOXID}') as oxcountry";
		$oDb = oxDb::getDb();
		$oRs = $oDb->execute($sQ);
		if ($oRs != false && $oRs->RecordCount() > 0) {
			while(!$oRs->EOF){
				$aAssignedCountries[] = $oRs->fields[0];
				$oRs->moveNext();
			}
		}
		return $aAssignedCountries;
	}
	
	/**
	* Gets delivery sets which are assgined to the respective delivery
	*
	* @param string $sOXID
	*
	* @return array
	*/
	protected function _soxGetAssignedDeliverySets($sOXID){
		return soxUtils::getInstance()->soxGetMappingArray($this->_soxSelectAssignedDeliverySets($sOXID));
	}

	/**
	* Prepares select string for selecting delivery sets which are assigned
	* to the given OXID
	*
	* @param string $sOXID
	*
	* @return string
	*/	
	protected function _soxSelectAssignedDeliverySets($sOXID){
		$sQ = "SELECT d.OXID AS ID, d.OXTITLE AS LABEL, o2d.OXOBJECTID AS OBJECTID FROM oxdeliveryset AS d LEFT JOIN (SELECT * FROM oxobject2delivery WHERE OXTYPE = 'sox_oxdeliveryset') o2d ON d.OXID = o2d.OXDELIVERYID INNER JOIN oxdel2delset AS d2d ON d2d.OXDELSETID = d.OXID AND d2d.OXDELID  = '{$sOXID}' WHERE d.OXACTIVE = 1";
		return $sQ;
	}

	/**
	* Modified version of core -> oxdeliverlist.php -> _getFilterSelect()
	*
	* @return string
	*/
	protected function _soxSelectDeliveries(){
		
		$sShopId = oxConfig::getInstance()->getShopId();
		$oDb = oxDb::getDb();
		
	        $sTable = "oxdelivery"; // semantox: changed
	        $sQ  = "select $sTable.* from ( select $sTable.* from $sTable left join oxdel2delset on oxdel2delset.oxdelid=$sTable.oxid ";

	        // defining initial filter parameters
	        $sUserId    = null;
	        $aGroupIds  = null;
			$ssCountryId = null;

	        // checking for current session user which gives additional restrictions for user itself, users group and country
	        if ( $oUser = $this->getUser() ) {
	            // user ID
	            $sUserId = $oUser->getId();
				$sCountryId = $oUser->getActiveCountry();
	            // user groups ( maybe would be better to fetch by function oxuser::getUserGroups() ? )
	            $aGroupIds = $oUser->getUserGroups();
	        }

	        $aIds = array();
	        if ( count( $aGroupIds ) ) {
	            foreach ( $aGroupIds as $oGroup ) {
	                $aIds[] = $oGroup->getId();
	            }
	        }else{
				$aIds = array('oxidnewcustomer', 'oxidforeigncustomer', 'oxidnotyetordered'); // semantox: added
			}

	        $sUserTable    = getViewName( 'oxuser' );
	        $sGroupTable   = getViewName( 'oxgroups' );
	        $sCountryTable = getViewName( 'oxcountry' );

	        $sCountrySql = $sCountryId ? "EXISTS(select oxobject2delivery.oxid from oxobject2delivery where oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxcountry' and oxobject2delivery.OXOBJECTID=".$oDb->quote($sCountryId).")" : '0';
	        $sUserSql    = $sUserId    ? "EXISTS(select oxobject2delivery.oxid from oxobject2delivery where oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxuser' and oxobject2delivery.OXOBJECTID=".$oDb->quote($sUserId).")"   : '0';
	        $sGroupSql   = count( $aIds ) ? "EXISTS(select oxobject2delivery.oxid from oxobject2delivery where oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxgroups' and oxobject2delivery.OXOBJECTID in ('oxidnewcustomer', 'oxidforeigncustomer', 'oxidnotyetordered') )"  : '0';

	        $sQ .= ") as $sTable where (
	            select
	                EXISTS(select * from oxobject2delivery, $sCountryTable where $sCountryTable.oxid=oxobject2delivery.oxobjectid and oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxcountry' LIMIT 1) &&
	                if(EXISTS(select 1 from oxobject2delivery, $sUserTable where $sUserTable.oxid=oxobject2delivery.oxobjectid and oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxuser' LIMIT 1),
	                    $sUserSql,
	                    1) &&
	                if(EXISTS(select 1 from oxobject2delivery, $sGroupTable where $sGroupTable.oxid=oxobject2delivery.oxobjectid and oxobject2delivery.oxdeliveryid=$sTable.OXID and oxobject2delivery.oxtype='oxgroups' LIMIT 1),
	                    $sGroupSql,
	                    1)
	            )"; // semantox: changed

		$sQ .= " AND OXACTIVE = 1 AND OXADDSUMTYPE = 'abs' order by $sTable.oxsort ";  // semantox: changed
	
		return $sQ;
		
	}
}

?>