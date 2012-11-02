[{assign var="oSoxCurrency" value=$oView->getActCurrency()}]
[{foreach from=$oView->soxGetNotMappedDeliverySets() item=oNewDeliveryMethod}]

	<div about="[{$sSoxUrl}]#[{$oNewDeliveryMethod->cleanid->value}]" typeof="gr:DeliveryMethod">
		<div property="rdfs:label" content="[{$oNewDeliveryMethod->label->value}]"></div>
	</div>
[{/foreach}]

[{assign var="oDelChargeSpecs" value=$oView->soxGetDeliveryChargeSpecs()}]
[{foreach from=$oDelChargeSpecs item=oDelChargeSpec}]
	<div typeof="gr:DeliveryChargeSpecification" about="[{$sSoxUrl}]#[{$oDelChargeSpec->cleanid->value}]">
		<div property="rdfs:comment" content="[{$oDelChargeSpec->oxdelivery__oxtitle->value}]" [{if $sSoxLanguage}] xml:lang="[{$sSoxLanguage}]"[{/if}]></div>
		<div property="gr:validFrom" content="[{$oDelChargeSpecs->validfrom->value}]" datatype="xsd:dateTime"></div>
		<div property="gr:validThrough" content="[{$oDelChargeSpecs->validthrough->value}]" datatype="xsd:dateTime"></div>
[{if $oDelChargeSpecs->vat}]
		<div property="gr:valueAddedTaxIncluded" content="[{if $oDelChargeSpecs->vat->value eq 1}]true[{else}]false[{/if}]" datatype="xsd:boolean"></div>
[{/if}]
		<div property="gr:hasCurrency" content="[{$oSoxCurrency->name}]" datatype="xsd:string"></div>
		<div property="gr:hasCurrencyValue" content="[{$oDelChargeSpec->oxdelivery__oxaddsum->value}]" datatype="xsd:float"></div>
[{if $oDelChargeSpec->oxdelivery__oxdeltype->value eq "p"}]
		<div rel="gr:eligibleTransactionVolume">
			<div typeof="gr:UnitPriceSpecification">
				<div property="gr:hasUnitOfMeasurement" content="C62" datatype="xsd:string"></div>
				<div property="gr:hasCurrency" content="[{$oSoxCurrency->name}]" datatype="xsd:string"></div>
[{if $oDelChargeSpec->oxdelivery__oxparam->value}]
				<div property="gr:hasMinCurrencyValue" content="[{$oDelChargeSpec->oxdelivery__oxparam->value}]" datatype="xsd:float"></div>
[{/if}]
[{if $oDelChargeSpec->oxdelivery__oxparamend->value}]
				<div property="gr:hasMaxCurrencyValue" content="[{$oDelChargeSpec->oxdelivery__oxparamend->value}]" datatype="xsd:float"></div>
[{/if}]
			</div>
		</div>
[{/if}]	
[{assign var=aDeliveryMethods value=$oDelChargeSpec->deliverymethods->value}]
[{foreach from=$aDeliveryMethods.mapped item=sDeliveryMethod}]
		<div rel="gr:appliesToDeliveryMethod" resource="http://purl.org/goodrelations/v1#[{$sDeliveryMethod}]"></div>
[{/foreach}]
[{foreach from=$aDeliveryMethods.notmapped item=sDeliveryMethod}]
		<div rel="gr:availableDeliveryMethods" resource="[{$sSoxUrl}]#[{$sDeliveryMethod}]"></div>
[{/foreach}]
[{foreach from=$oDelChargeSpec->eligibleregions->value item=sRegion}]
		<div rel="gr:eligibleRegions" content="[{$sRegion}]" datatype="xsd:string"></div>
[{/foreach}]
	</div>
[{/foreach}]