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
* Extends Details for getting more detailed article information
*/
class Sox_Details extends Sox_Details_parent{
	
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
	* Gets business function of the gr:Offering
	*
	* @return string
	*/
	public function soxGetBusinessFnc(){
		return $this->getConfig()->getShopConfVar("sSoxBusinessFnc");
	}
	
	/**
	* Gets the types of customers for which the given gr:Offering is valid
	*
	* @return array
	*/
	public function soxGetCustomers(){
		return $this->getConfig()->getShopConfVar("aSoxCustomers");
	}
	
	/**
	* Sets normalized rating
	*
	* @param object $oObject
	*
	* @return null
	*/
	public function soxGetNormalizedRating(){
		$myConfig = $this->getConfig();
		$iMin = $myConfig->getShopConfVar("iSoxMinRating");
		$iMax = $myConfig->getShopConfVar("iSoxMaxRating");
		
		$oProduct = $this->getProduct();
		$iCount = $oProduct->oxarticles__oxratingcnt->value ? $oProduct->oxarticles__oxratingcnt->value : 0;
		if($iMin && $iMax){
			$aNomalizedRating = array();
			$iValue = ($iCount == 0) ? 0 : ((4*($oProduct->oxarticles__oxrating->value - $iMin)/($iMax - $iMin)))+1;
			$aNomalizedRating["count"] = $iCount;
			$aNomalizedRating["value"] = round($iValue, 2);
			return $aNomalizedRating;
		}
	}
	
	/**
	* Gets information whether prices include vat
	*
	* @return int
	*/
	public function soxGetVAT(){
		return $this->getConfig()->getShopConfVar("iSoxVAT");
	}
	
	/**
	* Gets a generic description of product condition
	*
	* @return string
	*/
	public function soxGetGenericCondition(){
		$iCondition = $this->getConfig()->getShopConfVar("iSoxCondition");
		$aConditions = soxUtils::getInstance()->getSoxConditionsArray();
		return ($iCondition > 0) ? $aConditions[$iCondition] : null;
	}
	
	/**
	* Gets price validity period
	*
	* @return array
	*/
	public function soxGetPriceValidity(){
		return $this->_soxSetValidityPeriod("price");
	}
	
	/**
	* Gets offering validity period
	*
	* @return array
	*/
	public function soxGetOfferingValidity(){
		return $this->_soxSetValidityPeriod("offering");
	}
	
	/**
	* Sets validity period of given object
	*
	* @param string $sType object type
	*
	* @return mixed
	*/
	protected function _soxSetValidityPeriod($sType){
		if($sType == "offering"){
			$sShopConfVar = "iSoxOfferingValidity";
		}elseif($sType == "price"){
			$sShopConfVar = "iSoxPriceValidity";
		}else{
			$sShopConfVar = null;
		}
		
		if($sShopConfVar){
			$aValidity = array();
			$iDays = $this->getConfig()->getShopConfVar("$sShopConfVar");

			// - 2 hours to avoid time lags
			$iFrom = time() - (2*60*60);
			$iThrough = $iFrom + ($iDays * 24 * 60 * 60);

			$sTimeDiff = soxUtils::getInstance()->soxGetTimeZoneOffset();

			$aValidity["from"]  = date('Y-m-d\TH:i:s', $iFrom).$sTimeDiff;
			$aValidity["through"] = date('Y-m-d\TH:i:s', $iThrough).$sTimeDiff;
			
			return $aValidity;
		}		
	}
	
	/**
	* Gets EAN of the given oxArticle object
	*
	* @return string
	*/
	public function soxGetEan(){
		$oProduct = $this->getProduct();
		// Set EAN
		if($oProduct->oxarticles__oxean->value){
			return $oProduct->oxarticles__oxean->value;
		}elseif($oProduct->oxarticles__oxdistean->value){
			return $oProduct->oxarticles__oxdistean->value;
		}
	}
	
	/**
	* Returns seo url of second product if exists
	* 
	* @return string seo url
	*/
	public function soxGetBundleUri(){
		if($sOXID = $this->_soxHasBundle($this->getProduct()->getId())){
			return $this->_soxGetBundleUri($sOXID);
		}
	}
	
	/**
	* Checks if offering includes a second product
	*
	* @return mixed string or bool
	*/
	protected function _soxHasBundle($sOXID){
		$sBundle = oxDb::getDb()->getOne("SELECT OXBUNDLEID FROM oxarticles WHERE OXID = '{$sOXID}'");
		return $sBundle ? $sBundle : false;
	}
	
	/**
	* Gets seo url of second product
	*
	* @param string article id
	* 
	* @return string seo url
	*/
	protected function _soxGetBundleUri($sOXID){
		$oArticle = oxNew("oxarticle");
		$oArticle->load($sOXID);
		return oxSeoEncoderArticle::getInstance()->getArticleUrl($oArticle);
	}
	
	/**
	* Returns an array including information about products height, width and depth
	*
	* @return array
	*/
	public function soxGetSize(){
		$oProduct = $this->getProduct();
		$aSize = array();
		if($oProduct->oxarticles__oxlength->value)
			$aSize["depth"] = $oProduct->oxarticles__oxlength->value;
		if($oProduct->oxarticles__oxwidth->value)
			$aSize["width"] = $oProduct->oxarticles__oxwidth->value;
		if($oProduct->oxarticles__oxheight->value)
			$aSize["height"] = $oProduct->oxarticles__oxheight->value;
		return $aSize;
	}
	
	/**
	* Returns an array including ids of all available delivery charge specifications
	* for given product
	*
	* @return array
	*/
	public function soxGetDeliveryChargeSpecs(){
		$oProduct = $this->getProduct();
		$aChargeSpecs = array();
		$oChargeSpecs = oxNew('oxdeliverylist');
		$oChargeSpecs->selectString($this->_soxSelectDeliveries());
		foreach($oChargeSpecs as $oChargeSpec){
			switch($oChargeSpec->oxdelivery__oxdeltype->value){
				case "a":	// amount
					$dQuantity = 1;
					break;
				case "p":	// price
					$dQuantity = $oProduct->getPrice()->getBruttoPrice();
					break;
				case "s":	// size
					$dQuantity = $oProduct->oxarticles__oxlength->value *
								 $oProduct->oxarticles__oxwidth->value *
								 $oProduct->oxarticles__oxheight->value;
					break;
				case "w":	// weight
					$dQuantity = $oProduct->oxarticles_oxweight->value;	
					break;
			}
			if( $oChargeSpec->oxdelivery__oxparam->value <= $dQuantity && 
				$oChargeSpec->oxdelivery__oxparamend->value >= $dQuantity && 
				$oChargeSpec->oxdelivery__oxfinalize){
				$aChargeSpecs[] = soxUtils::getInstance()->soxCreateCleanObjectId($oChargeSpec->getId());
			}	
		}
		return $aChargeSpecs;
	}
	
	/**
	* Gets accepted payment methods
	*
	* @return array
	*/
	public function soxGetPaymentMethods(){
		return soxUtils::getInstance()->soxGetMappingArray($this->_soxSelectPayments());
	}
	
	/**
	* Gets accepted delivery methods
	*
	* @return array
	*/
	public function soxGetDeliveryMethods(){
		return soxUtils::getInstance()->soxGetMappingArray($this->_soxSelectDeliverySets());
	}
	
	/**
	* Prepares select string for selecting available payments
	*
	* @return string
	*/
	protected function _soxSelectPayments(){
		$iPrice = $this->getProduct()->getPrice()->getBruttoPrice();
		$oUser = $this->getUser();
		$sBoni = ($oUser && $oUser->oxuser__oxboni->value) ? $oUser->oxuser__oxboni->value : 0;
		// p = oxpayments; o2p = oxobject2payment
		$sQ = "SELECT p.OXID as ID, p.OXDESC as LABEL, o2p.OXOBJECTID as OBJECTID FROM oxpayments AS p LEFT JOIN (SELECT * FROM oxobject2payment WHERE OXTYPE = 'sox_oxpayment') o2p ON p.OXID = o2p.OXPAYMENTID WHERE EXISTS(SELECT o2p.* FROM oxobject2payment AS o2p WHERE o2p.OXPAYMENTID = p.OXID AND o2p.OXTYPE = 'oxcountry') AND p.OXFROMBONI <= {$sBoni} AND p.OXFROMAMOUNT <= {$iPrice} AND p.OXTOAMOUNT >= {$iPrice}";
		return $sQ;
	}
	
	/**
	* Prepares select string for selecting available delivery sets
	*
	* @return string
	*/
	protected function _soxSelectDeliverySets(){
		// d = oxdeliveryset; o2d = oxobject2delivery
		$sQ = "SELECT d.OXID as ID, d.OXTITLE as LABEL, o2d.OXOBJECTID AS OBJECTID FROM oxdeliveryset AS d LEFT JOIN (SELECT * FROM oxobject2delivery WHERE OXTYPE = 'sox_oxdeliveryset') o2d ON d.OXID = o2d.OXDELIVERYID WHERE EXISTS(SELECT o2d.* FROM oxobject2delivery AS o2d LEFT JOIN  oxdeliveryset AS d ON d.OXID = o2d.OXDELIVERYID AND o2d.OXTYPE = 'oxdeliveryset')";
		return $sQ;
	}
		
	/**
	* Gets the ISO 3166-1 alpha-2 code of eligible regions for which 
	* the offering is valid
	*
	* @return object
	*/
	public function soxGetEligibleRegions(){
		$oEligibleRegions = oxNew("oxlist");
		$oEligibleRegions->init("oxcountry");
		$oEligibleRegions->selectString($this->_soxSelectRegions());
		return $oEligibleRegions;
	}
	
	/**
	* Prepares select string for selecting eligible regions
	*
	* @return string
	*/
	protected function _soxSelectRegions(){
		$sQ = "SELECT oxcountry.OXISOALPHA2 FROM oxcountry WHERE";
		// Check for availabe delivery methods
		$sQ .= " EXISTS(SELECT oxobject2delivery.* FROM oxobject2delivery LEFT JOIN oxdelivery ON oxdelivery.OXID = oxobject2delivery.OXDELIVERYID WHERE oxobject2delivery.OXTYPE = 'oxcountry' AND oxobject2delivery.OXOBJECTID = oxcountry.OXID AND oxdelivery.OXACTIVE = 1)";
		// Check for availabe payment methods
		$sQ .= " AND EXISTS(SELECT oxobject2payment.* FROM oxobject2payment LEFT JOIN oxpayments ON oxpayments.OXID = oxobject2payment.OXPAYMENTID WHERE oxobject2payment.OXTYPE = 'oxcountry' AND oxobject2payment.OXOBJECTID = oxcountry.OXID AND oxpayments.OXACTIVE = 1)";
		$sQ .= " AND OXACTIVE = '1' ORDER BY oxcountry.OXISOALPHA2";
		return $sQ;
	}
	
	/**
	* Converts string to float
	*
	* @param string $sPrice formatted string
	*
	* @return string
	*/
	public function soxStringToFloat($sPrice){
		return oxUtils::getInstance()->currency2Float($sPrice);
	}
	
	/**
	* Adapts text filter from soxUtils
	*
	* @param string $sText formatted text
	*
	* @return string
	*/
	public function soxTextFilter($sText){
		return soxUtils::getInstance()->soxTextFilter($sText);
	}
	

	/**
	* Modified version of core -> oxdeliverylist.php -> _getFilterSelect()
	*
	* @return string
	*/
	protected function _soxSelectDeliveries(){
		
		$sShopId = oxConfig::getInstance()->getShopId();
		$oDb = oxDb::getDb();
		
		$iPrice = $this->getProduct()->getPrice()->getBruttoPrice();
		
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

		$sQ .= " AND OXACTIVE = 1 AND OXADDSUMTYPE = 'abs' ORDER BY $sTable.OXSORT"; // semantox: changed
	
		return $sQ;
		
	}	
}

?>