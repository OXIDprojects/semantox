[{assign var=oBusinessEntity value=$oView->soxGetBusinessEntityData()}]
<div typeof="gr:BusinessEntity" about="[{$sSoxUrl}]#companydata">
	<div property="gr:legalName vcard:fn" content="[{$oBusinessEntity->oxshops__oxcompany->value}]" datatype="xsd:string"></div>
	<div rel="vcard:adr">
		<div typeof="vcard:Address">
			<div property="vcard:country-name" content="[{$oBusinessEntity->oxshops__oxcountry->value }]"></div>
			<div property="vcard:locality" content="[{$oBusinessEntity->oxshops__oxcity->value }]"></div>
			<div property="vcard:postal-code" content="[{$oBusinessEntity->oxshops__oxzip->value }]"></div>
			<div property="vcard:street-address" content="[{$oBusinessEntity->oxshops__oxstreet->value }]"></div>
		</div>
	</div>
[{if $oBusinessEntity->oxshops__soxlatitude->value && $oBusinessEntity->oxshops__soxlongitude->value}]
	<div rel="vcard:geo">
		<div typeof="rdf:Description">
			<div property="vcard:latitude" content="[{$oBusinessEntity->oxshops__soxlatitude->value}]" datatype="xsd:float"></div>
			<div property="vcard:longitude" content="[{$oBusinessEntity->oxshops__soxlongitude->value}]" datatype="xsd:float"></div>
		</div>
	</div>
[{/if}]
	<div property="vcard:tel" content="[{$oBusinessEntity->oxshops__oxtelefon->value}]"></div>
	<div property="vcard:fax" content="[{$oBusinessEntity->oxshops__oxtelefax->value}]"></div>
[{if $oBusinessEntity->oxshops__soxlogourl->value}]	
	<div rel="vcard:logo foaf:logo" resource="[{$oBusinessEntity->oxshops__soxlogourl->value }]"></div>
[{/if}]
[{if $oBusinessEntity->oxshops__soxduns->value}]
	<div property="gr:hasDUNS" content="[{$oBusinessEntity->oxshops__soxduns->value}]" datatype="xsd:string"></div>
[{/if}]
[{if $oBusinessEntity->oxshops__soxisic->value}]
	<div property="gr:hasISICv4" content="[{$oBusinessEntity->oxshops__soxisic->value}]" datatype="xsd:int"></div>
[{/if}]
[{if $oBusinessEntity->oxshops__soxgln->value}]
	<div property="gr:hasGlobalLocationNumber" content="[{$oBusinessEntity->oxshops__soxgln->value}]" datatype="xsd:string"></div>
[{/if}]
[{if $oBusinessEntity->oxshops__soxnaics->value}]
	<div property="gr:hasNAICS" content="[{$oBusinessEntity->oxshops__soxnaics->value}]" datatype="xsd:int"></div>
[{/if}]
</div>