[{assign var=aPaymentMethods value=$oView->soxGetPaymentMethods()}]
[{foreach from=$aPaymentMethods.mapped item=sPaymentMethod}]
	<div rel="gr:acceptedPaymentMethods" resource="http://purl.org/goodrelations/v1#[{$sPaymentMethod}]"></div>
[{/foreach}]
[{assign var="oCont" value=$oView->getContentByIdent($aSoxLocs.2) }][{if $oCont}]
[{foreach from=$aPaymentMethods.notmapped item=sPaymentMethod}]
	<div rel="gr:acceptedPaymentMethods" resource="[{$oCont->getLink()}]#[{$sPaymentMethod}]"></div>
[{/foreach}]
[{/if}]