[{assign var="aSoxLocs" value=$oView->soxGetContentPagesLocs()}]
[{assign var="sSoxLanguage" value=$oView->getActiveLangAbbr()}]
[{assign var=sSoxUrl value=$oView->getLink()}]
[{assign var=sLoadId value=$oContent->oxcontents__oxloadid->value}]
[{if ($sLoadId eq $aSoxLocs.0 || $sLoadId eq $aSoxLocs.1 || $sLoadId eq $aSoxLocs.2)}]

<div xmlns="http://www.w3.org/1999/xhtml"
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
	xmlns:gr="http://purl.org/goodrelations/v1#"
	xmlns:foaf="http://xmlns.com/foaf/0.1/"
	xmlns:vcard="http://www.w3.org/2006/vcard/ns#"
	xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
	xml:base="[{$sSoxUrl}]">
[{if $sLoadId eq $aSoxLocs.0}]
[{include file="semantox/content/inc/sox_business_entity.tpl"}]
[{/if}]
[{if $sLoadId eq $aSoxLocs.1}]
[{include file="semantox/content/inc/sox_delivery_charge.tpl"}]
[{/if}]
[{if $sLoadId eq $aSoxLocs.2}]
[{include file="semantox/content/inc/sox_payment_charge.tpl"}]
[{/if}]
	
</div>

[{/if}]