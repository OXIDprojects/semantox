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
* Admin article semantox deliveryset manager.
*/
class SOX_Admin_DeliverySet extends SOX_Admin_Payment{
	
	/**
	* OXID object which has to be loaded for rendering
	*
	* @var string
	*/
	protected $_sThisEditObject = "oxdeliveryset";
	
	/**
	* Mapping table
	*
	* @var string
	*/
	protected $_sThisMappingTable = "oxobject2delivery";
	
	/**
	* Column name of editobject ids at the respective mapping table
	*
	* @var string
	*/
	protected $_sThisEditObjectId = "OXDELIVERYID";
	
	/**
	* Template file which has to be returned
	*
	* @var string
	*/
	protected $_sThisTemplate = "sox_admin_deliveryset.tpl";
	
	/**
	* Predefined delivery methods
	*
	* @var array
	*/	
	protected $_aThisSoxObjects = array(
										"DeliveryModeDirectDownload",
										"DeliveryModeFreight",
										"DeliveryModeMail",
										"DeliveryModeOwnFleet",
										"DeliveryModePickUp",
										"DHL",
										"FederalExpress",
										"UPS"
											);

}

?>