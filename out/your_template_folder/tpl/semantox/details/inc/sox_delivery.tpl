[{assign var=aDeliveryMethods value=$oView->soxGetDeliveryMethods()}]
[{foreach from=$aDeliveryMethods.mapped item=sDeliveryMethod}]
	<div rel="gr:availableDeliveryMethods" resource="http://purl.org/goodrelations/v1#[{$sDeliveryMethod}]"></div>
[{/foreach}]
[{assign var="oCont" value=$oView->getContentByIdent($aSoxLocs.1) }][{if $oCont}]
[{foreach from=$aDeliveryMethods.notmapped item=sDeliveryMethod}]
	<div rel="gr:availableDeliveryMethods" resource="[{$oCont->getLink()}]#[{$sDeliveryMethod}]"></div>
[{/foreach}]
[{foreach from=$oView->soxGetDeliveryChargeSpecs() item=sId}]
	<div rel="gr:hasPriceSpecification" resource="[{$oCont->getLink()}]#[{$sId}]"></div>
[{/foreach}]
[{/if}]