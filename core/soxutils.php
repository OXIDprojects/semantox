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
* Semantox utils class, used as a singelton
*
*/
class soxUtils extends oxSuperCfg{
	
	/**
	* soxUtils class instance.
	*
	* @var soxutils instance
	*/
	private static $_instance = null;
	
	/**
	* An array including all ShopConfVars which are used to save the locations 
	* for embedding business entity data, delivery charge specifications and
	* payment charge specifications
	*
	* @var array
	*/
	protected $_aSoxContentPages = array(	"sSoxBusinessEntityLoc",
											"sSoxDeliveryChargeSpecLoc",
											"sSoxPaymentChargeSpecLoc"	);
											
	/**
	* Predefined product conditions
	*
	* @var array
	*/
	protected $_aSoxConditions = array(	0 => null,
										1 => "new",
										2 => "used",
										3 => "refurbished" 	);
										
										
	/**
	* Returns an array including all predefined product conditions
	*
	* @return array
	*/									
	public function getSoxConditionsArray(){
		return $this->_aSoxConditions;
	}

	/**
	* Gets oxloadids of content pages where business entity data, payment charge 
	* specifications, and delivery charge specifications have to be embedded
	*
	* @return array
	*/
	public function soxGetContentPagesLocs(){
		$myConfig = $this->getConfig();
		$aLocs = array();
		foreach($this->_aSoxContentPages as $sContentPage){
			$aLocs[] = $myConfig->getShopConfVar($sContentPage);
		}
		return $aLocs;
	}
		
	/**
	* Returns a single instance of this class
	*
	* @return object
	*/
	public static function getInstance(){
		// disable caching for test modules
		if ( defined( 'OXID_PHP_UNIT' ) ) {
			self::$_instance = modInstances::getMod( __CLASS__ );
		}
		if ( !(self::$_instance instanceof oxUtils) ) {
			self::$_instance = oxNew( 'soxUtils' );
			if ( defined( 'OXID_PHP_UNIT' ) ) {
				modInstances::addMod( __CLASS__, self::$_instance);
			}
		}
		return self::$_instance;
	}
	
	/**
	* Checks for mappings between OXID object and GoodRealtions individuals. 
	* Collects the mapping and outputs an array including these mappings.
	*
	* @param string $sSelect
	*
	* @return array
	*/
	public function soxGetMappingArray($sSelect){
		$aMappingArray = array("mapped" => array(),"notmapped" => array());
		$oDb = oxDb::getDb(true);
		$oRs = $oDb->execute($sSelect);
		if ($oRs !== false && $oRs->recordCount() > 0) {
		    while (!$oRs->EOF) {
				if($oRs->fields["OBJECTID"]){
					$aMappingArray["mapped"][] = str_replace(":", "", strstr($oRs->fields["OBJECTID"], ":"));
				}else{
					$aMappingArray["notmapped"][] = $this->soxCreateCleanObjectId($oRs->fields["LABEL"], $oRs->fields["ID"]);
				}
				$oRs->moveNext();
			}
		}
		
		// Prepare unique values
		$aMappingArray["mapped"] = array_unique($aMappingArray["mapped"]);
		$aMappingArray["notmapped"] = array_unique($aMappingArray["notmapped"]);
		
		return $aMappingArray;
	}
	
	/**
	* Gets time zone offset from UTC
	*
	* @return string
	*/
	public function soxGetTimeZoneOffset(){
		// Get timezone object by given default time zone
		$oTimeZone = timezone_open(date_default_timezone_get());
		// Set sign
		$sSign = "+";
		// Get deviation (in seconds) from previos default time zone compared with UTC
		$iSeconds = timezone_offset_get($oTimeZone , date_create("now", $oTimeZone));
		// Get time shift
		if($iServerTimeShift = $this->getConfig()->getConfigParam("iServerTimeShift")){
			$iSeconds = (is_int((int)$iServerTimeShift)) ? $iSeconds + ((int)$iServerTimeShift * 3600) : $iSeconds;
		}
		// Change sign and set $iSeconds to a positive value
		if($iSeconds < 0){
			$sSign = "-";
			$iSeconds = $iSeconds * (-1);
		}
		// If daylight savings time is in effect date() seems to add 3600 sec to $iSeconds.
		// So we have to remove these 3600 sec.
		$aLocalTime = localtime();
		$iSeconds = ($aLocalTime[8]) ? $iSeconds - 3600 : $iSeconds;
		// Return time difference
		return $sSign.date("H:i", $iSeconds);
	}
	
	/**
	* Creates clean object ids for payments and delivery sets
	*
	* @param string $sFirst
	* @param string $sSecond
	*
	* @return string
	*/
	public function soxCreateCleanObjectId($sFirst, $sSecond = null){
		$sObjectId = $sFirst;
		if($sSecond) $sObjectId .= "_".$sSecond;
		return preg_replace('/[^a-zA-Z0-9_-]/u', '', $sObjectId);
	}
	
	/**
	* Removes html tags and some special chars from text
	*
	* @param string $sText formatted text
	*
	* @return string
	*/
	public function soxTextFilter($sText){
		$oStr = getStr();
		$aReplace = array("\t","\r\n","\n", "<br>", "<br/>", "<br />");
		$sText = str_replace($aReplace, " ", $sText );
		$sText = $oStr->html_entity_decode($sText);
		$sText = $oStr->cleanStr($sText);
		$sText = oxUtilsString::getInstance()->minimizeTruncateString($sText, -1);
		return strip_tags($sText);
	}
}

?>