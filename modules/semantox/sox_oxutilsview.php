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
* Smarty prefilter for locate HTML opening body tag an insert the RDFa after it
*/
function semantox_prefilter( $sSource, &$smarty ) {
	$sTemplateDir = oxConfig::getConfig()->getTemplateDir();
	$sFind = "<body>";
	$sReplace2 = "{$sFind}[{include file=\"{$sTemplateDir}semantox/sox_include.tpl\"}]";
	return preg_replace( "/\<body(.*?)\>/", "<body$1>[{include file=\"{$sTemplateDir}semantox/sox_include.tpl\"}]", $sSource );
}

/**
* Extends oxUtilsView for Smarty prefilter registration to insert RDFa automatically
*/
class Sox_oxUtilsView extends Sox_oxUtilsView_parent{
	
	protected function _fillCommonSmartyProperties( $oSmarty ){
		parent::_fillCommonSmartyProperties( $oSmarty );
		$oSmarty->register_prefilter("semantox_prefilter");
	}
}

?>