[{* Offering *}]
[{assign var="sSoxLanguage" value=$oView->getActiveLangAbbr()}]
[{assign var="oProduct" value=$oView->getProduct()}]
[{assign var="sSoxUrl" value=$oView->getLink()}]
[{assign var="aSoxLocs" value=$oView->soxGetContentPagesLocs()}]
[{assign var="oSoxCurrency" value=$oView->getActCurrency()}]

<div xmlns="http://www.w3.org/1999/xhtml"
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
	xmlns:gr="http://purl.org/goodrelations/v1#"
	xmlns:foaf="http://xmlns.com/foaf/0.1/"
	xmlns:v="http://rdf.data-vocabulary.org/#"
	xml:base="[{$sSoxUrl}]"
	typeof="gr:Offering" about="[{$sSoxUrl}]#offeringdata">
	<div rel="foaf:page" resource="[{$sSoxUrl}]"></div>
[{assign var="oCont" value=$oView->getContentByIdent($aSoxLocs.0) }][{if $oCont}]
	<div rev="gr:offers" resource="[{$oCont->getLink()}]#companydata"></div>
[{/if}]
[{assign var="sSoxName" value=$oView->soxTextFilter($oProduct->oxarticles__oxtitle->value)}]
[{if $sSoxName}] 
	<div property="gr:name" content="[{$sSoxName}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
[{/if}]
[{oxhasrights ident="SHOWLONGDESCRIPTION"}]
[{assign var="sSoxLongDesc" value=$oView->soxTextFilter($oProduct->oxarticles__oxlongdesc->value)}] 
[{if $sSoxLongDesc}]
	<div property="gr:description" content="[{$sSoxLongDesc}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
[{/if}]
[{if !$oView->soxGetBundleUri()}]		
	<div property="gr:hasStockKeepingUnit" content="[{$oProduct->oxarticles__oxartnum->value}]" datatype="xsd:string"></div>
[{if $oProduct->oxarticles__oxmpn->value}]
	<div property="gr:hasMPN" content="[{$oProduct->oxarticles__oxmpn->value}]" datatype="xsd:string"></div>
[{/if}]
[{/if}]
[{/oxhasrights}]
[{include file="semantox/details/inc/sox_object.tpl"}]	
[{if $oView->soxGetNormalizedRating()}]
	<div rel="v:hasReview"> 
		<div typeof="v:Review-aggregate">  
			[{assign var="aSoxRating" value=$oView->soxGetNormalizedRating()}] 
			<div property="v:count" content="[{$aSoxRating.count}]" datatype="xsd:float"></div> 
			<div property="v:rating" content="[{$aSoxRating.value}]" datatype="xsd:float"></div>
		</div>
	</div>
[{/if}]
	<div rel="gr:hasInventoryLevel">
		<div typeof="gr:QuantitativeValue">
			<div property="gr:hasMinValue" content="[{if $oProduct->getStockStatus() == -1}]0[{else}]1[{/if}]" datatype="xsd:float"></div>
			<div property="gr:hasUnitOfMeasurement" content="C62" datatype="xsd:string"></div>
		</div>
	</div>
[{oxhasrights ident="SHOWARTICLEPRICE"}]
[{include file="semantox/details/inc/sox_price.tpl"}]
[{/oxhasrights}]
[{if $oProduct->getDeliveryDate()}]
	<div property="gr:validFrom" content="[{$oProduct->getDeliveryDate()}]T00:00:00" datatype="xsd:dateTime"></div>
[{elseif $oView->soxGetOfferingValidity()}]
[{assign var="aSoxOValidity" value=$oView->soxGetOfferingValidity()}] 
	<div property="gr:validFrom" content="[{$aSoxOValidity.from}]" datatype="xsd:dateTime"></div>
	<div property="gr:validThrough" content="[{$aSoxOValidity.through}]" datatype="xsd:dateTime"></div>
[{/if}]
[{if $oView->soxGetBusinessFnc()}]
	<div rel="gr:hasBusinessFunction" resource="http://purl.org/goodrelations/v1#[{$oView->soxGetBusinessFnc()}]"></div>
[{/if}]
[{if $oView->soxGetCustomers()}]
[{foreach from=$oView->soxGetCustomers() item=Customer}]
	<div rel="gr:eligibleCustomerTypes" resource="http://purl.org/goodrelations/v1#[{$Customer}]"></div>
[{/foreach}]
[{/if}]
[{if $oView->soxGetEligibleRegions()}]
[{foreach from=$oView->soxGetEligibleRegions() item=oRegion}]
	<div property="gr:eligibleRegions" content="[{$oRegion->oxcountry__oxisoalpha2->value}]" datatype="xsd:string"></div>
[{/foreach}]
[{/if}]
[{oxhasrights ident="SHOWARTICLEPRICE"}]
[{include file="semantox/details/inc/sox_payment.tpl"}]	
[{if $oProduct->oxarticles__oxfreeshipping->value}]
	<div rel="gr:hasPriceSpecification">
		<div typeof="gr:DeliveryChargeSpecification">
[{if $oView->soxGetPriceValidity()}]
[{assign var="aSoxPValidity" value=$oView->soxGetPriceValidity()}]
			<div property="gr:validFrom" content="[{$aSoxPValidity.from}]" datatype="xsd:dateTime"></div>
			<div property="gr:validThrough" content="[{$aSoxPValidity.through}]" datatype="xsd:dateTime"></div>
[{/if}]
[{if $oView->soxGetVAT() > 0}]
			<div property="gr:valueAddedTaxIncluded" content="[{if $oView->soxGetVAT() == 1}]true[{else}]false[{/if}]" datatype="xsd:boolean"></div>
[{/if}]
			<div property="gr:hasCurrency" content="[{$oSoxCurrency->name}]" datatype="xsd:string"></div>
			<div property="gr:hasCurrencyValue" content="0.00" datatype="xsd:float"></div>
		</div>
	</div>
[{else}]
[{include file="semantox/details/inc/sox_delivery.tpl"}]
[{/if}]
[{/oxhasrights}]	
	<div rel="foaf:depiction v:image" resource="[{$oView->getActPicture()}]"></div>
</div>